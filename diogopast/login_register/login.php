<?php
session_start();
header("Content-Type: application/json");

$pdo = new PDO("mysql:host=localhost;dbname=oficina", "root", "");

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE username = :username OR email = :username");
$stmt->execute(['username' => $username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($password, $user['password_hash'])) {
    $_SESSION['user'] = $user['username'];
    echo json_encode(["sucesso" => true]);
} else {
    echo json_encode(["sucesso" => false]);
}
?>
