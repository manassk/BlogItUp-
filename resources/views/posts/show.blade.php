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
.btn {
    display: inline-block;
    padding: 8px 16px;
    margin: 8px;
    text-decoration: none;
    color: #fff;
    border-radius: 4px;
    cursor: pointer;
}

.btn-success {
    background-color: #28a745;
}

.btn-danger {
    background-color: #dc3545;
}


</style>
<div class="blog-card">
    <img src="{{ asset('uploads/images/'.$post->post_image)}}" alt="image" class="card-image">
    <div class="card-content">
        <p class="user"><i>{{$post->user_name}} : </i> {{$post->title}}</p>
        
        <p class="description">Description: {{$post->description}}</p>
    </div>
    <a href="{{ url('edit/'.$post->id) }}" class="btn btn-success">Edit</a>
    <form method="post" action="{{ url('delete/'.$post->id) }}" style="display: inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
    </form>
    
</div>
  
  
@endsection