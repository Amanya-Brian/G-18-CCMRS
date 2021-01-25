@extends('layouts.layout') 
@section('content')

 <h1>Welcome to CCMRS</h1>
 <div class = "container box">
      <h3>LOGIN</h3>

      @if ($message = Session::get('error'))
      <div class="alert alert-danger alert-block">
       <button type="button" class="close" data-dismiss="alert">×</button>
       <strong>{{ $message }}</strong>
      </div>
      @endif
   
      @if (count($errors) > 0)
       <div class="alert alert-danger">
        <ul>
        @foreach($errors->all() as $error)
         <li>{{ $error }}</li>
        @endforeach
        </ul>
       </div>
      @endif
   
      <form method="post" action="{{ url('/login/checklogin') }}">
       {{ csrf_field() }}
       <div class="form-group">
        <label>Post</label>
        <input type="" name="username" class="form-control" />
       </div>
       <div class="form-group">
        <label>Enter Username</label>
        <input type="text" name="username" class="form-control" />
       </div>
       <div class="form-group">
        <label>Enter Password</label>
        <input type="password" name="password" class="form-control" />
       </div>
       <div class="form-group">
        <input type="submit" name="login" class="btn btn-primary" value="Login" />
       </div>
      </form>
 </div>
@endsection 
