@extends('layouts.app')

@section('content')
  <h1>Posts</h1>
  <hr>
  @if(count($posts) > 0)
    @foreach($posts as $post)
      <div class="well">
        <div class="row">
          <div class="col-md-4 col-sm-4">
            <img style="width:100%" src="/newapp/public/storage/cover_images/{{$post->cover_image}}">
          </div>
          <div class="col-md-4 col-sm-4">
            <h3><a href="/newapp/public/posts/{{$post->id}}">{{$post->title}}</a></h3>
            <p>{{$post->created_at}} by {{$post->user->name}}</p>
          </div>
        </div>
      </div>
      <br>
    @endforeach
    {{$posts->links()}}
  @else
    <p>No posts found</p>
  @endif
@endsection
