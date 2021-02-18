@extends('layouts.layout') 
  @section('content')
  
        <h1>Welcome to CCMRS</h1>
        <h3>Patient List</h3>
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">Patient Id</th>
              <th scope="col">First Name</th>
              <th scope="col">Last Name</th>
              <th scope="col">Date Identified</th>
              <th scope="col">Gender</th>
              <th scope="col">Category</th>
              <th scope="col">Officer</th>
            </tr>
          </th>
          @foreach ($patients as $patient)
          <tr>
          <td>{{ $patient->patientId }}</td>
          <td>{{ $patient->fName }}</td>
          <td>{{ $patient->lName }}</td>
          <td>{{ $patient->date }}</td>
          <td>{{ $patient->gender }}</td>
          <td>{{ $patient->category }}</td>
          <td>{{ $patient->officer }}</td>
          
          </tr>
          @endforeach
          </table>
          <p>Total Patients: {{ $total }}  </p> 
          <button type="button" class="btn btn-link"><a href="{{ url('/') }}">Home</a></button>

@endsection
