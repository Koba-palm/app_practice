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
<h1>{{ Auth::user()->name }}さんの友達一覧</h1>
<h2>フォロー</h2>
@foreach($followings as $following)
    <p>{{ $following->name }}</p>
@endforeach
<h2>フォロワー</h2>
@foreach($followers as $follower)
    <p>{{ $follower->name }}</p>
@endforeach
</body>
</html>
