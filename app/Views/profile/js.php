<script>
    function checkPass()
    {
        //Store the password field objects into variables ...
        var pass1 = document.getElementById('pass');
        var pass2 = document.getElementById('conf_pass');
        // var message = document.getElementById('confirmMessage');
        var goodColor = "#66cc66";
        var badColor = "#ff6666";
        if(pass1.value == pass2.value){
            pass2.style.backgroundColor = goodColor;
            // message.style.color = goodColor;
    		document.getElementById("btn").removeAttribute("disabled");
        }else{
            pass2.style.backgroundColor = badColor;
            // message.style.color = badColor;
    		document.getElementById("btn").setAttribute("disabled","disabled");
        }
    }
</script>
