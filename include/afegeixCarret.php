<?php
// include/afegeixCarret.php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id_animal'];
    $qty = intval($_POST['quantitat']);

    // Si el carrito no existe en la sesión, lo creamos
    if (!isset($_SESSION['carret'])) {
        $_SESSION['carret'] = [];
    }

    // Si el animal ya está en el carrito, sumamos la cantidad
    if (isset($_SESSION['carret'][$id])) {
        $_SESSION['carret'][$id] += $qty;
    } else {
        $_SESSION['carret'][$id] = $qty;
    }

    header("Location: ../index.php?apartat=apadrina&status=afegit");
    exit;
}