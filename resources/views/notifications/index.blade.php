@extends('layouts.main')

@section('content')
    <h1>Notifications</h1>

    <ul>
        @foreach($notifications as $notification)
            <li>
                {{ $notification->data['name'] }} commented on your post.
            </li>
        @endforeach
    </ul>
@endsection