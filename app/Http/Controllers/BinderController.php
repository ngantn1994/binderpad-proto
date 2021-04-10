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
}
