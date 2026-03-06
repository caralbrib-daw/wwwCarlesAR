<?php
// include/partials/apadrina.partial.php
include_once __DIR__ . '/../funcions.php';
$pdo = conectaBD();

$query = $pdo->query("SELECT * FROM animals");
$animals = $query->fetchAll();
?>

<section class="apadrinament">
  <h2>Animals per a Apadrinar</h2>
  <div class="grid-animals">
    <?php foreach ($animals as $a): ?>
      <div class="card-animal">
        <img src="images/<?= htmlspecialchars($a['imatge']) ?>" alt="<?= htmlspecialchars($a['nom_comu']) ?>">
        <h3><?= htmlspecialchars($a['nom_comu']) ?></h3>
        <p><i><?= htmlspecialchars($a['nom_cientific']) ?></i></p>
        <p><?= htmlspecialchars($a['descripcio']) ?></p>
        <p><strong>Donació: <?= $a['donacio'] ?>€</strong></p>
        
        <form action="include/afegeixCarret.php" method="post">
            <input type="hidden" name="id_animal" value="<?= $a['id'] ?>">
            <label>Quantitat: 
                <input type="number" name="quantitat" value="1" min="1" max="10">
            </label>
            <button type="submit" class="btn-apadrina">Afegeix al carret</button>
        </form>
      </div>
    <?php endforeach; ?>
  </div>
</section>