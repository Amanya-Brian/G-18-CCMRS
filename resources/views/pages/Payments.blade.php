<h1>Welcome</h1>
<form action="">
 <label for="">Select Year </label>
 <select name="year" id="">
 @if(count($allmonths))
   @foreach($allmonths as $month)
   <option value={{$month->Month}}>{{$month->Month}}</option>
   @endforeach
   @endif
   
 </select>
</form>