<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\PostAddCommentRequest;
use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    public function index(): JsonResponse
    {
        $posts = Post::with('category')->get();

        return response()->json($posts);
    }

    public function show(int $id): JsonResponse
    {
        $post = Post::with('category')->find($id);

        if (!$post) {
            return response()->json(['message' => 'Пост не знайдено'], 404);
        }

        return response()->json($post);
    }

    public function addComment(int $id, PostAddCommentRequest $request): JsonResponse
    {
        $post = Post::find($id);

        $comment = $post->comments()->create([
            'content' => $request->input('content'),
        ]);

        return response()->json([
            'message' => 'Коментар створено',
            'comment' => $comment
        ], 201);
    }
}
