@extends('layouts.app')

@section('content')
<a href="/newapp/public/posts" class="btn btn-secondary">Go Back</a>
<a href="/newapp/public/comments/{{$post->id}}" class="btn btn-primary">Comment Section</a>
<hr>
  <h1>{{$post->title}}</h1>
    <img style="width:100%" src="/newapp/public/storage/cover_images/{{$post->cover_image}}">
    <br>
    <br>
  <div>
    <h4>Descripiton: {{$post->body}}</h4>
  </div>
    <p>{{$post->created_at}} by {{$post->user->name}}</p>
  @if(!Auth::guest())
    @if(Auth::user()->id == $post->user->id)
      <a href="/newapp/public/posts/{{$post->id}}/edit" class="btn btn-primary">Edit Text</a>
      <div class="float-right">
        {!!Form::open(['action' => ['PostsController@destroy', $post->id],'method' => 'POST', 'class' =>'pull-right'])!!}
          {{Form::hidden('_method', 'DELETE')}}
          {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
        {!!Form::close()!!}
      @endif

    @endif
</div>
@endsection
