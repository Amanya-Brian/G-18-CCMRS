@extends('layouts.layout') 
  @section('content')
  

<h1>Welcome to CCMRS</h1>
        <h3>Officer Enrollment</h3>
        @if(session('status'))
          <div class="alert alert-success">
            {{ session('status') }}
          </div>
        @endif
        <div class="card">
          <div class="card-header text-center font-weight-bold">
            Enrol a new Officer
          </div>
          <div class="card-body">
            <form name="enroll-officer-form" id="enroll-officer-form" method="post" action="{{url('/storeOfficer')}}">
             @csrf
              <div class="form-group">
                <label>Username</label>
                <input type="text" id="username" name="username" class="form-control" required="">
              </div>
              <div class="form-group">
                <label>District</label>
                <input type="text" id="district" name="district" class="form-control" required="">
              </div>
              <div class="form-group">
                <label>Hospital</label>
                <input type="text" id="hospital" name="hospital" class="form-control" required="">
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>
 @endsection

