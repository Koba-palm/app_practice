@extends('layouts.app')

@section('title', 'ポスト一覧')

@section('content')
    <div class="container">
        <div class="mb-3 d-flex gap-3">
            {{-- 投稿作成へ --}}
            <form action="{{ route('post.create') }}">
                @csrf
                <button class="btn btn-success" type="submit">投稿を作成する</button>
            </form>
        </div>

        <div class="row">
            @foreach($posts as $post)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        @if ($post->image_path)
                            <img src="{{ asset('storage/' . $post->image_path) }}" class="card-img-top" alt="投稿画像">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p class="card-text">{{ Str::limit($post->body, 80) }}</p>
                            <p class="card-subtitle text-muted small">{{ $post->user->name }}・{{ $post->created_at->format('Y/m/d') }}</p>
                            <a href="{{ route('post.show', $post->id) }}" class="btn btn-outline-primary btn-sm mt-2">続きを読む</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>



    </div>
@endsection
