<?php
session_start();
include_once 'config.php';
include_once 'funcions.php';

$email = $_POST['email'] ?? "";
$password = $_POST['password'] ?? "";

$pdo = conectaBD();
$stmt = $pdo->prepare("SELECT * FROM usuaris WHERE email = :email");
$stmt->execute(['email' => $email]);
$usuari = $stmt->fetch();

if ($usuari && password_verify($password, $usuari['password'])) {
    // Login correcto
    $_SESSION['user_id'] = $usuari['id'];
    $_SESSION['user_email'] = $usuari['email'];
    $_SESSION['user_nom'] = $usuari['nom'];
    $_SESSION['user_role'] = $usuari['role']; // Asegúrate de tener una columna 'role' en tu BD

    header("Location: ../index.php?apartat=inici");
} else {
    header("Location: ../index.php?apartat=login&error=login_incorrecte");
}
exit;