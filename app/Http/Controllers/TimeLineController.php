<?php
namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View; 

class TimeLineController extends Controller
{
    public function index(): View
    {
        
        $posts = Post::with('user')
            ->latest()
            ->paginate(5);

        return view('timeline', compact('posts'));
    }

    public function postShow($postId): View
    {
        $post = Post::with('user', 'comments.user')->findOrFail($postId);

        return view('post.show', compact('post'));
    }

    public function ranking()
    {
        $users = User::withCount([
            'posts as total_posts_likes' => function ($query) {
                $query->withCount('likes');
            },
            'comments as total_comments_likes' => function ($query) {
                $query->withCount('likes');
            }
        ])
            ->get()
            ->each(function ($user) {
                $user->total_likes = $user->total_posts_likes + $user->total_comments_likes;
            })
            ->sortByDesc('total_likes')
            ->values()
            ->take(10);

        return view('ranking', compact('users'));
    }
}

