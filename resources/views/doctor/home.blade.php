@extends('doctor.master')

@section('title', 'doctor home')


@section('content')

   <a href="doctor/logout">logout</a>

   <br>
   <?php
           //TODO: later in program PatQ maybe returning null instead of empty string
           if( sizeof($patQ) == 0){
              echo '<div id="error"> No patients waiting....</div>';
           }
           else{
              echo '<form action="doctor/patTreat" method="POST">';
              foreach($patQ as $pat){
                 echo '<input type="radio" name="id" value="'.$pat["id"].'">'. $pat["name"] . '<br>';
              }
              echo '<input type="submit" value="Submit"></form>';
           }
   ?>


   <script src="js/jquery.js"></script>
   <script>
      $(".pats").click(function(){
         alert($(this).val());
      });
   </script>


@endsection
