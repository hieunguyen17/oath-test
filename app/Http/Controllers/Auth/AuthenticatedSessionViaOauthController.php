<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\OauthProvider;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthenticatedSessionViaOauthController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(string $provider): RedirectResponse
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(string $provider): RedirectResponse
    {
        $socialiteUser = Socialite::driver($provider)->user();

        if (!$socialiteUser->getEmail()) {
            return to_route('login')
                ->withErrors(['oauth' => __('The social account has not been linked to an email address yet.')]);
        }

        $user = User::firstOrCreate([
            'email' => $socialiteUser->getEmail(),
        ], [
            'name' => $socialiteUser->getName(),
            'email_verified_at' => now(),
        ]);

        OauthProvider::firstOrCreate([
            'user_id' => $user->id,
            'provider_name' => $provider,
        ], [
            'provider_id' => $socialiteUser->getId(),
        ]);

        Auth::login($user);

        return to_route('dashboard');
    }
}
