<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;
use App\Models\Reply;
use Illuminate\Support\Facades\DB;
use Faker\Factory as FakerFactory;

class DummyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ユーザー10人生成
        User::factory()->count(10)->create();
        $users = User::all();

        // 各ユーザー3個ずつ投稿
        $users->each(function ($user) {
            Post::factory()->count(3)->create(['user_id' => $user->id])
                ->each(function ($post) use ($user) {
                    // 各投稿に2〜5件の返信
                    Reply::factory()->count(rand(2,5))->create([
                        'post_id' => $post->id,
                        'user_id' => User::inRandomOrder()->first()->id,
                    ]);
                });
        });

        // 各ユーザーが他のユーザー数人をフォローする
        foreach ($users as $user) {
            // 自分以外からランダムに3〜5人フォロー
            $follows = $users->where('id', '!=', $user->id)->random(rand(3, 5));

            foreach ($follows as $followedUser) {
                DB::table('user_relations')->insertOrIgnore([
                    'following_id' => $user->id,
                    'followed_id' => $followedUser->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
