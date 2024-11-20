<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \Illuminate\Support\Facades\Event::listen(static function (\SocialiteProviders\Manager\SocialiteWasCalled $event) {
            (new \SocialiteProviders\Google\GoogleExtendSocialite())->handle($event);
            (new \SocialiteProviders\Facebook\FacebookExtendSocialite())->handle($event);
            (new \SocialiteProviders\Apple\AppleExtendSocialite())->handle($event);
            (new \SocialiteProviders\Twitter\TwitterExtendSocialite())->handle($event);
            (new \SocialiteProviders\Line\LineExtendSocialite())->handle($event);
        });
    }
}
