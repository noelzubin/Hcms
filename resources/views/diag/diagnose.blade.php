<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title> diagnose </title>
</head>
<body>
    <link rel="stylesheet" href="../css/diag/diagnose.css">
    <div id="header">
        <section id="company">Tacoe</section>
        <section id="title">{{ $patient->name }}</section>
        <section id="logout"><a href="logout">Logout</a></section>
    </div>
    <div id="container">
        <form action="diagnosed" method="POST">
            <span id="bldpLabel">Blood Pressure: </span>
            <input type="hidden" name="patId" value="{{ $patient->uid }}">
            <input type="hidden" name="mrId" value="{{ $id }}">
            <input type="hidden" name="docId" value="{{ $docId }}">
            <input type="number" min=0 max="1500" value="120" name="bldp" placeholder="ps">
            <input type="submit" value="&rarr;">
        </form>
    </div>

<script type="text/javascript" src="../js/jquery.js"></script>
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

</body>
</html>