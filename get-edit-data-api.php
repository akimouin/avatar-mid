<?php
require __DIR__ . '/parts/connect-db.php';
header('Content-Type: application/json');

$id = $_POST['id'];

$avatar = $pdo->query("SELECT * FROM `showcase` WHERE `avatar_id` = $id")->fetchAll();


echo json_encode($avatar, JSON_UNESCAPED_UNICODE);
