<!DOCTYPE html>
<html>
    <head>
        <title>HCMS</title>
        <link rel="stylesheet" href="css/home.css">
    </head>

    <body>
        <div id="container">
            <section id="overlay">
                <header>
                    <section id="title">
                        Tacoe
                    </section>
                    <section id="login">
                        Login
                    </section>
                </header>

                <div id="centerCont">
                    <section id="title">
                        WE <strong>CARE</strong>
                    </section>
                    <section id="content">
                        We are a group of people who care about the poeple you care about
                    </section>
                    <section id="loginButt">
                       <div id="heart">&#10084</div> <div id="start">Get Started </div>
                    </section>
                </div>
            </section>
        </div>

        <div id="logins">
            <div id="youAreA">You are a ... </div>

            <div id="cardsCont">
                <div class="card" id="doctor">
                    <img src="css/resources/doctor.png" alt="">
                    <section class="cardTitle">The <br> Doctor</section>
                    <a href="doctor" class="loginButton"> Login  </a>
                </div>
                <div class="card" id="pharmacist">
                    <img src="css/resources/pharmacist.png" alt="">
                    <section class="cardTitle">The <br> Pharmacist</section>
                    <a href="#" class="loginButton"> Login  </a>
                </div>
                <div class="card" id="receptionist">
                    <img src="css/resources/receptionist.png" alt="">
                    <section class="cardTitle">The Desk <br> guy</section>
                    <a href="desk" class="loginButton"> Login  </a>
                </div>
                <div class="card" id="patient">
                    <img src="css/resources/patient.png" alt="">
                    <section class="cardTitle">Just <br> me</section>
                    <a href="desk" class="loginButton"> Login  </a>
                </div>
            </div>
        </div>
        <script src="js/jquery.js"></script>
        <script>
            $('#login').click(function(){
                $('html, body').animate({
                    scrollTop: $(".card").offset().top
                }, 600 ,'swing');
                return false;
            });
            $('#loginButt').click(function(){
                $('html, body').animate({
                    scrollTop: $(".card").offset().top
                }, 600 ,'swing');
                return false;
            });
        </script>
    </body>
</html>

