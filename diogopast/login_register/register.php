<?php
header("Content-Type: application/json");

$pdo = new PDO("mysql:host=localhost;dbname=oficina", "root", "");

$username = $_POST['username'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if (empty($username) || empty($email) || empty($password)) {
    echo json_encode(["sucesso" => false, "mensagem" => "Preencha todos os campos!"]);
    exit;
}

$passwordHash = password_hash($password, PASSWORD_DEFAULT);

$stmt = $pdo->prepare("INSERT INTO usuarios (username, email, password_hash) VALUES (:username, :email, :password)");
$success = $stmt->execute(['username' => $username, 'email' => $email, 'password' => $passwordHash]);

if ($success) {
    echo json_encode(["sucesso" => true]);
} else {
    echo json_encode(["sucesso" => false, "mensagem" => "Erro ao registrar usuário."]);
}
?>
