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
<p>{{ $post->body }}</p>
@if ($post->image_path)
    <img src="{{ asset('storage/' . $post->image_path) }}" alt="投稿画像" width="300">
@endif
</body>
</html>
