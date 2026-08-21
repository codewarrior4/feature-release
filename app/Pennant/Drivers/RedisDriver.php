<?php

namespace App\Pennant\Drivers;

use Illuminate\Contracts\Cache\Repository;
use Laravel\Pennant\Contracts\Driver;
use Laravel\Pennant\Feature;

class RedisDriver implements Driver
{
    /** @var array<string, callable(mixed): mixed> */
    private array $resolvers = [];

    public function __construct(private Repository $cache) {}

    public function define(string $feature, callable $resolver): void
    {
        $this->resolvers[$feature] = $resolver;
    }

    public function defined(): array
    {
        return array_keys($this->resolvers);
    }

    public function getAll(array $features): array
    {
        return collect($features)->mapWithKeys(fn (array $scopes, string $feature): array => [
            $feature => array_map(fn (mixed $scope): mixed => $this->get($feature, $scope), $scopes),
        ])->all();
    }

    public function get(string $feature, mixed $scope): mixed
    {
        $key = $this->key($feature, $scope);

        if ($this->cache->has($key)) {
            return $this->cache->get($key);
        }

        $value = ($this->resolvers[$feature] ?? fn (): bool => false)($scope);
        $this->set($feature, $scope, $value);

        return $value;
    }

    public function set(string $feature, mixed $scope, mixed $value): void
    {
        $this->cache->forever($this->key($feature, $scope), $value);
        $scopes = $this->cache->get($this->scopesKey($feature), []);

        if (! in_array(Feature::serializeScope($scope), $scopes, true)) {
            $scopes[] = Feature::serializeScope($scope);
            $this->cache->forever($this->scopesKey($feature), $scopes);
        }
    }

    public function setForAllScopes(string $feature, mixed $value): void
    {
        foreach ($this->cache->get($this->scopesKey($feature), []) as $scope) {
            $this->cache->forever($this->key($feature, $scope), $value);
        }
    }

    public function delete(string $feature, mixed $scope): void
    {
        $this->cache->forget($this->key($feature, $scope));
    }

    public function purge(?array $features): void
    {
        foreach ($features ?? array_keys($this->resolvers) as $feature) {
            foreach ($this->cache->get($this->scopesKey($feature), []) as $scope) {
                $this->cache->forget($this->key($feature, $scope));
            }

            $this->cache->forget($this->scopesKey($feature));
        }
    }

    private function key(string $feature, mixed $scope): string
    {
        return 'pennant:feature:'.sha1($feature.'|'.Feature::serializeScope($scope));
    }

    private function scopesKey(string $feature): string
    {
        return 'pennant:scopes:'.sha1($feature);
    }
}
