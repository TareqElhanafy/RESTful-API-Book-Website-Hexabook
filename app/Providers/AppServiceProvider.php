<?php

namespace App\Providers;

use App\Mail\UserCreated;
use App\Mail\UserUpdated;
use App\Paidbook;
use App\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paidbook::updated(function($paidbook){
            if ($paidbook->quantity==0 && $paidbook->isAvailable()) {
              $paidbook->available='0';
               $paidbook->save();
              }
        });
        User::created(function($user){
            Mail::to($user->email)->send(new UserCreated($user));
        });

        
        User::updated(function($user){
            if (!$user->isClean('email')) {
                Mail::to($user->email)->send(new UserUpdated($user));

            }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
