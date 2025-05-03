<?php

    $mydb = new PDO('mysql:host=sql106.infinityfree.com;port=3306;dbname=if0_37212468_amazonia', 'if0_37212468', 'aNpojtpHLMeZ');
    
    $stmt = $mydb->query("SELECT DISTINCT region 
                        FROM states 
                        ORDER BY region");
    
    $regions = $stmt->fetchAll();
    echo json_encode($regions);

?>

