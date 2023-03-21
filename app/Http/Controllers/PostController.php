<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('posts', compact('posts'));
    }

    public function create()
    {
        $posts = [
            [
                'title' => 'title 3',
                'content' => 'content 3',
                'image' => 'image3',
                'likes' => 20,
                'is_published' => 1,
            ],
            [
                'title' => 'title 4',
                'content' => 'content 4',
                'image' => 'image4',
                'likes' => 70,
                'is_published' => 1,
            ]
        ];

        foreach ($posts as $post) {
            Post::create($post);
            dump('created');
        }
    }

    public function update()
    {
        $post = Post::find(6);
        dump($post->title);
        $post->update([
            'title' => 'UPDATED title 3',
            'content' => 'UPDATED content 3',
            'image' => 'UPDATED image3',
            'likes' => 80,
            'is_published' => 1,
        ]);
        dd('updated');
    }

    public function delete()
    {
        $post = Post::withTrashed()->find(1);
        $post->delete();
        dump('deleted');
    }

    public function firstOrCreate()
    {
        $post = Post::find(1);
        $anotherPost =  [
            'title' => 'some post',
            'content' => 'content 3',
            'image' => 'image3',
            'likes' => 20,
            'is_published' => 1,
        ];
        $p = Post::firstOrCreate(['title' => 'some post'], $anotherPost);
        dump($p);
    }

    public function updateOrCreate()
    {
        $anotherPost =  [
            'title' => 'some post 2',
            'content' => 'updated',
            'image' => 'updated',
            'likes' => 60,
        ];
        $p = Post::updateOrCreate(['title' => 'some post 2'], $anotherPost);
        dump($p);
    }
}
