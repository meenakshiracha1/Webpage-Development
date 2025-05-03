<?php
$user=$_REQUEST['user'];
$pass=password_hash($_REQUEST['pass'],PASSWORD_BCRYPT);
$mydb = new PDO('mysql:host=sql106.infinityfree.com;port=3306;dbname=if0_37212468_amazonia', 'if0_37212468', 'aNpojtpHLMeZ');
$stmt=$mydb->prepare("Select username ".
                     "from accounts ".
                     "where username=:user"
                     );
$stmt->bindParam(":user",$user);
$stmt->execute();
if ($stmt->rowCount()==0)
    $stmt=$mydb->prepare("Insert into accounts (username, userpass) ".
                         "values(:user,:pass)"
                         );
else
    $stmt=$mydb->prepare("Update accounts ".
                         "set userpass=:pass ".
                         "where username=:user"
                         );
    $stmt->bindParam(":user",$user);
    $stmt->bindParam(":pass",$pass);
    $stmt->execute();
    echo "executed";
?>