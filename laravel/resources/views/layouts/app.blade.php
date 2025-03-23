<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My App')</title>

    {{-- Bootstrap CDN 読み込み --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- カスタムCSSで緑テーマに調整 --}}
    <style>
        body {
            background-color: #e8f5e9; /* 背景：薄緑 */
        }

        .navbar-green {
            background-color: #2e7d32; /* ヘッダー：濃い緑 */
        }

        .btn-green {
            background-color: #66bb6a;
            color: white;
        }

        .btn-green:hover {
            background-color: #43a047;
            color: white;
        }

        .card {
            background-color: #ffffff;
            border: 1px solid #c8e6c9;
        }
        .btn-xs {
            font-size: 0.6rem;
            padding: 0.1rem 0.4rem;
        }
    </style>
</head>
<body>

{{-- ナビバー --}}
<nav class="navbar navbar-expand-lg navbar-green navbar-dark mb-4">
    <div class="container d-flex justify-content-between align-items-center">
    {{-- 左側メニュー --}}
        <a class="navbar-brand" href="{{ route('post.index') }}">BlogApp</a>

    {{-- 右側メニュー --}}
        <div class="d-flex align-items-center gap-2 flex-wrap text-white">
            @auth
                <a href="{{ route('login.home') }}" class="text-white me-3">{{ Auth::user()->name }}</a>
                <form action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button class="btn btn-outline-light btn-sm">ログアウト</button>
                </form>
            @endauth

            @guest
                <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm">ログイン</a>
                <a href="{{ route('users.create') }}" class="btn btn-outline-light btn-sm">新規登録</a>
            @endguest
        </div>
    </div>
</nav>

<div class="container">
    @yield('content')
</div>

{{-- ✅ Bootstrap JS（必要なら） --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
