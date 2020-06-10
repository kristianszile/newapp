@extends('layouts.app')

@section('content')
<a href="/newapp/public/posts" class="btn btn-secondary">Go Back</a>
<br>
<br>
<h1>Comment Section</h1>
<hr>
  @if(count($comments) > 0)
    @foreach($comments as $comment)
      @if($comment->post_id == $post_id)
        <h3>{{$comment->comment}}</h3>
        <h5>Commented by {{$comment->name}}</h5>
        <p>{{$comment->created_at}}</p>
        <br>
      @endif
    @endforeach
  @endif
  @if(!Auth::guest())
  {!! Form::open(['action'=>'CommentsController@store','method' => 'POST'])  !!}
    {{Form::label('comment','Comment')}}
    {{Form::textarea('comment','',['class' => 'form-control','placeholder'=>'Type something nice'])}}
    <input type="hidden" value="{{$post_id}}" name="post_id">
    {{Form::submit('Submit comment', ['class' => 'btn btn-primary'])}}
  {!!Form::close()!!}
  @endif
@endsection
