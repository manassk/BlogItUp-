@extends('layouts.main')
@section('contents')
<style>
body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f0f2f5;
}

header {
    background-color: #6DB9EF;
    color: #fff;
    padding: 10px;
    text-align: center;
    font-size:20px;
}

.content-feed {
    max-width: 400px;
    margin: 20px auto;
    list-style: none;
    display: grid;
    gap: 20px;
}

.post-card {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.card-image {
    width: 100%;
    height: auto;
    border-bottom: 1px solid #ddd;
}

.card-title {
    display: block;
    margin: 10px;
    text-decoration: none;
    color: #385898;
    font-weight: bold;
}

.card-title:hover {
    background-color: #f0f0f0;
}
</style>
<header>
    <h1>Feed</h1>
</header>

  <p><a href="{{route('posts.create')}}">Create a post</a></p>
  
  <ul class="content-feed">
        @foreach ($posts as $post)
            <li class="post-card">
                <img src="{{ asset('uploads/images/'.$post->post_image) }}" alt="image" class="card-image">
                <a href="{{ route('posts.show', ['id' => $post->id]) }}" class="card-title">{{ $post->title }}</a>
            </li>
        @endforeach
    </ul>
@endsection