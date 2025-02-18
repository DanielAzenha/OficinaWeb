<?php
header("Content-Type: application/json");

$pdo = new PDO("mysql:host=localhost;dbname=oficina", "root", "");

$email = $_POST['email'] ?? '';

$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
$stmt->execute(['email' => $email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
    $novaSenha = substr(md5(time()), 0, 8);
    $passwordHash = password_hash($novaSenha, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("UPDATE usuarios SET password_hash = :password WHERE email = :email");
    $stmt->execute(['password' => $passwordHash, 'email' => $email]);

    echo json_encode(["sucesso" => true, "novaSenha" => $novaSenha]);
} else {
    echo json_encode(["sucesso" => false, "mensagem" => "Email não encontrado."]);
}
?>
