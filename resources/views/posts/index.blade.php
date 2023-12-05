@extends('layouts.main')
@section('contents')
<h1>Posts</h1>
  <p><a href="{{route('posts.create')}}">Create a post</a></p>
  <ul class = "courses-list ">
    @foreach ($posts as $post)
        <li><a href="{{route('posts.show' , [ 'id' => $post->id])}}">{{ $post->title }}</a></li>
    @endforeach
  </ul>
@endsection