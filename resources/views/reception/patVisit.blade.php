
@extends('reception.master')

@section('title', 'desk login')


@section('content')

    <table>
        <tr> <td>Name:</td><td>{{ $input["name"] }}</td> </tr>
        <tr> <td>Age:</td><td>{{ $input["age"] }}</td> </tr>
        <tr> <td>Gender:</td><td>{{ $input["gender"] }}</td> </tr>
        <tr> <td>Guardian Name:</td><td>{{ $input["gname"] }}</td> </tr>
        <tr> <td> address </td><td>{{ $input["house"]}} HOUSE<br> {{ $input["street"] ."   ". $input["lm"]  }} <br> {{$input["pc"]}} </td> </tr>
    </table>

    <input type="text" id="specSelect" value="-select-" list="specls">
    <datalist id="specls">
        <option value="GP">
        <option value="ENT">
        <option value="SRG">
    </datalist>

    <ul id="Doctors"></ul>

    <script src="../js/jquery.js"></script>
    <script src="../js/reception/patVisit.js"></script>

@endsection
