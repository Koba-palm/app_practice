<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReplyController extends Controller
{
    public function index()
    {
        return view('reply.index');
    }

    public function create($post_id)
    {
        $post = Post::find($post_id);
        return view('reply.create', compact('post'));
    }

    public function store(Request $request, $post_id)
    {
        $validated = $request->validate([
            'body' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        $imagePath = null;
        if ($request->hasFile('image')){
            $imagePath = $request->file('image')->store('images', 'public');
        }
        Reply::create([
            'user_id' => Auth::id(),
            'post_id' => $post_id,
            'body' => $validated['body'],
            'image_path' => $imagePath,
        ]);

        return redirect()->route('post.show', $post_id)->with('success', "返信を投稿しました！");
    }

    public function edit($reply_id)
    {
        $reply = Reply::find($reply_id);
        $post = Post::find($reply->post_id);
        if (Auth::id() != $reply->user_id) {
            return redirect()->route('post.index')->with('error', "投稿者本人のみ編集できます。");
        }
        return view('reply.edit', compact('reply', 'post'));
    }

    public function update(Request $request, $reply_id)
    {
        $validated = $request->validate([
            'body' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }
        $reply = Reply::find($reply_id);
        $reply->update([
            'body' => $validated['body'],
            'image_path' => $imagePath,
        ]);
        return redirect()->route('post.show', $reply->post_id);
    }
}
