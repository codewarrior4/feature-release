<?php

namespace App\Support;

class PercentageRollout
{
    /**
     * Determine whether a stable subject is inside a percentage rollout.
     */
    public function includes(string $feature, string $subject, int $percentage): bool
    {
        if ($percentage <= 0) {
            return false;
        }

        if ($percentage >= 100) {
            return true;
        }

        $bucket = hexdec(substr(hash('sha256', $feature.'|'.$subject), 0, 8)) % 100;

        return $bucket < $percentage;
    }
}
