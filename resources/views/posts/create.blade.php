@extends('layouts.main')  
@section('contents')
<style> 
body {
    font-family: 'Arial', sans-serif;
    background-color: #f8f9fa;
    margin: 0;
    padding: 0;
}

.create_form {
    max-width: 400px;
    margin: 20px auto;
    margin-top: 100px;
    padding: 30px;
    background-color: #ffffff;
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
}

form {
    display: flex;
    flex-direction: column;
}

label {
    display: block;
    margin-bottom: 8px;
    color: #495057;
    font-weight: bold;
}

input,
textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ced4da;
    border-radius: 4px;
    font-size: 14px;
    margin-bottom: 10px; 
}

.create_form input {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 4px;
}

input[type="file"] {
    padding: 8px;
}

button {
    border: none;
    border-radius: 4px;
    font-size: 16px;
    padding: 10px 10px;
    background-color: #87CEFA;;
    color: #fff;
    cursor: pointer;
    transition: background-color 0.3s;
}
button, [type=button], [type=reset], [type=submit] {
    -webkit-appearance: button;
    background-color: #5FBDFF;
    background-image: none;
}

.create_form button:hover {
    background-color: #45a049;
}

a {
    color: #333;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}
</style>

<div class = "create_form">
<form method="POST" action="{{route('posts.store')}} " enctype="multipart/form-data">
    @csrf

    @if ($errors->any())
		        
		        <div>
		            <p style="color:red">Error:
		                <ul>
		                    @foreach ($errors->all() as $error)
		                        <li style="color:red">{{$error}}</li>
		                    @endforeach
		                </ul>
		            </p>
        </div>
       @endif 
    <ul >
        <li><label for="title">Title</label><input type="text" id="title" name="title" value = "{{old('title')}}" placeholder = "Enter title here..."/> </li>
        <li><label for="description">Description</label><textarea name="description" id="description" value = "{{old('description')}}" placeholder = "Enter description here..."></textarea></li>
        <li><label for="image">Image</label><input type="file" name="post_image" /></li>
        
        <button type="submit" class="btn btn-primary" >Submit</button>
    </ul>
    <a href="{{route('posts.index')}}">cancel</a>
</form>
</div>
  
  
@endsection