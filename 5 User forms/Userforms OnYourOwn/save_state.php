<?php

$mydb = new PDO('mysql:host=sql106.infinityfree.com;port=3306;dbname=if0_37212468_amazonia', 'if0_37212468', 'aNpojtpHLMeZ');

$input = json_decode(file_get_contents("php://input"), true);
$abbreviation = $input['abbreviation'];
$state = $input['state'];
$pci = $input['pci'];
$statepop = $input['statepop'];
$region = $input['region'];

if ($abbreviation && $state && $pci && $statepop && $region) {
    $stmt = $mydb->prepare("UPDATE states SET pci = :pci, 
                        pop = :statepop, 
                        region = :region 
                        WHERE statename = :state");
    $stmt->bindParam(":pci", $pci);
    $stmt->bindParam(":statepop", $statepop);
    $stmt->bindParam(":region", $region);
    $stmt->bindParam(":state", $state);
    $stmt->execute();
    
    echo json_encode(["success" => $stmt->rowCount() > 0]);
    return;
}

?>




<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header("Content-Type: application/json");

$servername = "sql106.infinityfree.com";
$username = "if0_37212468";
$password = "aNpojtpHLMeZ";
$dbname = "if0_37212468_amazonia";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo json_encode(["success" => false, "error" => "Connection failed: " . $conn->connect_error]);
    exit();
}

$input = json_decode(file_get_contents("php://input"), true);
file_put_contents('log.txt', "Received data:\n" . print_r($input, true) . "\n", FILE_APPEND);

$abbreviation = $input['abbreviation'] ?? null;
$state = $input['state'] ?? null;
$pci = $input['pci'] ?? null;
$statepop = $input['statepop'] ?? null;
$region = $input['region'] ?? null;

if (!$abbreviation || !$state || !$pci || !$statepop || !$region) {
    echo json_encode(["success" => false, "error" => "Missing required data"]);
    exit();
}

$sql = "UPDATE states SET pci=?, pop=?, region=? WHERE statename=?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo json_encode(["success" => false, "error" => "SQL prepare failed: " . $conn->error]);
    exit();
}

$stmt->bind_param("iiss", $pci, $statepop, $region, $state);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Record updated successfully"]);
} else {
    echo json_encode(["success" => false, "error" => "Error updating record: " . $stmt->error]);
}

$stmt->close();
$conn->close();
?>

