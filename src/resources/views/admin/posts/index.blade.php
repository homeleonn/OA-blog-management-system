@extends('layouts.app')

@section('content')
    <h1>Список статей</h1>

    <a href="{{ route('admin.posts.create') }}">Створити нову</a>

    @if (!$posts->isEmpty())
    <table class="post-list" border="1">
        <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Category</th>
            <th>Content(cut)</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
            <tr>
                <td>{{ $post->id }}</td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->category->name }}</td>
                <td>{{ Str::limit($post->content, 80) }}</td>
                <td>
                    <a href="{{ route('admin.posts.edit', $post) }}">✏️</a>
                </td>
                <td>
                    <form action="{{ route('admin.posts.destroy', $post) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Підтвердіть видалення')">🗑️</button>
                    </form>
                </td>
            </tr>
          @endforeach
        </tbody>
    </table>
    @else
        <div>
            Статей немає
        </div>
    @endif

    {{ $posts->links() }}

    <style>
        .post-list {
            border-collapse: collapse;
        }

        .post-list th,
        .post-list td {
            padding: 3px;
        }
    </style>
@endsection
