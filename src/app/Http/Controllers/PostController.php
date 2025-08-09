<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostIndexRequest;
use App\Models\Post;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Відображає список статей з пагінацією.
     * Підтримує пошук за заголовком через GET-параметр "search".
     *
     * @param PostIndexRequest $request HTTP-запит
     * @return Factory|View|Application Повертає представлення з даними статей
     */
    public function index(PostIndexRequest $request): Factory|View|Application
    {
        $search = $request->validated('search');

        $posts = Post::with('category')
            ->when($search, function ($query, $search) {
                $query->where('title', 'like', "%{$search}%");
            })
            ->paginate(5)
            ->appends(['search' => $search]); // зберігає параметр у пагінації

        return view('index', compact('posts', 'search'));
    }
}
