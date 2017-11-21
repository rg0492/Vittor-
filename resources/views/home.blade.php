@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <form action ="user/search" method="post">
                {{  csrf_field() }}
                   <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Search User</label>

                            <div class="col-md-6">
                                <input id="searchuser" type="text" class="form-control" name="searchuser" 
                                 required autofocus>

                               
                            </div>
                        </div>
                        <input type="submit" value="Search">
                </form>



                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                  <table class="table">
                      <thead>
                          <th>First name</th>
                          <th>Last name</th>
                          <th>User name</th>
                          <th>Email</th>
                          <th>Gender</th>
                          <th>Action</th>

                      </thead>
                     @foreach($users as $user)
                      <tr>
                          <td>{{$user->first_name}}</td>
                          <td>{{$user->last_name}}</td>
                          <td>{{$user->username}}</td>
                          <td>{{$user->email}}</td>
                          <td> @if($user->gender) Male @else  Female @endif</td><td> 
                          <a href="/user/{{$user->id}}/edit" class="btn btn-primary">Edit</a> 
                                                  @if($user->id ==Auth::user()->id)

                          @else
                          
                         {!! Form::open(['method' => 'DELETE','route' => ['user.destroy', $user->id],'style'=>'display:inline']) !!}
                       {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                          {!! Form::close() !!}

                          </td>

                          @endif
                      
                      </tr>
                       @endforeach
                  </table>  

                  {{$users->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
