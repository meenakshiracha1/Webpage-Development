<?php 
$mydb = new PDO('mysql:host=sql106.infinityfree.com;port=3306;dbname=if0_37212468_amazonia', 'if0_37212468', 'aNpojtpHLMeZ');

$states = $mydb->query("SELECT DISTINCT statename 
                        FROM states 
                        ORDER BY statename")
               ->fetchAll(PDO::FETCH_COLUMN);
echo json_encode($states);
?>
