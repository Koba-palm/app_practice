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
<h1>ポスト作成画面</h1>

<form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <label for="title">タイトル</label>
    <input type="text" name="title" id="title" required> <br>
    <label for="body">本文</label>
    <textarea name="body" id="body" required></textarea> <br>
    <label for="image">画像を選択</label>
    <input type="file" name="image" id="image"> <br>
    <button type="submit">投稿</button>
</form>
</body>
</html>
