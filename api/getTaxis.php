<?php
header('Content-Type: application/json');

require_once '../db.php';

$query = $pdo->query("SELECT id, nom, theme, latitude, longitude FROM taxis WHERE en_service = 1");
$data = $query->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($data);
?>