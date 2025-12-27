<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require 'connect.php';

$data = json_decode(file_get_contents("php://input"), true);

$sql = "UPDATE products SET
products_name = :name,
products_price = :price,
products_detail = :detail
WHERE products_id = :id";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    ':name'   => $data['products_name'],
    ':price'  => $data['products_price'],
    ':detail' => $data['products_detail'],
    ':id'     => $data['products_id']
]);

echo json_encode(["status" => "success"]);
