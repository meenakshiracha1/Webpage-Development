<?php
$mydb = new PDO('mysql:host=sql106.infinityfree.com;port=3306; dbname=if0_37212468_amazonia', 'if0_37212468', 'aNpojtpHLMeZ');
$stmt=$mydb->prepare("Select category_code, category_name ". "from bookcat ". "order by category_name");
$stmt->execute();
$result=$stmt->fetchAll();
echo json_encode($result);
?>