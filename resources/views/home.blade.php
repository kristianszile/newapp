@extends('layouts.app')

@section('content')
<br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h3>Dashboard</h3></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h3>Your Posts</h3>
                    @if(count($posts)>0)
                    <table class="table table-striped">
                      <tr>
                        <th>Title</th>
                        <th></th>
                        <th></th>
                      </tr>
                      @foreach($posts as $post)
                        <tr>
                          <td>{{$post->title}}</td>
                          <td><a href="/newapp/public/posts/{{$post->id}}/edit" class="btn btn-primary">Edit Text</a></td>
                          <td>
                            {!!Form::open(['action' => ['PostsController@destroy', $post->id],'method' => 'POST', 'class' =>'pull-right'])!!}
                              {{Form::hidden('_method', 'DELETE')}}
                              {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                            {!!Form::close()!!}
                          </td>
                        </tr>
                      @endforeach
                    </table>
                    @else
                    <hr>
                    <h4>You Have No Posts :(</h4>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
