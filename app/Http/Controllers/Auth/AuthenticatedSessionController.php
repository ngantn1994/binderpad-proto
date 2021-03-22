<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {   
        Log::debug(1);
        return Inertia::render('Auth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
        ]);
    }

    // /**
    //  * Handle an incoming authentication request.
    //  *
    //  * @param  \App\Http\Requests\Auth\LoginRequest  $request
    //  * @return \Illuminate\Http\RedirectResponse
    //  */
    // public function store(LoginRequest $request)
    // {
    //     // $request->authenticate();
    //     Log::debug(2);
    //     $request->session()->regenerate();

    //     // return redirect()->intended(RouteServiceProvider::HOME);
    //     return "ok";
    // }


    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        // $request->authenticate();
        Log::debug(2);
        // $request->session()->regenerate();
        $user = User::where('email', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                Log::debug("puehpueh");
                Auth::login($user);
                return "ok";
            }
        }
        Log::debug("wrong pass");
        return "fail";
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return "logout";
    }
}
