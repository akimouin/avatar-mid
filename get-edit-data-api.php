<?php
require __DIR__ . '/parts/connect-db.php';
header('Content-Type: application/json');

$id = $_POST;

$avatar = $pdo->query("SELECT * FROM `showcase` WHERE `avatar_id` = '1'")->fetchAll();


echo json_encode($avatar, JSON_UNESCAPED_UNICODE);
