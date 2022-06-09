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
// $eyes = $_POST['eyes'];
// $eyeColor = $_POST['eyeColor'];

// $combination = [
//     'eyes' => $eyes,
//     'eyeColor' => $eyeColor
// ];

$combinationJSON = json_encode($_POST, JSON_UNESCAPED_UNICODE);

$sql = "INSERT INTO `showcase`(
    `member_sid`, `combination`, `avatar_created_at`
    ) VALUES (
        ?, ?, NOW()
    )";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    $mid,
    $combinationJSON,
]);

if ($stmt->rowCount() == 1) {
    $output['success'] = true;
    // 最近新增資料的 primery key
    $output['lastInsertId'] = $pdo->lastInsertId();
} else {
    $output['error'] = '資料無法新增';
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);