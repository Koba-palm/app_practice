@extends('layouts.app')
@section('title', $post->title .'へのコメント')
@section('content')
    <div class="container">
        <a href="{{ route('post.show', ['id' => $post->id]) }}" class="btn mb-3 btn-secondary">ポストへ戻る</a>

        <div class="card mb-4">
            <div class="card-body">
                <p class="card-subtitle mb-2 text-muted fw-bold fs-5">{{ $post->user->name }}</p>
                <p class="mb-3">{{ $post->updated_at }}</p>
                <h2 class="card-title fs-3">{{ $post->title }}</h2>
                <p class="mt-3">{{ $post->body }}</p>
                @if ($post->image_path)
                    <img src="{{ asset('storage/' . $post->image_path) }}" alt="投稿画像" class="img-fluid">
                @endif
            </div>
        </div>

        <form action="{{ route('reply.store', ['post_id' => $post->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="body" class="form-label">本文</label>
                <textarea name="body" id="body" class="form-control" rows="5" required>{{ old('body') }}</textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">画像</label>
                <input type="file" name="image" id="image" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">✈︎ 返信</button>
        </form>
    </div>
@endsection
