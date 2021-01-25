@extends('layouts.layout') 
  @section('content')
  
@if(isset(Auth::user()->email))
  <div class="alert alert-danger success-block">
   <strong>Welcome {{ Auth::user()->email }}</strong>
   <br />
   <a href="{{ url('/main/logout') }}">Logout</a>
  </div>
@else
  <script>window.location = "/main";</script>
@endif
    
@endsection
