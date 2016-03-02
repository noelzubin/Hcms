$("#getdoctors").click(function(){
    arr = ["GP","ENT","SRG"];
    if(arr.indexOf($("#specSelect").val().toUpperCase()) > -1)
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
                        s = '<div class="doctor" value="' + data[i]["id"] + '" > <div class="name" >' + data[i]["name"] + '</div> <div class="queue"  >' + data[i]["queue"].length +' waiting ... </div> <div class="availability">Available</div> </div>';
                    else
                        s = '<div class="doctor" value="' + data[i]["id"] + '" > <div class="name" >' + data[i]["name"] + '</div> <div class="queue" >' + data[i]["queue"].length +' waiting ... </div> <div class="availability">Not Available</div> </div>';
                    $("#docts").append(s);
                }
                $("#docts").append(" <input type='hidden' value='' id='docpost' name='doctor'> <input type='submit'/>");
            }
        });
     setTimeout(doo,500);
});


function doo() {
    doctors = $('.doctor')
    doctors.on("click",function(){
        doctors.each(function(index){
            doctors[index].classList.remove("selected");
        })
        $(this).addClass("selected");
        $("#docpost").val($(this).attr("value"));
    });
}


