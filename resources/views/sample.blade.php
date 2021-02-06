@extends('layouts.app') 

  @section('content')
  
        <h1>Welcome to CCMRS</h1>
        <h3>Graph showing the curve of patient enrollment</h3>

        <div>

          {!! $chart->container() !!}

          
          <script src="{{$chart->cdn()}}"></script>
          {!! $chart->script() !!}
        </div>
       

@endsection
