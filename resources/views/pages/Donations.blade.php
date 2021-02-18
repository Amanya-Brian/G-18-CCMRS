
  <!doctype html>
<html lang="en">
  <head>
    <title>Donations Graph</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

</head>
  <body>
    {{-- {{$allmonths}} --}}
    <div class="row mt-4">
      <form action="{{route("donationsgraph")}}" method="POST">
        @csrf
        <div class="">
          <label for="">SelectMonth</label>
          <div class="form-group-">
            <select name="month">
              @if (count($allmonths))
              @foreach ($allmonths as $eachmonth)
              <option value={{$eachmonth->Month}}>{{$eachmonth->Month}}</option>
              @endforeach



              @endif

            </select>
          </div>
        </div>
        <div class="col-md-12 d-flex flex-column m-4">
          <button class="btn-primary btn-block" type="submit">DisplayGraph</button>
        </div>
      </form>
    </div>
    <h2 style="text-align: center;">A Graph of donations in {{$default[0]->Month}}</h2>
    <div class="container-fluid p-5">
    <div id="barchart_material" style="width: 100%; height: 500px;"></div>
    </div>

    <script type="text/javascript">

      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['donor', 'amount']

            @php
              foreach($donations as $donation)
              {
                //dd($donation);
                echo ",['".$donation->donor."',".$donation->amount."]";
              }

              @endphp
          ]);




        options = {
          chart: {
            title: 'Bar Graph | Donations',
            subtitle: 'Donor, and Amount',
          },
          bars: 'vertical'
        };
        var chart = new google.charts.Bar(document.getElementById('barchart_material'));
        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
    <button type="button" class="btn btn-link"><a href="{{ url('/') }}">Home</a></button>

</body>
</html>
