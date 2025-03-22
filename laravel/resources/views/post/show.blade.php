<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>投稿の詳細</h1>
<form action="{{ route('post.index') }}">
    <button type="submit">一覧へ戻る</button>
</form>

<h2>{{ $post->title }}</h2>
<p>投稿者：{{ $post->user->name }}</p>
@if (Auth::id() != $post->user->id)
    @if (Auth::user()->followingUsers->contains($post->user->id) && Auth::user()->followedUsers->contains($post->user->id))
        <p>相互フォローです。</p>
        <form action="{{ route('unfollow', $post->user) }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit">フォローを解除</button>
        </form>
    @elseif (Auth::user()->followingUsers->contains($post->user->id))
        <p>フォローしています。</p>
        <form action="{{ route('unfollow', $post->user) }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit">フォローを解除</button>
        </form>
    @elseif (Auth::user()->followedUsers->contains($post->user->id))
        <p>フォローされています。</p>
        <form action="{{ route('follow', $post->user) }}" method="post">
            @csrf
            <button type="submit">フォロー</button>
        </form>
    @else <p>あなたからフォローしてみましょう！</p>
    <form action="{{ route('follow', $post->user) }}" method="post">
        @csrf
        <button type="submit">フォロー</button>
    </form>
    @endif
@endif



<p>{{ $post->body }}</p>
@if ($post->image_path)
    <img src="{{ asset('storage/' . $post->image_path) }}" alt="投稿画像" width="300">
@endif
</body>
</html>
