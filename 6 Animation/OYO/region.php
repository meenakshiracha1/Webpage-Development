<?php
$mydb = new PDO('mysql:host=sql106.infinityfree.com;port=3306;dbname=if0_37212468_amazonia', 'if0_37212468', 'aNpojtpHLMeZ');

if (isset($_GET['regions'])) {
    // Fetch unique regions
    $stmt = $mydb->query("SELECT DISTINCT region FROM states WHERE region <> 'Territory' ORDER BY region");
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result);
    exit;
}

$stateName = strtoupper($_GET['byName'] ?? '');
$region = $_GET['byRegion'] ?? 'All';

if (!empty($stateName)) {
    // Fetch data by state name
    $stmt = $mydb->prepare("SELECT statename, pci, pop FROM states WHERE statename LIKE :stateName AND region <> 'Territory' ORDER BY statename");
    $stmt->execute([":stateName" => "%$stateName%"]);
} elseif ($region !== 'All') {
    // Fetch data by region
    $stmt = $mydb->prepare("SELECT statename, pci, pop FROM states WHERE region = :region ORDER BY statename");
    $stmt->execute([":region" => $region]);
} else {
    // Fetch all data
    $stmt = $mydb->query("SELECT statename, pci, pop FROM states WHERE region <> 'Territory' ORDER BY statename");
}

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($result);
?>
