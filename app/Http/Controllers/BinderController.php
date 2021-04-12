<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Binder;
use App\Models\UserInfo;
use App\Models\Reaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class BinderController extends Controller
{
    public function store(Request $request) {
        $userId = Auth::user()->id;

        Binder::create([
            'owner_id' => $userId,
            'title' => $request->title,
            'desc' => $request->desc,
        ]);

        return response()->json([
            'status' => 'updated',
        ]);
    }

    public function getCurrentUser(Request $request) {
        $userId = Auth::user()->id;
        $binderList = Binder::where([
                        ['owner_id', '=', $userId],
                        ['info_flag', '<' , Binder::INFO_FLAG_DELETED],
                    ])
                    ->get();

        return response()->json([
            'binderList' => BinderController::getRequiredBinderInfo($binderList),
        ]);
    }

    public function getByUserId(Request $request) {
        $userId = $request->userId;
        $binderList = Binder::where([
                        ['owner_id', '=', $userId],
                        ['info_flag', '<' , Binder::INFO_FLAG_DELETED],
                    ])
                    ->get();

        return response()->json([
            'binderList' => BinderController::getRequiredBinderInfo($binderList),
        ]);
    }

    public static function getRequiredBinderInfo($binderList) {

        foreach ($binderList as $binder) {
            $binder->desc = nl2br($binder->desc);
        }

        return $binderList;
    }
}
