<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(): Factory|View|Application
    {
        $posts = Post::with('category')->paginate(5);
        return view('admin.posts.index', compact('posts'));
    }

    public function create(): Factory|View|Application
    {
        $categories = Category::all();
        return view('admin.posts.create', compact('categories'));
    }

    public function store(PostStoreRequest $request): RedirectResponse
    {
        Post::create($request->validated());

        return redirect()->route('admin.posts.index')->with('success', 'Статтю створено!');
    }

    public function edit(Post $post): Factory|View|Application
    {
        $categories = Category::all();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    public function update(PostUpdateRequest $request, Post $post): RedirectResponse
    {
        $post->update($request->validated());

        return redirect()->route('admin.posts.index')->with('success', 'Статтю оновлено!');
    }

    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();

        return redirect()->route('admin.posts.index')->with('success', 'Статтю видалено!');
    }
}
