<?php

namespace App\Http\Controllers;

use App\Models\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserInfoController extends Controller
{

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) {
        $userInfo = UserInfo::where('user_id', Auth::user()->id)->first();
        if ($userInfo) {
            $userInfo->display_name = $request->display_name;
            $userInfo->desc = $request->desc;
            $userInfo->avatar = $request->avatar;

            $userInfo->save();

            return "updated";
        }

        return response()->json();
    }

    public function getCurrentUser(Request $request) {
        $userInfo = UserInfo::where('user_id', Auth::user()->id)->first();
        $userInfo->desc = nl2br($userInfo->desc);

        return response()->json([
            'userInfo' => $userInfo
        ]);
    }

    public function getById(Request $request) {
        $userInfo = UserInfo::where('user_id', $request->userId)->first();
        if ($userInfo) {
            $userInfo->desc = nl2br($userInfo->desc);

            return response()->json([
                'userInfo' => $userInfo
            ]);
        } else {
            return response()->json([
                'status' => 'not found'
            ]);
        }
    }
}
