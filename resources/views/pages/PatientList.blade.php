@extends('layouts.layout') 
  @section('content')
  
        <h1>Welcome to CCMRS</h1>
        <h3>Patient List</h3>
        <table border = "1">
          <tr>
          <td>Patient Id</td>
          <td>Patient Name</td>
          <td>Gender</td>
          <td>Category</td>
          <td>Identification Date</td>
          </tr>
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
