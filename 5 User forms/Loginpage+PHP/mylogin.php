<!doctype html>
<html>
    <head>
    <style>
        .leftcol{
            display: inline-block;
            width: 100px;
            text-align: right;
            font-weight: bold;
        }
        .rightcol{
            display: inline-block;
        }
    </style>
    <script>
        function loginstate(){
            if (user.length==0)
                loginbutt.disabled=true;
            else
                loginbutt.disabled=false;
        }
        function checklogin(){
            const xhttp=new XMLHttpRequest();
            xhttp.onload=function(){
                console.log(this.responseText);
                if(this.responseText=="true")
                    window.location="<?php echo $_REQUEST['from'];?>";
                else
                    messages.innerHTML="Login failure."
            }
            xhttp.open("GET", "verifylogin.php?user="+user.value+"&pass="+pass.value, true);
            xhttp.send();
        }
    </script>
    </head>
    <body>
        <div id="messages" style="color: red;">
        </div><br />
        <div><a href="myusercreate.php"> Create a New User Here</a></div>
        <div class="leftcol">
            <label for="user">Username: </label>
        </div>
        <div class="rightcol">
            <input type="text" id="user" onkeyup="loginstate();"/>
        </div><br />
        <div class="leftcol">
            <label for="pass"> Password: </label>
        </div>
        <div class="rightcol">
            <input type="password" id="pass" />
        </div><br />
        <div class="leftcol">
        </div>
        <div class="rightcol">
            <button type="button" id="loginbutt" disabled onclick="checklogin()">Login</button>
        </div><br />
    </body>
</html>
