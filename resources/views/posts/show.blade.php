@extends('layouts.main')  
@section('contents') 
<style>
    .container {
        max-width: 800px;
        margin: 20px auto;
    }

    .comment-section {
        border: 1px solid #ddd;
        border-radius: 8px;
        overflow: hidden;
    }

    .comment {
        padding: 10px;
        border-bottom: 1px solid #ddd;
        display: flex;
        align-items: center;
    }

    .comment-content {
        flex-grow: 1;
    }

    .comment-username {
        font-weight: bold;
        margin-bottom: 5px;
    }

    .comment-text {
        color: #333;
    }

    .comment-form {
        margin-top: 20px;
        display: flex;
        align-items: center;
    }

    .comment-input {
        flex-grow: 1;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        margin-right: 10px;
        margin-left: 10px;
    }

    .comment-btn {
        padding: 10px;
        background-color: #337CCF;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
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
.views{
    color:#337CCF;
    font-style:italic;
    font-size:13px;
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
.back-btn {
    background-color: #337CCF;
}

.btn-danger {
    background-color: #dc3545;
}

h1 {
        font-size: 24px;
        color: #333;
        margin-bottom: 15px;
    }
</style>
<div class="blog-card">
    <img src="{{ asset('uploads/images/'.$post->post_image)}}" alt="image" class="card-image">
    <div class="card-content">
        <p class="views">Views: {{ $post->views }}</p>
        <p class="user"><i>{{$post->user_name}} : </i> {{$post->title}}</p>
        <p class="description">Description: {{$post->description}}</p>
        
    </div>
    <a href="{{ url('edit/'.$post->id) }}" class="btn btn-success">Edit</a>
    <form method="post" action="{{ url('delete/'.$post->id) }}" style="display: inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
    </form>
    <a href="{{ route('posts.index') }}" class="btn back-btn">Back</a>
</div>
<div class="container">
    <h1>Comments:</h1>
    <div class="comment-section">
        <ul class="content-feed" id="comment-list">
            @foreach ($comments as $comment)
                <div class="comment">
                    <li class="post-card">
                        <div class="comment-content">
                            <div class="comment-username">{{ $comment->user->name }}</div>
                            <div class="comment-text">{{ $comment->comment }}</div>
                        </div>
                    </li>
                </div>
            @endforeach
        </ul>
    </div>

    <form id="comment-form">
        @csrf
        <label for="comment" class="form-label">Comment: </label>
        <input type="text" class="comment-input" name="comment" id="comment" placeholder="Write a comment">
        <button type="button" class="comment-btn" id="submit-comment">Comment</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function () {
        $('#submit-comment').click(function () {
            var comment = $('#comment').val();
            if (comment !== '') {
                $.ajax({
                    type: 'POST',
                    url: '{{ route('comments.store', ['postId' => $post->id]) }}',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'comment': comment
                    },
                    success: function (data) {
                        // Update the comment list with the new comment
                        $('#comment-list').append('<div class="comment"><li class="post-card"><div class="comment-content"><div class="comment-username">{{ Auth::user()->name }}</div><div class="comment-text">' + comment + '</div></div></li></div>');
                        // Clear the input field
                        $('#comment').val('');
                    },
                    error: function (data) {
                        console.log('Ajax request error:', data);
                    }
                });
            }
        });

        // Prevent form submission
        
    });
</script>
@endsection