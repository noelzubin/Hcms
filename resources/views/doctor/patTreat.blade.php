<!DOCTYPE html>
<html>
<head>
    <title>HCMS</title>
    <link rel="stylesheet" href="../css/doctor/patTreat.css">
</head>

<body>
<div id="sidebar">
    <div id="companyName">
        <a href="/">Tacoe</a>
    </div>
    <div id="docName">
        {{ $docName }}
    </div>
    <div id="patientItem">
        <section class="sideItems selected" id="treatlink"> treat </section>
        <section class="sideItems" id="infolink"> info </section>
    </div>
    <div id="diagnosticsItem"> diagnostics </div>

</div>
<div id="container">
    <section id="header">
        <div id="hospName"> {{ $patient->name }} </div>
        <div id="logout"><a href="logout">Logout</a></div>
    </section>


    {{--view 1--}}
    <form action="patResult" method="POST" id="treat1">
        <input type="hidden" name="uid" value="{{ $patient->uid }}">
        <div id="addsick">
            <div class="title">
                + add illness details:
            </div>
            <textarea name="ilns" id="ilns"></textarea>
        </div>
        <div id="addproc">
            <div class="title">
                + add procedures <i>(seperated by commas)</i>:
            </div>
            <textarea name="proc" id="proc"></textarea>
        </div>
        <div id="addpres">
            <div class="title">
                + add prescriptions <i>(seperated by commas)</i>:
            </div>
            <textarea name="pres" id="pres"></textarea>
        </div>
        <input type="submit" value="submit">
    </form>

    {{--view2--}}
    <div id="treat2" class="deactive">
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
    <div id="treat3" class="deactive">
        <form action="addToDiagnostics" method="POST">
            <input type="hidden" name="userId" value="{{$patient->uid}}">
            <input type="submit" id="checkBloodPressure" value="Check Blood Pressure" />
        </form>
        <section id="curBldp">
            <span> </span> Blood Pressure: <span id="bldp">---</span>
        </section>
    </div>
</div>

<script src="../js/jquery.js"></script>
<script>
    $(document).ready(function(){
        $("#treatlink").click(function(){
            $(this).addClass("selected");
            $("#infolink").removeClass("selected");
            $('#diagnosticsItem').removeClass("selected");
            $("#treat1").removeClass("deactive");
            $("#treat3").addClass("deactive");
            $("#treat2").addClass("deactive");
        });
        $("#infolink").click(function() {
            $(this).addClass("selected");
            $('#diagnosticsItem').removeClass("selected")
            $("#treatlink").removeClass("selected");
            $("#treat1").addClass("deactive");
            $("#treat3").addClass("deactive");
            $("#treat2").removeClass("deactive");
        });
        $("#diagnosticsItem").click(function() {
            $(this).addClass("selected");
            $("#treatlink").removeClass("selected");
            $("#infolink").removeClass("selected");
            $("#treat1").addClass("deactive");
            $("#treat3").removeClass("deactive");
            $("#treat2").addClass("deactive");
        });
    });

</script>


</body>
</html>


