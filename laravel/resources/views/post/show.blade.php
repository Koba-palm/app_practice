@extends('layouts.app')
@section('title', $post->title)
@section('content')
    <div class="container">
        <a href="{{ route('post.index') }}" class="btn btn-secondary mb-3">一覧へ戻る</a>

        {{-- 投稿詳細 --}}
        <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex align-items-center gap-2 flex-wrap">
                    <p class="card-subtitle mb-2 text-muted fw-bold fs-5">{{ $post->user->name }}</p>
                    @auth
                        @if (Auth::id() !== $post->user->id)
                            <div class="mb-2">
                                @if (Auth::user()->followingUsers->contains($post->user->id) && Auth::user()->followedUsers->contains($post->user->id))
                                    <form action="{{ route('unfollow', $post->user) }}" method="post">
                                        {{-- 相互フォロー --}}
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-danger btn-xs">フォローを解除</button>
                                    </form>
                                @elseif (Auth::user()->followingUsers->contains($post->user->id))
                                    <form action="{{ route('unfollow', $post->user) }}" method="post">
                                        {{-- 自分だけフォロー --}}
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-danger btn-xs">フォローを解除</button>
                                    </form>
                                @elseif (Auth::user()->followedUsers->contains($post->user->id))
                                    <form action="{{ route('follow', $post->user) }}" method="post">
                                        {{-- 相手だけフォローしてる --}}
                                        @csrf
                                        <button class="btn btn-outline-primary btn-xs">フォロー</button>
                                    </form>
                                @else
                                    <p>フォローしてみましょう！</p>
                                    <form action="{{ route('follow', $post->user) }}" method="post">
                                        @csrf
                                        <button class="btn btn-outline-primary btn-sm">フォロー</button>
                                    </form>
                                @endif
                            </div>
                        @endif
                    @endauth
                </div>
                <p class="mb-3">{{ $post->updated_at }}</p>
                <h2 class="card-title fs-3">{{ $post->title }}</h2>

                <p class="mt-3">{{ $post->body }}</p>
                @if ($post->image_path)
                    <img src="{{ asset('storage/' . $post->image_path) }}" class="img-fluid mt-2" alt="投稿画像">
                @endif
            </div>
        </div>

        {{-- リプライ一覧 --}}
        <h4 class="mb-3">💬 コメント</h4>
        @foreach ($post->replies as $reply)
            <div class="card mb-3">
                <div class="card-body">
                    <p class="mb-1"><strong>{{ $reply->user->name }}</strong></p>
                    <p>{{ $reply->body }}</p>
                    @if ($reply->image_path)
                        <img src="{{ asset('storage/' . $reply->image_path) }}" class="img-fluid mt-2" alt="返信画像">
                    @endif
                    @if (Auth::id() === $reply->user->id)
                        <form action="{{ route('reply.edit', $reply->id) }}" class="mt-2">
                            <button class="btn btn-outline-secondary btn-sm">編集</button>
                        </form>
                    @endif
                </div>
            </div>
        @endforeach

        {{-- リプライ作成リンク --}}
        <a href="{{ route('reply.create', ['post_id' => $post->id]) }}" class="btn btn-primary mt-3">＋ リプライを作成</a>
    </div>


@endsection
