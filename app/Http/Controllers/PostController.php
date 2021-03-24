<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\UserInfo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use Carbon\Carbon;

class PostController extends Controller
{
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
        $postList = Post::all();

        $ownerIdList = [];

        foreach ($postList as $post) {
            $ownerIdList[] = $post->owner_id;
        }

        $ownerList = UserInfo::whereIn('user_id', $ownerIdList)
                                ->get()
                                ->keyBy('user_id');

        foreach ($postList as $post) {
            $post->content = nl2br($post->content);
            $post->owner = $ownerList[$post->owner_id];
            $postCreatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $post->created_at);
            if ($postCreatedDate->isToday()) {
                $post->created_date = $postCreatedDate->format('H:i');
            } else {
                $post->created_date = $postCreatedDate->format('d-m-Y');
            }
        }

        return response()->json([
            'postList' => $postList,
        ]);
    }
}
