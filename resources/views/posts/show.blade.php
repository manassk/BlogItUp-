@extends('layouts.main')  
@section('contents') 
<style>
.blog-card {
    max-width: 500px;
    margin: 20px auto;
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.card-image {
    width: 100%;
    height: auto;
    border-bottom: 1px solid #ddd;
    border-radius:10px;
}

.card-content {
    padding: 20px;
}

.user {
    font-weight: bold;
    color: #333;
}

.title {
    font-size: 18px;
    font-weight: bold;
    color: #333;
}

.description {
    color: #555;
}



</style>
<div class="blog-card">
    <img src="{{ asset('uploads/images/'.$post->post_image)}}" alt="image" class="card-image">
    <div class="card-content">
        <p class="user"><i>{{$post->user_name}} : </i> {{$post->title}}</p>
        
        <p class="description">Description: {{$post->description}}</p>
    </div>
</div>
  
  
@endsection