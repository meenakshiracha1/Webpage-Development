<?php
$user=$_REQUEST['user'];
$mydb = new PDO('mysql:host=sql106.infinityfree.com;port=3306;dbname=if0_37212468_amazonia', 'if0_37212468', 'aNpojtpHLMeZ');
$stmt=$mydb->prepare("Select username ".
                     "from accounts ".
                     "where username=:user");
$stmt->execute(":user",$user);
if ($stmt->rowCount()==0)
    echo "false";
else
    echo "true";
?>