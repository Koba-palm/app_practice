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
<h1>投稿修正</h1>

<form action="{{ route('post.update', $post->id) }}" method='post'>
    @csrf
    <label for="title">タイトル</label>
    <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}" required>
    <label for="body">本文</label>
    <textarea name="body" id="body" required>{{ old('body', $post->body) }}</textarea> <!-- old(): validationエラーの時に使われる。それ以外はデータベースから引っ張ってくる。 -->
    <button type="submit">投稿</button>
</form>

</body>
</html>
