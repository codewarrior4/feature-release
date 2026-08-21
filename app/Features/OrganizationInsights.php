<?php

namespace App\Features;

use App\Enums\DemoOrganization;

class OrganizationInsights
{
    /**
     * Resolve the feature's initial value.
     */
    public function resolve(DemoOrganization $scope): bool
    {
        return match ($scope) {
            DemoOrganization::Acme, DemoOrganization::Orbit => true,
            DemoOrganization::Northstar => false,
        };
    }
}
