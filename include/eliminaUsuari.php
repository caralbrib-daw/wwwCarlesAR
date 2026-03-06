<?php
session_start();
include_once 'config.php';
include_once 'funcions.php';

// Solo el admin puede borrar
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: ../index.php");
    exit;
}

$id = $_GET['id'] ?? null;

if ($id) {
    try {
        $pdo = conectaBD();
        $stmt = $pdo->prepare("DELETE FROM usuaris WHERE id = :id AND role != 'admin'");
        $stmt->execute(['id' => $id]);
        
        header("Location: ../index.php?apartat=admin&accioadmin=eliminat");
    } catch (PDOException $e) {
        header("Location: ../index.php?apartat=admin&accioadmin=errorbasedades");
    }
} else {
    header("Location: ../index.php?apartat=admin");
}
exit;