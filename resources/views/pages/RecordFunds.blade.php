@extends('layouts.layout') 
  @section('content')
  
        <h1>Welcome to CCMRS</h1>
        <h3>Record Funds Here</h3>
        @if(session('status'))
          <div class="alert alert-success">
            {{ session('status') }}
          </div>
        @endif
        <div class="card">
          <div class="card-header text-center font-weight-bold">
            Record Monthly Funds
          </div>
          <div class="card-body">
            <form name="record-funds-form" id="record-funds-form" method="post" action="{{url('/storefunds')}}">
             @csrf
              <div class="form-group">
                <label>Amount</label>
                <input type="text" id="amount" name="amount" class="form-control" required="">
              </div>
              <div class="form-group">
                <label>Date</label>
                <input type="date" id="amount" name="month" class="form-control" required >
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>
@endsection
