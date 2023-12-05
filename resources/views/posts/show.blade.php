@extends('layouts.main')  
@section('contents') 
<ul>
    <li>Title = {{$post->title}} </li>
    <li>Description = {{$post->description}}</li>
    <li><img src="{{ asset('uploads/images/'.$post->post_image)}}" alt="image"></li>
    <li>Username = {{$post->user_name}}</li>
</ul>
  
  
@endsection