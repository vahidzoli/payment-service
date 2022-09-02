<?php

namespace App\Providers;

use App\Services\LoopPaymentService;
use App\Services\PaymentServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(PaymentServiceInterface::class, 
        config('payment.services.' . config('payment.provider') . '.class'));
    }
}
