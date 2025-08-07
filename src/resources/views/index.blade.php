@extends('layouts.app')

@section('content')
    <style>
        body {
            font-family: sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            padding: 2rem;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        .article {
            background: #fff;
            border-radius: 1rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            transition: transform 0.2s ease;
        }

        .article:hover {
            transform: translateY(-2px);
        }

        .article-title {
            font-size: 1.5rem;
            color: #1d4ed8;
            margin-bottom: 0.25rem;
        }

        .article-meta {
            font-size: 0.875rem;
            color: #6b7280;
            margin-bottom: 1rem;
        }

        .article-content {
            color: #374151;
            font-size: 1rem;
            margin-bottom: 1rem;
        }

        .article-category {
            display: inline-block;
            background-color: #e0f2fe;
            color: #0369a1;
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
            border-radius: 9999px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
    </style>
    @include('layouts.errors')
    <form method="GET" action="{{ route('posts.index') }}">
        <input type="text" name="search" value="{{ old('search', $search ?? '') }}" placeholder="Пошук за заголовком">
        <button type="submit">Шукати</button>
    </form>

    <h1>Список статей</h1>

    @if (!$posts->isEmpty())
        @foreach ($posts as $post)
        <div class="article">
          <div class="article-title">{{ $post->title }}</div>
          <div class="article-meta">
            <span class="article-category">Категорія: {{ $post->category->name }}</span> |
            Опубліковано: {{ $post->created_at->format('d.m.Y') }}
          </div>
          <div class="article-content">
              {{ Str::limit(strip_tags($post->content), 200, '...') }}
          </div>
        </div>
        @endforeach
    @else
        <div>
            Статей немає
        </div>
    @endif

    {{ $posts->links() }}

@endsection
