@extends('layouts.main')  
@section('contents') 

<div >
<form method="POST" action="{{route('posts.store')}} " enctype="multipart/form-data">
    @csrf
    
    @if ($errors->any())
		        
		        <div>
		            <p>Error:
		                <ul>
		                    @foreach ($errors->all() as $error)
		                        <li>{{$error}}</li>
		                    @endforeach
		                </ul>
		            </p>
        </div>
       @endif 
    <ul >
        <li>Title <input type="text" name="title" value = "{{old('title')}}"/> </li>
        <li>Description <input type="text" name="description" value = "{{old('description')}}"/></li>
        <li>Image <input type="file" name="post_image" /></li>
        
        <button type="submit" class="btn btn-primary" >Submit</button>
    </ul>
    <a href="{{route('posts.index')}}">cancel</a>
</form>
</div>
  
  
@endsection