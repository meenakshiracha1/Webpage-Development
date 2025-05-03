<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header("Content-Type: application/json");

$mydb = new PDO('mysql:host=sql106.infinityfree.com;port=3306;dbname=if0_37212468_amazonia', 'if0_37212468', 'aNpojtpHLMeZ');

$param = $_GET['abbreviation'] ?? $_GET['statename'] ?? null;

if ($param) {
    if (!empty($_GET['abbreviation'])) {
        $stmt = $mydb->prepare("SELECT abbrev AS abbreviation, statename AS state FROM states WHERE abbrev = :param  ");
        $stmt->execute([':param' => strtoupper(trim($param))]);
    } elseif (!empty($_GET['statename'])) {
        $stmt = $mydb->prepare("SELECT abbrev AS abbreviation, statename AS state FROM states WHERE statename LIKE :param ");
        $stmt->execute([':param' => "%$param%"]);
    }

    $state = $stmt->fetch();
    if ($state) {
        $state['success'] = true;
        echo json_encode($state);
    } else {
        echo json_encode(['success' => false, 'message' => 'State not found']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid input']);
}
?>