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
            <input type="number" min=0 max="1500" name="bldp" placeholder="ps">
            <input type="submit" value="&rarr;">
        </form>
    </div>

<script type="text/javascript" src="../js/jquery.js"></script>

</body>
</html>