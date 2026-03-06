<?php
// Seguridad: si no es admin, fuera de aquí
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: index.php");
    exit;
}

$pdo = conectaBD();
$usuarios = $pdo->query("SELECT id, nom, cognoms, email FROM usuaris")->fetchAll();
?>

<section>
  <h2>Panell d'Administració</h2>
  <table style='border="1"'>
    <tr>
        <th>ID</th><th>Nom</th><th>Email</th>
    </tr>
    <?php foreach ($usuarios as $u): ?>
    <tr>
        <td><?= $u['id'] ?></td>
        <td><?= htmlspecialchars($u['nom']) ?></td>
        <td><?= htmlspecialchars($u['email']) ?></td>
    </tr>
    <?php endforeach; ?>
  </table>
</section>