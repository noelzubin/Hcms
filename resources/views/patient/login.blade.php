<!DOCTYPE html>
<html>
    <head>
        <title>HCMS</title>
        <link rel="stylesheet" href="../css/patient/loggin.css">
    </head>

    <body>
        <section id="card">
            <div id="left">
                <section id="quote">Restore a man to his health, his purse lies open to thee. ~Robert Burton</section>
                <img src="../css/resources/patient.png" alt="">
                <section id="title"> AWESOME ME </section>
                <section id="home"><a href="/">Home</a> </section>
            </div>
            <form action="#" method="POST" id="right">
                <input id="username" type="text" name="name" placeholder="adhar name">
                <input id="password" type="password" name="password" placeholder="password">
                <input id="submit" type="submit" value="Login">
                <a href="signup"> Sign Up </a>
            </form>
        </section>
    </body>
    <div id="container"></div>
</html>

{{--<form action="login" method="POST">--}}
    {{--<label for="usrname">Username:</label>--}}
    {{--<input type="text" name="name">--}}
    {{--<label for="password">password:</label>--}}
    {{--<input type="password" name="password">--}}
    {{--<input type="submit" value="submit">--}}
    {{--@if ($errors->any())--}}
        {{--@foreach ($errors->all() as $error)--}}
            {{--<li> {{ $error }}...<li>--}}
        {{--@endforeach--}}
    {{--@endif--}}
{{--</form>--}}
{{--<br> <a href="signup">Signup</a>--}}