<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reaction;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Log;

class ReactionController extends Controller
{
    public function store(Request $request) {
        $userId = Auth::user()->id;
        $reaction = Reaction::where([
            [ 'owner_id', '=', $userId ],
            [ 'subject_id', '=', $request->subject_id ]
        ])->first();

        if (!$reaction) {
            $reaction = Reaction::create([
                'owner_id' => $userId,
                'subject_id' => $request->subject_id,
                'value' => 1,
            ]);
        } else {
            $reaction->value = 1 - $reaction->value;
            $reaction->save();
        }

        $reactionList = Reaction::where([
            [ 'value', '=', 1 ],
            [ 'subject_id', '=', $request->subject_id ]
        ])->get();

        return response()->json([
            'reactionList' => $reactionList,
            'ownReaction' => $reaction->value ,
        ]);
    }

    public function get(Request $request) {
        $reactionList = Reaction::where([
            [ 'value', '=', 1 ],
            [ 'subject_id', '=', $request->subject_id ]
        ])->get();

        $userId = Auth::user()->id;
        $ownReaction = Reaction::where([
            [ 'owner_id', '=', $userId ],
            [ 'subject_id', '=', $request->subject_id ]
        ])->first();

        $ownReaction = $ownReaction ? $ownReaction->value : 0;

        return response()->json([
            'reactionList' => $reactionList,
            'ownReaction' => $ownReaction,
        ]);
    }
}
