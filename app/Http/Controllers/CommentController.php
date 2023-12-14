<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Notifications\CommentNotification;
use Illuminate\Support\Facades\Notification;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $comments = Comment::with('user')->get();;
        
        return view('courses.show', ['comments' => $comments]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    public function notify()
    {
        //
        $user = User::first();
        auth()->user()->notify(new CommentNotification($user));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $postId)
    {
        //
        $validatedData = $request->validate([
            'comment' => 'required|max:200',
        ]);

        $user = Auth()->user();
        $userid = $user->id;
        $username = $user->name;
        
        
        
        $c = new Comment;
        $c->comment= $validatedData['comment'];
        $c->user_id=$userid;
        $c->post_id = $postId;
        $c->save();
        $post = Post::find($postId);
        $postOwner = $post->user;
        if ($postOwner) {
            Notification::send($postOwner, new CommentNotification($username, $postId));
        }
        if ($request->ajax()) {
            return response()->json(['success' => true, 'comment' => $post->comment]);
        }
        return redirect()->route('posts.show', ['id' => $postId]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $comment = Comment::findOrFail($id);
        
        return view('courses.show', ['comment' => $comment]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
