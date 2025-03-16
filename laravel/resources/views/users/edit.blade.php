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
<h1>ユーザー情報更新</h1>

<form action="{{ route('users.update', ['id' => $user->id]) }}" method="post">
    @csrf
    <label for="name">名前</label>
    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}">
    <label for="email">メールアドレス</label>
    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}">
    <button type="submit">更新</button>
</form>
</body>
</html>
