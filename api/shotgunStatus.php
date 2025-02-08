<?php
header('Content-Type: application/json');

require_once '../db.php';

$query = $pdo->query("SELECT * FROM shotguns WHERE NOW() BETWEEN debut AND fin");
$data = $query->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($data);
?>