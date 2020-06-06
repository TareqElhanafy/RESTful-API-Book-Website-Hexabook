<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

use App\Buyer;
use App\Paidbook;
use App\Policies\BuyerPolicy;
use App\Policies\PaidbookPolicy;
use App\Policies\SellerPolicy;
use App\Policies\TransactionPolicy;
use App\Policies\UserPolicy;
use App\Seller;
use App\Transaction;
use App\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        
        Buyer::class=>BuyerPolicy::class,
        Seller::class=>SellerPolicy::class,
        User::class=>UserPolicy::class,
        Transaction::class=>TransactionPolicy::class,
        Paidbook::class=>PaidbookPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin-user', function ($user) {
            return $user->isAdmin;
        });
        Passport::routes();
        Passport::tokensExpireIn(Carbon::now()->addMinutes(30));
        Passport::refreshTokensExpireIn(Carbon::now()->addDays(30));

        //
    }
}
