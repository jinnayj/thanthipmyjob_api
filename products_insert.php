<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=UTF-8");

require 'connect.php';

// รับข้อมูลจาก Vue (JSON)
$data = json_decode(file_get_contents("php://input"), true);

// ตรวจข้อมูลที่จำเป็น
if (
    !isset($data['products_name']) || trim($data['products_name']) === '' ||
    !isset($data['products_price']) || trim($data['products_price']) === ''
) {
    echo json_encode([
        "status" => "error",
        "message" => "Missing data"
    ]);
    exit;
}

// SQL INSERT
$sql = "INSERT INTO products
(products_name, products_price, products_detail)
VALUES (:name, :price, :detail)";

$stmt = $pdo->prepare($sql);

// Execute
$result = $stmt->execute([
    ':name'   => $data['products_name'],
    ':price'  => $data['products_price'],
    ':detail' => $data['products_detail'] ?? ''
]);

// Response กลับไปที่ Vue
if ($result) {
    echo json_encode([
        "status" => "success"
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Insert failed"
    ]);
}
