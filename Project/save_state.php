<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header("Content-Type: application/json");

$mydb = new PDO('mysql:host=sql106.infinityfree.com;port=3306;dbname=if0_37212468_amazonia', 'if0_37212468', 'aNpojtpHLMeZ');

$input = json_decode(file_get_contents("php://input"), true);

$abbreviation = $input['abbreviation'] ?? null;
$state = $input['state'] ?? null;
$foodandbev = $input['foodandbev'] ?? null;
$gasandenergy = $input['gasandenergy'] ?? null;
$healthcare = $input['healthcare'] ?? null;
$housing = $input['housing'] ?? null;
$other = $input['other'] ?? null;

if (!$abbreviation || !$state || !$foodandbev || !$gasandenergy || !$healthcare || !$housing || !$other) {
    echo json_encode(["success" => false, "error" => "Missing required data"]);
    exit();
}

$stmt = $mydb->prepare("UPDATE states SET foodandbev=?, gasandenergy=?, healthcare=?, housing=?, other=? WHERE statename=?");

if (!$stmt) {
    echo json_encode(["success" => false, "error" => "SQL prepare failed: " . $mydb->error]);
    exit();
}

$stmt->bind_param("ddddds", $foodandbev, $gasandenergy, $healthcare, $housing, $other, $state);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Record updated successfully"]);
} else {
    echo json_encode(["success" => false, "error" => "Error updating record: " . $stmt->error]);
}

$stmt->close();
$mydb->close();
?>
