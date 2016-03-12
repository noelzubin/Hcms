<!DOCTYPE html>
<html>
<head>
    <title>HCMS</title>
    <link rel="stylesheet" href="../css/patient/home.css">
</head>

<body>

    <div id="header">
        <section id="company">Tacoe</section>
        <section id="title"> {{ $patient->name }} </section>
        <section id="logout"><a href="patient/logout">Logout</a></section>
    </div>

    <div id="sidebar">
        <section id="history" class="selected">History</section>
        <section id="diagnostics">Diagnostics</section>
    </div>



    <div id="treat1" class="">
        <div class="title">
            Patient details:
        </div>
        <div class="dataContainer">
            <table>
                <tr><td>Name:</td><td> {{ $patient->name }}</td></tr>
                <tr><td>Age:</td><td>{{ $patient->age }}</td></tr>
                <tr><td>Gender:</td><td>{{ $patient->gender }}</td></tr>
                <tr><td>Guardian Name:</td><td>{{ $patient->gname }}</td></tr>
                <tr><td>Blood Group:</td><td>---</td></tr>
                <tr><td>Allergies:</td><td>---</td></tr>
            </table>
        </div>

        <div class="dataContainer">
            <table>
                <thead>
                <tr><th>Previous Illness </th> <th>Date</th></tr>
                </thead>
                <tbody>
                @foreach($ilns as $ill)
                    <tr><td> {{$ill->data}} </td><td> <?php echo date('D, d-m-y', strtotime($ill->created_at)); ?></td></tr>
                @endforeach
                </tbody>

            </table>
        </div>
        <div class="dataContainer">
            <table>
                <thead>
                <tr><th>Previous prescription </th> <th>Date</th></tr>
                </thead>
                <tbody>
                @foreach($pres as $prs)
                    <tr></td><td> {{$prs->data}} </td><td>  <?php echo date('D, d-m-y', strtotime($prs->created_at)); ?></tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="dataContainer">
            <table>
                <thead>
                <tr><th>Previous procedure </th> <th>Date</th></tr>
                </thead>
                <tbody>
                @foreach($proc as $prc)
                    <tr><td> {{$prc->data}} </td><td>  <?php echo date('D, d-m-y', strtotime($prc->created_at)); ?></td></tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div id="treat2">
        <section id="bldpPress">
            <span>Blood Pressure:</span> <span id="bldp">---</span>
        </section>
    </div>

    <script src="js/jquery.js"></script>
    <script>
        $(document).ready(function(){
            $("#history").click(function(){
                $(this).addClass("selected");
                $("#diagnostics").removeClass("selected");
                $("#treat1").removeClass("deactive");
                $("#treat2").addClass("deactive");
            });
            $("#diagnostics").click(function() {
                $(this).addClass("selected");
                $("#history").removeClass("selected");
                $("#treat1").addClass("deactive");
                $("#treat2").removeClass("deactive");
            });
        });
    </script>


</body>
</html>
