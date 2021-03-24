<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserInfo;
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
     * Handle an incoming authentication request.
     */
    public function store(Request $request) {
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

    public function getUserInfo(Request $request) {
        $user = Auth::user();
        if ($user) {
            Log::debug(1);
            $userInfo = UserInfo::where('user_id', $user->id)->first();
            Log::info("user info");
            Log::info($user->id);
            if ($userInfo) {
                Log::debug(2);
                Log::debug($userInfo);
                Log::debug($userInfo->toJson());
                return $userInfo->toJson();
            } else {
                Log::debug("shit happened");
            }
        }

        return response()->json();
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
