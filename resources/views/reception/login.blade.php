<!DOCTYPE html>
<html>
<head>
    <title>HCMS</title>
    <link rel="stylesheet" href="../css/desk/loggin.css">
</head>

<body>
<section id="card">
    <div id="left">
        <section id="quote">Isn’t it a bit unnerving that doctors call what they do “practice” ~George Carlin</section>
        <img src="../css/resources/receptionist.png" alt="">
        <section id="title"> THE DESK GUY </section>
        <section id="home"><a href="/phar">Home</a> </section>
    </div>
    <form action="#" method="POST" id="right">
        <input id="username" type="number" name="id" min="0" max="999999999" placeholder="desk id">
        <input id="password" type="password" name="password" placeholder="password">
        <input id="submit" type="submit" value="Login">
    </form>
</section>
</body>
<div id="container"></div>
</html>


        {{--<form action="login" method="POST">--}}
            {{--<label for="id">id:</label>--}}
            {{--<input type="text" name="id">--}}
            {{--<label for="password">password:</label>--}}
            {{--<input type="password" name="password">--}}
            {{--<input type="submit" value="submit">--}}
            {{--@if ($errors->any())--}}
                {{--@foreach ($errors->all() as $error)--}}
                    {{--<li> {{ $error }}...<li>--}}
                {{--@endforeach--}}
            {{--@endif--}}
        {{--</form>--}}

