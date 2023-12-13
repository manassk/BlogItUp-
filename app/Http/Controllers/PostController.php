<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
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
            'description' => 'required|max:5000',
            'post_image' => 'required|mimes:jpg,jpeg,png,bmp,gif,svg,webp,pdf,docx|max:1024',
        ]);
        $user = Auth()->user();
        $userid = $user->id;
        $username = $user->name;
        
        
        $p = new Post;
        $p->title= $validatedData['title'];
        $p->description= $validatedData['description'];
        $p->user_name=$username;
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
        $post = Post::find($id);
        return view('posts.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validatedData = $request->validate([
            'title' => 'required|max:200',
            'description' => 'required|max:5000',
            'post_image' => 'required|mimes:jpg,jpeg,png,bmp,gif,svg,webp,pdf,docx|max:1024',
        ]);
        $user = Auth()->user();
        $userid = $user->id;
        $username = $user->name;

        $post = Post::find($id);
        $post->title= $validatedData['title'];
        $post->description= $validatedData['description'];
        $post->user_name=$username;
        $post->user_id=$userid;
        
        if($request->hasfile('post_image'))
        {
            $destination = 'uploads/images/'.$post->post_image;
            if(File::exists($destination))
            {
                File::delete($destination);
            }
            $file = $request->file('post_image');
            $extenstion = $file->getClientOriginalExtension();
            $filename = time().'.'.$extenstion;
            $file->move('uploads/images/', $filename);
            $post->post_image = $filename;
        }
        
        $post->update();

        session()->flash('message','A course was created');
        return redirect()->route('posts.show', ['id' => $post->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $post = Post::find($id);
        $post->delete();

        return redirect()->route('posts.index');
    }
    
}
