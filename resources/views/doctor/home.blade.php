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
    </div>
    <div id="container">
        <section id="header">
            <div id="hospName">ASTER MED CITY</div>
            <div id="logout"><a href="doctorr/logout">Logout</a></div>
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
                        <input id="submit" type="submit" value="Submit"></form>';
                }
            ?>
        </section>
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
        })
    </script>

</body>
</html>
