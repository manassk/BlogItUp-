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
    margin-left: 30px;   
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
.create-post-btn {
        display: inline-block;
        padding: 10px 20px;
        background-color: #3490dc;
        color: #ffffff;
        text-decoration: none;
        border-radius: 5px;
        transition:  0.3s;
        margin-top:5px;
        margin-left:45.7%;
    }

.create-post-btn:hover {
        background-color: #2779bd;
    }
.pagination-container {
    display: flex;
    justify-content: center;
    margin-top: 20px;
    margin-bottom:10px;
}

.pagination {
    display: flex;
    list-style: none;
    padding: 0;
    margin: 0;
}

.pagination li {
    margin-right: 5px;
}

.pagination a,
.pagination span {
    display: inline-block;
    padding: 8px 12px;
    color: #007bff;
    background-color: #fff;
    border: 1px solid #dee2e6;
    text-decoration: none;
    cursor: pointer;
}


</style>
<header>
    <h1>Feed</h1>
</header>
<p><a href="{{route('posts.create')}}" class="create-post-btn">Create a post</a></p>
  
  
  <div class= "container">
    <ul class="content-feed">
        @foreach ($posts as $post)
            <li class="post-card">
                <h1 class="heading"><a href="{{ route('posts.userPost', ['id' => $post->user->id])}}">{{$post->user_name}} </a><span class="time">Posted at: {{$post->created_at}}</span></h1>
                <img src="{{ asset('uploads/images/'.$post->post_image) }}" alt="image" class="card-image">
                
                <a href="{{ route('posts.show', ['id' => $post->id]) }}" class="card-title">{{ $post->title }}</a>
            </li>
        @endforeach
    </ul>
  </div>
  <div class="pagination-container">{{ $posts->links() }}</div>
  
  
@endsection