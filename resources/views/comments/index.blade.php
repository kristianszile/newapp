@extends('layouts.app')

@section('content')
  <h1>Comments</h1>
  @if(count($comments) > 0)
    @foreach($comments as $comment)
      <div class="well">
        <h3>{{$comment->comment}}</h3>
        <p>Commented by {{$comment->name}}</p>
      </div>
    @endforeach
  @else
    <p>No comments found</p>
  @endif
  <div class="form-group container">
    {{Form::label('coment','Coment')}}
    {{Form::textarea('coment','',['class' => 'form-control','placeholder'=>'Type something nice'])}}
    <br>
    {{Form::submit('Submit comment', ['class' => 'btn btn-primary'])}}
  </div>
@endsection
