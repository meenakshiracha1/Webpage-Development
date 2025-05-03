<?php
$mydb = new PDO('mysql:host=sql106.infinityfree.com;port=3306;dbname=if0_37212468_amazonia', 'if0_37212468', 'aNpojtpHLMeZ');

$type = $_GET['type'] ?? '';

if ($type === 'regions') {
    // Fetch unique regions
    $stmt = $mydb->query("SELECT DISTINCT region FROM states WHERE region <> 'Territory' ORDER BY region");
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result);
    exit;
}

if ($type === 'expenses') {
    // Fetch unique expenses
    $stmt = $mydb->query("SELECT expensecode, expensename FROM stateexpensecat ORDER BY expensecode");
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result);
    exit;
}

http_response_code(400);
echo json_encode(['error' => 'Invalid type']);
?>
