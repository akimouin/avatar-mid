<?php
require __DIR__ . './parts/connect_db.php';

header('Content-Type: application/json');

$output = [
    'success' => false,
    'postData' => $_POST,
    'code' => 0,
    'error' => ''
];

$mid = '1';
$aid = $_POST['aid'];
$eyes = $_POST['eyes'];
$nose = $_POST['nose'];
$mouth = $_POST['mouth'];
$ear = $_POST['ear'];
$hair = $_POST['hair'];

$eyesColor = $_POST['eyesColor'];
$noseColor = $_POST['noseColor'];
$mouthColor = $_POST['mouthColor'];
$earColor = $_POST['earColor'];
$hairColor = $_POST['hairColor'];

$combination = [
    'eyes' => $eyes,
    'nose' => $nose,
    'mouth' => $mouth,
    'ear' => $ear,
    'hair' => $hair,
    'eyesColor' => $eyesColor,
    'noseColor' => $noseColor,
    'mouthColor' => $mouthColor,
    'earColor' => $earColor,
    'hairColor' => $hairColor
];

$combinationJSON = json_encode($combination, JSON_UNESCAPED_UNICODE);

$sql = "UPDATE `showcase` SET `combination`=? WHERE `avatar_id`=$aid ";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    $combinationJSON,
]);

if ($stmt->rowCount() == 1) {
    $output['success'] = true;
    // 最近新增資料的 primery key
    $output['lastInsertId'] = $pdo->lastInsertId();
} else {
    $output['error'] = '資料無法修改';
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);