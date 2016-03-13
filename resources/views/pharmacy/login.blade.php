<!DOCTYPE html>
<html>
    <head>
        <title>HCMS</title>
        <link rel="stylesheet" href="../css/phar/loggin.css">
    </head>

    <body>
        <section id="card">
            <div id="left">
                <section id="quote">Restore a man to his health, his purse lies open to thee. ~Robert Burton</section>
                <img src="../css/resources/doctor.png" alt="">
                <section id="title"> PHARMACIES </section>
                <section id="home"><a href="/phar">Home</a> </section>
            </div>
            <form action="#" method="POST" id="right">
                <input id="username" type="number" min="0" name="id" placeholder="id">
                <input id="password" type="password" name="password" placeholder="password">
                <input id="submit" type="submit" value="Login">
                <a href="signup">Sign Up</a>
            </form>
        </section>
    </body>
    <div id="container"></div>
    {{--notifications--}}
    <link rel="stylesheet" href="../css/notif.css">
    <div id="notifications">
        @if(session("error"))
            <section id="error"> {{ session("error") }} </section>
        @elseif($errors->any())
            <section id="error"> {{ $errors->all()[0] }} </section>
        @endif
    </div>
    <script src="../js/jquery.js"></script>
    <script>
        $(document).ready(function(){
            setTimeout(function(){
                if($("#notifications section").html() != undefined) {
                    $("#notifications").toggleClass("notifShow");
                    setTimeout(function () {
                        $("#notifications").toggleClass("notifShow");
                    }, 3000)
                }
            },300);
        });
    </script>
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