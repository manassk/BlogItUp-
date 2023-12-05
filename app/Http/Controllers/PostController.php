<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $posts = Post::all();
        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'title' => 'required|max:200',
            'description' => 'required|max:500',
            'post_image' => 'required|mimes:jpg,jpeg,png,bmp,gif,svg,webp,pdf,docx|max:1024',
        ]);
        $user = Auth()->user();
        $userid = $user->id;
        
        
        $p = new Post;
        $p->title= $validatedData['title'];
        $p->description= $validatedData['description'];
        $p->user_id=$userid;
        if($request->hasfile('post_image'))
        {
            $file = $request->file('post_image');
            $extenstion = $file->getClientOriginalExtension();
            $filename = time().'.'.$extenstion;
            $file->move('uploads/images/', $filename);
            $p->post_image = $filename;
        }
        
        $p->save();

        session()->flash('message','A course was created');
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $post = Post::findOrFail($id);
        
        return view('posts.show', ['post' => $post]);
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
