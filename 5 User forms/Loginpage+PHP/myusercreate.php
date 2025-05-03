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
                createbutt.disabled=true;
            else{
                createbutt.disabled=false;
                const xhttp=new XMLHttpRequest();
                xhttp.onload=function(){
                    if (this.responseText=="false")
                        createbutt.innerHTML="Create";
                    else
                        createbutt.innerHTML="Update";
                }
                xhttp.open("GET", "checkuser.php?user="+user.value, true);
                xhttp.send();
            }
        }
        function modifyrecord(){
            const xhttp=new XMLHttpRequest();
            xhttp.onload=function() {
                if (this.responseText=="executed"){
                    messages.innerHTML="User "+user.value;
                    if (createbutt.innerHTML=="Create")
                        messages.innerHTML+=" created!";
                    else
                        messages.innerHTML+=" updated!";
                }
            }
            xhttp.open("GET", "douser.php?user="+user.value+"&pass="+pass.value, true);
            xhttp.send();
        }
        
    </script>
    </head>
    <body>
        <div id="messages" style="color: red;">
        </div><br />
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
            <button type="button" id="createbutt" onclick="modifyrecord()" disabled>Create</button>
        </div><br />
    </body>
</html>