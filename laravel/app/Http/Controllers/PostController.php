<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->latest()->get(); //with(user)でユーザー情報も一緒に。latest()で新しい順に取得。
        return view('post.index', compact('posts'));
    }

    public function create()
    {
        return view('post.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'  //画像ファイルのみ許可
        ]);

        $imagePath = null;
        if ($request->hasFile('image')){
            $imagePath = $request->file('image')->store('images', 'public');
        }   //$request->file('image') → name="image" のフォーム入力からアップロードされたファイルを取得
            //->store('images', 'public') → storage/app/public/images/ にファイルを保存
            //$imagePath に保存されたファイルのパスが返る（例: "images/abc123.jpg"）

        Post::create([
            'user_id' => Auth::id(), // ログインしているidを取得
            'title' => $validated['title'],
            'body' => $validated['body'],
            'image_path' => $imagePath,
        ]);

        return redirect()->route('post.index')->with('success', 'ブログを投稿しました！');
    }

    public function edit($id)
    {
        $post = Post::find($id);
        return view('post.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $imagePath = null;
        if ($request->hasFile('image')){
            $imagePath = $request->file('image')->store('images', 'public');
        }

        $post = Post::find($id);
        $post->update([
            'title' => $validated['title'],
            'body' => $validated['body'],
            'image_path' => $imagePath
        ]);

        return redirect()->route('post.index');
    }

    public function delete($id)
    {
        $post = Post::find($id);
        $post->delete();

        return redirect()->route('post.index');
    }

    public function show($id)
    {
        $post = Post::find($id);
        return view('post.show', compact('post'));

    }
}
