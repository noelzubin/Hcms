
@extends('doctor.master')

@section('title', 'doctor signup')


@section('content')

    <form action="signup" method="POST">
        <label for="name">Username:</label>
        <input type="text" name="name">
        <label for="password">password:</label>
        <input type="password" name="password">
        <input type="text" name="speciality" id="speciality" value="ENT" list="specls">
           <datalist id="specls">
               <option value="GP">
               <option value="ENT">
               <option value="SRG">
           </datalist>
        <label for="hospitals">hospital Name:</label>
        {{--<input type="text" name="hospitals">--}}
        @foreach( $hosp as $hospital )
            <input type="radio" name="hospital" value="{{$hospital->id}}"> {{$hospital->name}} <br>
        @endforeach
        {{ $hosp[0]->name }}
        <input type="submit" value="submit">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                @if(trim($error != ""))
                    <li> {{ $error }}...<li>
                @endif
            @endforeach
        @endif
    </form>

@endsection
