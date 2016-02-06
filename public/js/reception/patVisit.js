$("#specSelect").change(function(){
    arr = ["GP","ENT","SRG"];
    if(arr.indexOf($(this).val().toUpperCase()) > -1)
        $.post("getDocs" , { spec : $("#specSelect").val() } , function(data){
            data = $.parseJSON(data);
            if(data.length == 0){
                $("#DocError").html("Sorry could not find any doctors for this speciality");
                $("#docts").html('');
            }else {
                $("#DocError").html('');
                $("#docts").html('');
                data.sort(function(a,b){return a["queue"].length - b["queue"].length }); //sort
                for (i = 0; i < data.length; i++) {
                    data[i]["queue"] = data[i]["queue"].filter(Boolean); //remove empty strings
                    if(data[i]["loggedin"] == 1)
                        s = '<input type="radio" name="doctor" value="' + data[i]["id"] + '" >' + data[i]["name"] + '  ' + data[i]["queue"].length +'   '+'Available<br>';
                    else
                        s = '<input type="radio" name="doctor" value="' + data[i]["id"] + '" >' + data[i]["name"] + '  ' + data[i]["queue"].length +'<br>';
                    $("#Doctors").append(s);
                }
                $("#Doctors").append("<input type='submit'/>");
            }
        });
})