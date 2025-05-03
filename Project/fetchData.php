<?php
header('Content-Type: application/json');

$mydb = new PDO('mysql:host=sql106.infinityfree.com;port=3306;dbname=if0_37212468_amazonia', 'if0_37212468', 'aNpojtpHLMeZ');

$region = isset($_GET['region']) ? $_GET['region'] : 'All';
$expense = isset($_GET['expense']) ? $_GET['expense'] : 'All';

$query = "";
$params = [];

if ($region === 'All' && $expense === 'All') {
    $query = "SELECT states.statename AS state, stateexpense.amount AS stat 
              FROM states 
              INNER JOIN stateexpense ON states.abbrev = stateexpense.abbrev 
              ORDER BY states.statename";
} elseif ($region === 'All') {
    $query = "SELECT states.statename AS state, stateexpense.amount AS stat 
              FROM states 
              INNER JOIN stateexpense ON states.abbrev = stateexpense.abbrev 
              WHERE stateexpense.expensecode = :expense
              ORDER BY states.statename";
    $params[':expense'] = $expense;
} elseif ($expense === 'All') {
    $query = "SELECT states.statename AS state, stateexpense.amount AS stat 
              FROM states 
              INNER JOIN stateexpense ON states.abbrev = stateexpense.abbrev 
              WHERE states.region = :region
              ORDER BY states.statename";
    $params[':region'] = $region;
} else {
    $query = "SELECT states.statename AS state, stateexpense.amount AS stat 
              FROM states 
              INNER JOIN stateexpense ON states.abbrev = stateexpense.abbrev 
              WHERE stateexpense.expensecode = :expense AND states.region = :region
              ORDER BY states.statename";
    $params[':expense'] = $expense;
    $params[':region'] = $region;
}

$stmt = $mydb->prepare($query);
foreach ($params as $key => $value) {
    $stmt->bindValue($key, $value);
}
$stmt->execute();

$results = $stmt->fetchAll();

$states = [];
$expenses = [];

foreach ($results as $row) {
    $states[] = $row['state'];
    $expenses[] = $row['stat'];
}

echo json_encode(['states' => $states, 'expenses' => $expenses]);
?>
