@extends('layouts.app')

@section('content')
<a href="/newapp/public/posts" class="btn">Go Back</a>
  <h1>{{$post->title}}</h1>
  <div>
    {{$post->body}}
  </div>
  <hr>
    <small>Written on {{$post->created_at}}</small>
  <hr>
  <a href="/newapp/public/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a>
  <div class="float-right">
  {!!Form::open(['action' => ['PostsController@destroy', $post->id],'method' => 'POST', 'class' =>'pull-right'])!!}
    {{Form::hidden('_method', 'DELETE')}}
    {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
  {!!Form::close()!!}
</div>
@endsection
