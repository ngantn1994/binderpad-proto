<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\UserInfo;
use App\Models\Reaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use Carbon\Carbon;

class PostController extends Controller
{
    public static function getRequiredPostInfo($postList) {
        $ownerIdList = [];
        $subjectIdList = [];

        foreach ($postList as $post) {
            $ownerIdList[] = $post->owner_id;
            $subjectIdList[] = $post->id;
        }

        $ownerList = UserInfo::whereIn('user_id', $ownerIdList)
                                ->get()
                                ->keyBy('user_id');
        $reactionListRaw = Reaction::whereIn('subject_id', $subjectIdList)
                                ->get();
        $reactionList = [];
        foreach ($reactionListRaw as $reactionRaw) {
            if (!array_key_exists($reactionRaw->subject_id, $reactionList)) {
                $reactionList[$reactionRaw->subject_id] = [];
            }
            $reactionList[$reactionRaw->subject_id][] = $reactionRaw->toArray();
        }
        
        $userId = Auth::user()->id;
        $ownReactionList = [];
        foreach ($reactionListRaw as $reaction) {
            if ($reaction->owner_id === $userId) {
                $ownReactionList[$reaction->subject_id] = $reaction->value;
            }
        }

        foreach ($postList as $post) {
            $post->content = nl2br($post->content);
            $post->owner = $ownerList[$post->owner_id];
            $post->reaction = array_key_exists($post->id, $reactionList) ? $reactionList[$post->id] : 0;
            $post->ownReaction = array_key_exists($post->id, $ownReactionList) ? $ownReactionList[$post->id] : 0;
            $postCreatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $post->created_at);
            if ($postCreatedDate->isToday()) {
                $post->created_date = $postCreatedDate->format('H:i');
            } else {
                $post->created_date = $postCreatedDate->format('d-m-Y');
            }
        }

        return $postList;
    }

    public function store(Request $request) {
        $userId = Auth::user()->id;

        Post::create([
            'owner_id' => $userId,
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return response()->json([
            'status' => 'updated',
        ]);
    }

    public function getAll(Request $request) {
        // for now, get all first
        // later will get based on each user preference
        // and slow loading support
        $postList = Post::where('info_flag', '<' , Post::INFO_FLAG_DELETED)
                            ->get();

        return response()->json([
            'postList' => PostController::getRequiredPostInfo($postList),
        ]);
    }

    public function getCurrentUser(Request $request) {
        $userId = Auth::user()->id;
        $postList = Post::where([
                        ['owner_id', '=', $userId],
                        ['info_flag', '<' , Post::INFO_FLAG_DELETED],
                    ])
                    ->get();

        return response()->json([
            'postList' => PostController::getRequiredPostInfo($postList),
        ]);
    }

    public function deletePost(Request $request) {
        $userId = Auth::user()->id;
        $post = Post::where('id', $request->id)
                    ->first();
        if ($userId === $post->owner_id) {
            $post->info_flag = Post::INFO_FLAG_DELETED;
            $post->save();
        }

        return response()->json([
            'status' => 'deleted',
        ]);
    }
}
