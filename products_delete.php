<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require 'connect.php';

$data = json_decode(file_get_contents("php://input"), true);

$sql = "DELETE FROM products WHERE products_id = :id";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    ':id' => $data['products_id']
]);

echo json_encode(["status" => "success"]);
