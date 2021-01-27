@extends('layouts.layout') 
  @section('content')
  
        <h1>Welcome to CCMRS</h1>
        <h3>Patient List</h3>
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">Patient Id</th>
              <th scope="col">Patient Name</th>
              <th scope="col">Gender</th>
              <th scope="col">Category</th>
              <th scope="col">Identification Date</th>
            </tr>
          </th>
          @foreach ($patients as $patient)
          <tr>
          <td>{{ $patient->patientId }}</td>
          <td>{{ $patient->patientName }}</td>
          <td>{{ $patient->gender }}</td>
          <td>{{ $patient->category }}</td>
          <td>{{ $patient->date_of_identification }}</td>
          </tr>
          @endforeach
          </table>

@endsection
