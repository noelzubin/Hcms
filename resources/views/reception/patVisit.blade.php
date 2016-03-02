<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>patient login</title>
    <link rel="stylesheet" href="../css/desk/patvisit.css">
</head>
<body>
    <div id="header">
        <section id="company">Tacoe</section>
        <section id="title">{{ $input["name"] }}</section>
        <section id="logout"><a href="logout">Logout</a></section>
    </div>

    <div id="specialitySelect">
        <label for="specSelect">Speciality</label>
        <input type="text" id="specSelect" value="" list="specls">
        <datalist id="specls">
            <option value="GP">
            <option value="ENT">
            <option value="SRG">
        </datalist>
        <input type="button" id="getdoctors" value="&rarr;">
    </div>
    <div id="DocError"></div>
    <form action="addPat" method="POST" id="Doctors">
        <input type="hidden" name="patId" value="{{ $input["uid"] }}">
        <div id="docts"></div>
    </form>

    <script src="../js/jquery.js"></script>
    <script src="../js/desk/patVisit.js"></script>
</body>
</html>

{{--<table>--}}
        {{--<tr> <td>Name:</td><td>{{ $input["name"] }}</td> </tr>--}}
        {{--<tr> <td>Age:</td><td>{{ $input["age"] }}</td> </tr>--}}
        {{--<tr> <td>Gender:</td><td>{{ $input["gender"] }}</td> </tr>--}}
        {{--<tr> <td>Guardian Name:</td><td>{{ $input["gname"] }}</td> </tr>--}}
        {{--<tr> <td> address </td><td>{{ $input["house"]}} HOUSE<br> {{ $input["street"] ."   ". $input["lm"]  }} <br> {{$input["pc"]}} </td> </tr>--}}
    {{--</table>--}}

    {{--<input type="text" id="specSelect" value="" list="specls">--}}
    {{--<datalist id="specls">--}}
        {{--<option value="GP">--}}
        {{--<option value="ENT">--}}
        {{--<option value="SRG">--}}
    {{--</datalist>--}}

    {{--<div id="DocError"></div>--}}

    {{--<form action="addPat" method="POST" id="Doctors">--}}
        {{--<input type="hidden" name="patId" value="{{ $input["uid"] }}">--}}
        {{--<div id="docts"></div>--}}
    {{--</form>--}}

    <script src="../js/jquery.js"></script>
    <script src="../js/desk/patVisit.js"></script>

