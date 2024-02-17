<?php

declare(strict_types=1);

namespace App\V1\Core\Application\Providers;

use App\V1\Core\Domain\Policies\Policy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider;
use Illuminate\Support\Facades\Gate;

abstract class PolicyServiceProvider extends AuthServiceProvider
{
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('duplicate', [Policy::class, 'replicate']);
    }
}
