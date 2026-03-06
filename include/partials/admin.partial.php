<?php
// include/partials/admin.partial.php
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: index.php");
    exit;
}

$pdo = conectaBD();
$usuarios = $pdo->query("SELECT id, nom, email, role FROM usuaris")->fetchAll();
?>

<section class="admin-panel">
  <h2>Gestió d'Usuaris (Admin)</h2>
  
  <?php if(isset($_GET['accioadmin'])): ?>
    <div class="alerta">
        <?php 
            if($_GET['accioadmin'] == 'eliminat') echo "Usuari eliminat correctament.";
            if($_GET['accioadmin'] == 'errorbasedades') echo "Error en la base de dades.";
        ?>
    </div>
  <?php endif; ?>

  <table class="tabla-admin">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Email</th>
            <th>Rol</th>
            <th>Accions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($usuarios as $u): ?>
        <tr>
            <td><?= $u['id'] ?></td>
            <td><?= htmlspecialchars($u['nom']) ?></td>
            <td><?= htmlspecialchars($u['email']) ?></td>
            <td><?= $u['role'] ?></td>
            <td>
                <?php if($u['role'] !== 'admin'): ?>
                    <a href="include/eliminaUsuari.php?id=<?= $u['id'] ?>" 
                       onclick="return confirm('Estàs segur d'eliminar aquest usuari?')" 
                       class="btn-delete">Eliminar</a>
                <?php else: ?>
                    ---
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
  </table>
</section>