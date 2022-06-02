<?php
require __DIR__ . '/parts/connect-db.php';
header('Content-Type: application/json');

$sql = $pdo->query("SELECT * FROM `body_parts`")->fetchAll();

$eyes = $pdo->query("SELECT * FROM `body_parts` WHERE `part` = 'eyes'")->fetchAll();


echo json_encode($eyes, JSON_UNESCAPED_UNICODE);