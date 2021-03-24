<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class RegisteredUserController extends Controller {

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request) {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        DB::beginTransaction();
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $userInfo = $this::createUserInfo($user);
        $userInfo->save();
        DB::commit();

        Auth::login($user);

        event(new Registered($user));

        return response()->json();
    }

    public static function createUserInfo($user) {
        $userInfo = UserInfo::make([
            'user_id' => $user->id,
            'display_name' => $user->name,
        ]);
        $userInfo->setRandomDefaultAvatar();
        return $userInfo;
    }
}
