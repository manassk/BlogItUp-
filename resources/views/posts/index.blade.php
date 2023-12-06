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
    margin: 0;
    padding: 0;
    text-align: center;
    font-size:20px;
}
.container{
    display: flex;
    flex-direction: column;
    margin-left: 5px;

}

.content-feed {
    width: 100%;
    margin: 20px auto;
    display: flex;
    flex-direction: row;
  
    flex-wrap: wrap;
    gap: 30px;
}

.post-card {
    max-width: 300px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    overflow: hidden;

}

.card-image {
    width: 100%;
    min-height: 80%;
    border-radius:3px;
    border-bottom: 1px solid #ddd;
}

.card-title {
    display: block;
    margin: 10px;
    text-decoration: none;
    color: #385898;
    font-weight: bold;
}
.heading{
    display: block;
    margin: 10px;
    text-decoration: none;
    color: #7D7C7C;
    font-weight: bold;
}
.time{
    margin: 10px;
    text-decoration: none;
    color: #7D7C7C;
    font-size:8px;    
}

.card-title:hover {
    background-color: #f0f0f0;
}
</style>
<header>
    <h1>Feed</h1>
</header>
    
  <p><a href="{{route('posts.create')}}">Create a post</a></p>
  
  <div class= "container">
    <ul class="content-feed">
        @foreach ($posts as $post)
            <li class="post-card">
                <h1 class="heading"><a href="{{ route('posts.userPost', ['id' => $post->id])}}">{{$post->user_name}} </a><span class="time">Posted at: {{$post->created_at}}</span></h1>
                <img src="{{ asset('uploads/images/'.$post->post_image) }}" alt="image" class="card-image">
                
                <a href="{{ route('posts.show', ['id' => $post->id]) }}" class="card-title">{{ $post->title }}</a>
            </li>
        @endforeach
    </ul>
  </div>
  
@endsection