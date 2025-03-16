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
<h1>ユーザー登録</h1>

<form action="{{ route('users.store') }}" method="post"> <!-- method忘れずに。デフォルトはgetだから指定しないとindexの方に繋がっちゃうよ -->
    @csrf
    <label for="name">名前</label>
    <input type="text" name="name" id="name" value="{{ old('name') }}"> <!-- old('name')で前入力したものが残る。申請ミスの時便利 -->
    <label for="email">メールアドレス</label>
    <input type="email" name="email" id="email" value="{{ old('email') }}">
    <label for="password">パスワード</label>
    <input type="password" name="password" id="password">

    <button type="submit">登録</button>
</form>

</body>
</html>
