<?php

$stateName=strtoupper($_REQUEST['byName']);
    if (strlen($stateName) == 0) 
        $stateName = '%'; 
     else 
        $stateName = '%' . $stateName . '%'; 
$sort = $_REQUEST['sort'] ?? 'statename'; 
$mydb = new PDO('mysql:host=sql106.infinityfree.com;port=3306;dbname=if0_37212468_amazonia', 'if0_37212468', 'aNpojtpHLMeZ');

if ($_REQUEST['byName']) {
    $stmt = $mydb->prepare("select statename, pci, pop 
            from states 
            where statename like :stateName 
            and region <> 'Territory' 
            order by statename");
    $stmt->execute([":stateName" => $stateName]);

} elseif ($_REQUEST['byRegion']) {
    $region = $_REQUEST['byRegion'];
    if ($region === 'All') {
        $stmt = $mydb->query("select statename, pci, pop 
                from states 
                where region <> 'Territory' 
                order by statename");
    } else {
        $stmt = $mydb->prepare("select statename, pci, pop 
                from states 
                where region = :region 
                order by statename");
        $stmt->execute([":region" => $region]);
    }

} elseif ($_REQUEST['regions']) {
    $stmt = $mydb->query("select distinct region 
            from states 
            where region <> 'Territory' 
            order by region");
}

$result = $stmt->fetchAll();
echo json_encode($result);

?>
