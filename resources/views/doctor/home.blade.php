<!DOCTYPE html>
<html>
<head>
    <title>HCMS</title>
    <link rel="stylesheet" href="../css/doctor/home.css">
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
            <section id="title"> patients </section>
            <section id="countPat"> {{ sizeof($patQ) }} </section>
        </div>

        <div id="previousPatients">
            <section id="title"> Previous Patients </section>
        </div>

    </div>
    <div id="container">
        <section id="header">
            <div id="hospName">ASTER MED CITY</div>
            <div id="logout"><a href="doctor/logout">Logout</a></div>
        </section>

        <section id="patients">
            <?php
                if( sizeof($patQ) == 0)
                    echo '<div id="error"> No patients waiting....</div>';
                else{
                    echo '<form action="doctor/patTreat" method="POST">';
                    foreach($patQ as $pat){
                        echo '<div class="patient" value="' . $pat["id"] . '">'. $pat["name"] .'</div>';
                    }
                    echo '<input type="hidden" id="patId" name="patId" value="">
                        <input id="submit" type="submit" value="Submit"></form>' ;
                }
            ?>
        </section>
        <section id="previousPats" style="display: none;"></section>
        <section id="previousPatDets" style="display:none">
            <table id="patientTable">

            </table>
            <table id="ilnsTable">

            </table>
            <table id="presTable">

            </table>
            <table id="procTable">

            </table>
        </section>
        <input type="hidden" id="docId" value="{{ session("loggedUserId") }}">
    </div>


    <script src="js/jquery.js"></script>
    <script>
        pat = null
        patients = $(".patient");
        patients.on("click",function(){
             pat = $(this);
            $.each(patients, function(ind,val){
               patients[ind].classList.remove("checked")
            });
            $(this).addClass("checked");
            $("#patId").val(pat.attr("value"));
        });

        (function(){

            $("#patientItem").click(function () {
                $("#previousPats").hide();
                $("#patients").show();
                $("#previousPatDets").hide();
            });
            $("#previousPatients").click(function () {
                $("#patients").hide();
                $("#previousPats").show();
                $("#previousPatDets").hide();
                docId = $("#docId").val()
                $.post( "doctor/getPrevPatients", {docid: docId} ,function( data ) {
                    data = JSON.parse(data);
                    document.d  = data;
                    prevPats = $("#previousPats").html("");
                    for(i=0;i<data.length;i++){
                        prevPats.html(prevPats.html() + ' <section class="prevPats" value="' + data[i][0]["uid"] + '"> ' + data[i][0]["name"] + '   </section> ')
                    }

                    $(".prevPats").each(function(index){
                        var details = ""
                        $(this).on("click",function () {
                            document.d = $(this);
                            $.post("doctor/getPatientDets",{uid : $(this).attr("value")} , function(data) {
                                data = JSON.parse(data);
                                console.log(data);
                                details = '<table>' +
                                        '<tr><td>Name</td><td> ' + data["patient"]["name"] + '  </td></tr>' +
                                        '<tr><td>Age</td><td> ' + data["patient"]["age"] + ' </td></tr>  ' +
                                        '<tr><td>Sex</td><td> ' + data["patient"]["gender"]  + ' </td></tr> ' +
                                        '<tr><td>Gname</td><td> ' + data["patient"]["gname"]  + ' </td></tr> ' +
                                        '<tr><td>District</td><td> ' + data["patient"]["dist"]  + ' </td></tr>' +
                                        '</table> ';
                                details = details + ' <table> <thead> <tr><th>Previous procedure </th> <th>Date</th></tr> </thead> <tbody>';
                                for(i=0;i<data["ilns"].length;i++){
                                    details = details + ' <tr><td> ' + data["ilns"][i]["data"] + '</td><td>' + data["ilns"][0]["created_at"] + '</td></tr> ';
                                }
                                details = details + '</tbody> </table>';

                                details = details + ' <table> <thead> <tr><th>Previous procedure </th> <th>Date</th></tr> </thead> <tbody>';
                                for(i=0;i<data["pres"].length;i++){
                                    details = details + ' <tr><td> ' + data["pres"][i]["data"] + '</td><td>' + data["pres"][0]["created_at"] + '</td></tr> ';
                                }
                                details = details + '</tbody> </table>';

                                details = details + ' <table> <thead> <tr><th>Previous procedure </th> <th>Date</th></tr> </thead> <tbody>';
                                for(i=0;i<data["proc"].length;i++){
                                    details = details + ' <tr><td> ' + data["proc"][i]["data"] + '</td><td>' + data["proc"][0]["created_at"] + '</td></tr> ';
                                }
                                details = details + '</tbody> </table>';

                                $("#previousPatDets").html(details);
                                $("#previousPats").hide();
                                $("#previousPatDets").show();
                            });
                        })
                    });
                });
            });
        })();
    </script>

</body>
</html>
