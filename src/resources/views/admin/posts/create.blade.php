@extends('layouts.app')

@section('content')
    <h1>{{ isset($post) ? 'Редагувати' : 'Створити' }} статтю</h1>

    @include('layouts.errors')

    <form action="{{ isset($post) ? route('admin.posts.update', $post) : route('admin.posts.store') }}" method="POST">
        @csrf
        @if(isset($post))
            @method('PUT')
        @endif

        <input type="text" name="title" placeholder="Заголовок" value="{{ old('title', $post->title ?? '') }}"><br>
        <textarea name="content" placeholder="Текст">{{ old('content', $post->content ?? '') }}</textarea><br>

        <select name="category_id">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ (old('category_id', $post->category_id ?? '') == $category->id) ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select><br>

        <button type="submit">Зберегти</button>
    </form>
@endsection
