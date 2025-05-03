<?php
    session_start();
    $user=$_REQUEST['user'];
    $pass=$_REQUEST['pass'];
    $mydb = new PDO('mysql:host=sql106.infinityfree.com;port=3306;dbname=if0_37212468_amazonia', 'if0_37212468', 'aNpojtpHLMeZ');
    $stmt=$mydb->prepare("Select username, userpass ".
                         "from accounts ".
                         "where username=:user"
                         );
    $stmt->execute([":user"=>$user]);
    if ($stmt->rowCount()==0)
        echo "false";
    else{
        $result=$stmt->fetch(PDO::FETCH_OBJ);
        if (password_verify($pass,$result->userpass)){
            echo "true";
            $_SESSION['haslogin']='Y';
        }
        else
            echo "false";
    }
?>