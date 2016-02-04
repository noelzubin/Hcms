$("#specSelect").change(function(){
    arr = ["GP","ENT","SRG"];
    if(arr.indexOf($(this).val().toUpperCase()) > -1)
        $.post("getDocs" , { spec : $("#specSelect").val() } , function(data){
           console.log(data);
        });
})