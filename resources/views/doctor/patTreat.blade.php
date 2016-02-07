<html xmlns="http://www.w3.org/1999/html">
<head>
    <title>hcms: {{ $patient->name }} </title>
</head>
<body>
<div class="container">
    <h3>Patient Details</h3>
    <table id="patdetails">
        <tr> <td> Name </td> <td> {{ $patient->name }} </td> </tr>
        <tr> <td> Age </td> <td> {{ $patient->age }} </td> </tr>
        <tr> <td> Gender </td> <td> {{ $patient->gender }} </td> </tr>
        <tr> <td> Guardian name </td> <td> {{ $patient->gname }} </td> </tr>
    </table>
    <br>
    <form action="patResult" method="POST">
        <input type="hidden" name="uid" value="{{ $patient->uid }}">
        <label for="ilns"> Details:</label>
        <textarea rows="4" cols="100" name="ilns" id="ilns" cols="30" rows="10"></textarea><br>
        <label for="proc"> Procedure</label>
        <textarea rows="4" cols="100" name="proc" id="proc" cols="30" rows="10"></textarea><br>
        <label for="pres"> Prescription </label>
        <textarea rows="4" cols="100" name="pres" id="pres" cols="30" rows="10"></textarea><br>
        <input type="submit" value="Submit">
    </form>
    <br><h3>Previous Records</h3>
    <table style="font-family:monospace" id="patRecrds">
        <col width="250">
        <col width="300">
<?php
        $MRec = array_reverse($MRec);
        foreach($MRec as $rec){
            if($rec->type == "ilns"){
                echo "<tr style='color:darkblue;' >
                        <td> ".$rec->created_at ."</td> <td>". $rec->data ." </td>
                    </tr>";
            }
            if($rec->type == "proc"){
                echo "<tr style='color:#3c763d;' >
                        <td> ".$rec->created_at ."</td> <td>". $rec->data ." </td>
                    </tr>";
            }
            if($rec->type == "pres"){
                echo "<tr style='color:tomato;' >
                        <td> ".$rec->created_at ."</td> <td>". $rec->data ." </td>
                    </tr>";
            }
        }
    ?>
    </table>
</div>
</body>
</html>