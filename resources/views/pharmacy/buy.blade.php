<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>patient login</title>
    <link rel="stylesheet" href="../css/phar/buy.css">
</head>
<body>
    <div id="header">
        <section id="company">Tacoe</section>
        <section id="title"></section>
        <section id="logout"><a href="logout">Logout</a></section>
    </div>
    <div id="container">
        @if(sizeof($patRecs)==0)
            <section id="error">
                No Prescriptions available
            </section>
        @else
            @foreach( $patRecs as $pres )
                <section class="prescriptions">
                    <div class="id" style="display: none;" > {{$pres->id }} </div>
                    <div class="name"> {{ $pres->data }} </div>
                    <div class="date"> {{ date('D, d-m-y', strtotime($pres->created_at))  }} </div>
                </section>
            @endforeach
        @endif
            <section id="submit">
                <div type="button" > submit </div>
            </section>
            <form action="/phar/updatePres" display="none" method="POST" id="redirect">
                <input type="hidden" name="presList" id="presList">
            </form>

    </div>

    <script src="../js/jquery.js"></script>
    <script>
        $(document).ready(function(){
           var arr = [];
           $(".prescriptions").on("click", function(){
                $(this).toggleClass("selected");
                presId = $(this).find(".id").html().trim();
                if(arr.indexOf(presId) == -1)
                        arr.push(presId);
                else
                        arr.pop(presId);
           });

           $("#submit").on("click",function(){
             $("#redirect #presList").val(arr);
             $("#redirect").submit();
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