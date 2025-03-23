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
<h1>リプライ作成画面</h1>
<form action="{{ route('post.show', ['id' => $post->id]) }}">
    <button type="submit">ポストへ戻る</button>
</form>
<h2>返信先ポスト</h2>
<h3>{{ $post->title }}</h3>
<p>投稿者：{{ $post->user->name }}</p>
<p>{{ $post->body }}</p>
@if ($post->image_path)
    <img src="{{ asset('storage/' . $post->image_path) }}" alt="投稿画像" width="300">
@endif

<h2>リプライを作成</h2>
<form action="{{ route('reply.update', ['reply_id' => $reply->id]) }}" method="post" enctype="multipart/form-data">
    @csrf
    <label for="body">本文</label> <br>
    <textarea name="body" id="body" cols="30" rows="10" required> {{ old('body', $reply->body) }} </textarea>  <br>
    <label for="image">画像</label>  <br>
    <input type="file" name="image" id="image" accept="image/*"> {{ old('image_path', $reply->image_path) }} <br>
    <button type="submit">返信</button>
</form>
</body>
</html>
