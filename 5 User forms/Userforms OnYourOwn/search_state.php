<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$mydb = new PDO('mysql:host=sql106.infinityfree.com;port=3306;dbname=if0_37212468_amazonia', 'if0_37212468', 'aNpojtpHLMeZ');

if ($_GET['abbreviation']) {
    $stmt = $mydb->prepare("SELECT statename AS state, pci, pop AS population, region FROM states WHERE abbrev = :abbreviation AND region <> 'Territory'");
    $stmt->execute([':abbreviation' => strtoupper(trim($_GET['abbreviation']))]);

} elseif (($_GET['statename']) && strlen(trim($_GET['statename'])) >= 2) {
    $stmt = $mydb->prepare("SELECT statename AS state, pci, pop AS population, region FROM states WHERE statename LIKE :stateName AND region <> 'Territory'");
    $stmt->execute([':stateName' => "%" . ucfirst(strtolower(trim($_GET['statename']))) . "%"]);

} else {
    echo json_encode(['success' => false, 'message' => 'Invalid input']);
    exit;
}

$state = $stmt->fetch(PDO::FETCH_ASSOC);
echo json_encode($state ? ['success' => true] + $state : ['success' => false, 'message' => 'State not found']);

?>





<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header("Content-Type: application/json");

$mydb = new PDO('mysql:host=sql106.infinityfree.com;port=3306;dbname=if0_37212468_amazonia', 'if0_37212468', 'aNpojtpHLMeZ');

if (isset($_GET['abbreviation'])) {
    $stmt = $mydb->prepare("SELECT statename AS state, pci, pop AS population, region FROM states WHERE abbrev = :param AND region <> 'Territory'");
    $stmt->bindValue(':param', strtoupper(trim($_GET['abbreviation'])));
    $stmt->execute();
} elseif (isset($_GET['statename'])) {
    $stmt = $mydb->prepare("SELECT statename AS state, pci, pop AS population, region FROM states WHERE statename LIKE :param AND region <> 'Territory'");
    $param = "%" . ucfirst(strtolower(trim($_GET['statename']))) . "%";
    $stmt->bindValue(':param', $param);
    $stmt->execute();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid input']);
    exit;
}

$state = $stmt->fetch();
if ($state) {
    $state['success'] = true;
    echo json_encode($state);
} else {
    echo json_encode(['success' => false, 'message' => 'State not found']);
}
?>

