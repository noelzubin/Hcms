<!DOCTYPE html>
<html>
<head>
    <title>HCMS</title>
    <link rel="stylesheet" href="../css/doctor/patTreat.css">
    <link rel="stylesheet" href="../css/chartist.css">
</head>

<body>
<div id="sidebar">
    <div id="companyName">
        <a href="/doctor">Tacoe</a>
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
        <input type="hidden" name="uid" id="PatientId" value="{{ $patient->uid }}">
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
            <div class="ct-chart ct-perfect-fourth"></div>
        </section>
    </div>
</div>

<script src="../js/jquery.js"></script>
<script src="../js/chartist.js"></script>
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
            var data = {
                // A labels array that can contain any sort of values
                labels:[],
                //  labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri'],
                // Our series array that contains series objects or in this case series data arrays
                series: [ [] ]

            };
            var options = {
                width: '750px',
                height: '400px',
                high: 200,
                low:0
            };

            $(this).addClass("selected");
            $("#treatlink").removeClass("selected");
            $("#infolink").removeClass("selected");
            $("#treat1").addClass("deactive");
            $("#treat3").removeClass("deactive");
            $("#treat2").addClass("deactive");
            $.post( "getBloodPress", { patId : $("#PatientId").val() }, function( bldps ) {
                data["labels"] = [];
                data["series"] = [ [] ];
                for(i=0 ; i<bldps.length; i++) {
                    data["labels"].push(bldps[i]["created_at"]);
                    data["series"][0].push(parseInt(bldps[i]["data"]));
                }
                console.log(data);
                new Chartist.Line('.ct-chart', data, options);
                $("#bldp").html(bldps[bldps.length-1]["data"]);
            });
        });
    });
</script>

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


