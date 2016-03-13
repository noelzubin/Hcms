<!DOCTYPE html>
<html>
<head>
    <title>HCMS</title>
    <link rel="stylesheet" href="../css/doctor/signup.css">
</head>

<body>
<section id="card">
    <div id="left">
        <section id="quote">Restore a man to his health, his purse lies open to thee. ~Robert Burton</section>
        <img src="../css/resources/doctor.png" alt="">
        <section id="title"> THE DOCTOR </section>
        <section id="home"><a href="/doctor">Home</a> </section>
    </div>
    <form action="signup" method="POST" id="right">
        <input id="username" type="text" name="name" placeholder="username">
        <input id="password" type="password" name="password" placeholder="password">
        <input placeholder="speciality" type="text" name="speciality" id="speciality" value="" list="specls">
        <datalist id="specls">
            <option value="GP">
            <option value="ENT">
            <option value="SRG">
        </datalist>
        <input id="submit" type="submit" value="Signup">
        <input type="hidden" name="hospital" i value="{{ session("hospid") }}" >
        <a href="login">Login</a>
    </form>
</section>
</body>
<div id="container"></div>
</html>





        {{--<input type="text" name="speciality" id="speciality" value="" list="specls">--}}
           {{--<datalist id="specls">--}}
               {{--<option value="GP">--}}
               {{--<option value="ENT">--}}
               {{--<option value="SRG">--}}
           {{--</datalist>--}}
        {{--<input type="hidden" name="hospital" i value="{{ session("hospid") }}" >--}}
        {{--<input type="submit" value="submit">--}}
        {{--@if ($errors->any())--}}
            {{--@foreach ($errors->all() as $error)--}}
                {{--@if(trim($error != ""))--}}
                    {{--<li> {{ $error }}...<li>--}}
                {{--@endif--}}
            {{--@endforeach--}}
        {{--@endif--}}
    {{--</form>--}}

