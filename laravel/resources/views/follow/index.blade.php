@extends('layouts.app')
@section('title', Auth::user()->name .'の友達一覧')
@section('content')
    <div class="container">
        <h1 class="fs-3 mb-4">{{ Auth::user()->name }}さんの友達一覧</h1>

        {{-- ✅ フォロー一覧 --}}
        <div class="card mb-4">
            <div class="card-header bg-success text-white">
                フォローしている人（{{ $followings->count() }}人）
            </div>
            <ul class="list-group list-group-flush">
                @forelse($followings as $following)
                    <li class="list-group-item">{{ $following->name }}</li>
                @empty
                    <li class="list-group-item text-muted">まだ誰もフォローしていません</li>
                @endforelse
            </ul>
        </div>

        {{-- ✅ フォロワー一覧 --}}
        <div class="card">
            <div class="card-header bg-primary text-white">
                フォローされている人（{{ $followers->count() }}人）
            </div>
            <ul class="list-group list-group-flush">
                @forelse($followers as $follower)
                    <li class="list-group-item">{{ $follower->name }}</li>
                @empty
                    <li class="list-group-item text-muted">まだフォロワーがいません</li>
                @endforelse
            </ul>
        </div>
    </div>
@endsection

