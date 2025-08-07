<?php

namespace App\Http\Controllers;

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
     * @param Request $request HTTP-запит
     * @return Factory|View|Application Повертає представлення з даними статей
     */
    public function index(Request $request): Factory|View|Application
    {
        $search = $request->query('search');

        $posts = Post::with('category')
            ->when($search, function ($query, $search) {
                $query->where('title', 'like', "%{$search}%");
            })
            ->paginate(5)
            ->appends(['search' => $search]); // зберігає параметр у пагінації

        return view('index', compact('posts', 'search'));
    }
}
