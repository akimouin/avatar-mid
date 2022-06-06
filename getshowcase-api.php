<?php
require __DIR__ . '/parts/connect-db.php';
header('Content-Type: application/json');


$avatars = $pdo->query("SELECT * FROM `showcase` WHERE `member_sid` = '1'")->fetchAll();


echo json_encode($avatars, JSON_UNESCAPED_UNICODE);