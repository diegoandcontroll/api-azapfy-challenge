<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Invoice;
use App\Policies\InvoicePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Invoice::class => InvoicePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('view-invoice', [InvoicePolicy::class, 'show']);
        Gate::define('update-invoice', [InvoicePolicy::class, 'update']);
        Gate::define('delete-invoice', [InvoicePolicy::class, 'delete']);
    }
}
