@extends('layouts.app')

@section('content')
  <h1>Posts</h1>
  <hr>
  @if(count($posts) > 0)
    @foreach($posts as $post)
      <div class="well">
        <h3><a href="/newapp/public/posts/{{$post->id}}">{{$post->title}}</a></h3>
        <p>{{$post->created_at}} by {{$post->user->name}}</p>
      </div>
    @endforeach
    {{$posts->links()}}
  @else
    <p>No posts found</p>
  @endif
@endsection
