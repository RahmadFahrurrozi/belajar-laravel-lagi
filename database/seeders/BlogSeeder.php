<?php

namespace Database\Seeders;

use App\Models\Blog;
// use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('blogs')->truncate();
        Blog::factory()
            ->count(50)
            ->create();


        //insert single data
        // DB::table('blogs')->insert([
        //     'title' => 'Blog aja',
        //     'slug' => 'blog-aja',
        //     'description' => 'Ini adalah blog',
        //     'image' => 'blog-pertama.jpg',
        //     'content' => 'Ini adalah konten blog pertama',
        //     'author' => 'Maman',
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);
        //insert multiple data
        // $blogs = [];
        // for ($i = 1; $i <= 20; $i++) {
        //     $blogs[] = [
        //         'title' => 'Blog ke-' . $i,
        //         'slug' => 'blog-ke-' . $i,
        //         'description' => 'Ini adalah blog ke-' . $i,
        //         'image' => 'blog-ke-' . $i . '.jpg',
        //         'content' => 'Ini adalah konten blog ke-' . $i,
        //         'author' => Str::random(10),
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ];
        // }

        // DB::table('blogs')->insert($blogs);
    }
}
