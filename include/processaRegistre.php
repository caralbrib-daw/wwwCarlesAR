<?php
function safe($key) {
    if (!isset($_POST[$key])) return "";
    return trim(htmlspecialchars($_POST[$key], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'));
}

$nom = safe('nom');
$cognoms = safe('cognoms');
$email = safe('email');
$password = safe('password');
$genere = safe('genere');
$pais = safe('pais');
$web = safe('web');

$errors = [];

if ($nom === "") { $errors[] = "El camp 'Nom' és obligatori."; }
if ($email === "") { $errors[] = "El camp 'Email' és obligatori."; }
?>
<!doctype html>
<html lang="ca">
<head>
  <meta charset="utf-8" />
  <title>Registre - Resultat</title>
  <link rel="stylesheet" href="../css/estils.css" />
  <link rel="stylesheet" href="../css/process.css" />
</head>
<body>
  <?php include __DIR__ . '/partials/cap.partial.php'; ?>
  <?php include __DIR__ . '/partials/menu.partial.php'; ?>

  <main>
    <section class="result">
      <h2>Resultat del registre</h2>

      <?php if (!empty($errors)): ?>
        <div class="errors">
          <h3>S'han detectat errors:</h3>
          <ul>
            <?php foreach ($errors as $e): ?>
              <li><?php echo $e; ?></li>
            <?php endforeach; ?>
          </ul>
          <p><a href="../index.php?apartat=registre">Tornar al registre</a></p>
        </div>
      <?php else: ?>
        <div class="data">
          <p><strong>Nom:</strong> <?php echo $nom !== "" ? $nom : "<em>Valor buit</em>"; ?></p>
          <p><strong>Cognoms:</strong> <?php echo $cognoms !== "" ? $cognoms : "<em>Valor buit</em>"; ?></p>
          <p><strong>Email:</strong> <?php echo $email; ?></p>
          <p><strong>Gènere:</strong> <?php echo $genere !== "" ? $genere : "<em>No indicat</em>"; ?></p>
          <p><strong>País:</strong> <?php echo $pais !== "" ? $pais : "<em>No indicat</em>"; ?></p>
          <p><strong>Web:</strong> <?php
            echo $web !== "" ? '<a href="' . $web . '" target="_blank" rel="noopener noreferrer">' . $web . '</a>' : '<em>Sense web</em>';
          ?></p>
        </div>
        <p><a href="../index.php?apartat=inici">Tornar a l'inici</a></p>
      <?php endif; ?>
    </section>
  </main>

  <?php include __DIR__ . '/partials/peu.partial.php'; ?>
</body>
</html>