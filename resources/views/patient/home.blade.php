<!DOCTYPE html>
<html>
<head>
    <title>HCMS</title>
    <link rel="stylesheet" href="../css/patient/home.css">
</head>

<body>
    <div id="sidebar">
        <div id="companyName">
            <a href="/">Tacoe</a>
        </div>
        <div id="docName">

        </div>
        <div id="patientItem">
            <section id="title"> patients </section>
            <section id="countPat"> </section>
        </div>
    </div>
    <div id="container">
        <section id="header">
            <div id="hospName">ASTER MED CITY</div>
            <div id="logout"><a href="doctor/logout">Logout</a></div>
        </section>

    </div>

    <script src="js/jquery.js"></script>
    {{--<script>--}}
        {{--pat = null--}}
        {{--patients = $(".patient");--}}
        {{--patients.on("click",function(){--}}
            {{--pat = $(this);--}}
            {{--$.each(patients, function(ind,val){--}}
               {{--patients[ind].classList.remove("checked")--}}
            {{--});--}}
            {{--$(this).addClass("checked");--}}
            {{--$("#patId").val(pat.attr("value"));--}}
        {{--})--}}
    {{--</script>--}}

</body>
</html>
