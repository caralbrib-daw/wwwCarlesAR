<?php
function safe($k) {
    if (!isset($_POST[$k])) return "";
    return trim(htmlspecialchars($_POST[$k], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'));
}

$email = safe('email');
$assumpte = safe('assumpte');
$missatge = safe('missatge');

$errors = [];
if ($email === "") $errors[] = "El camp 'Email' és obligatori.";
if ($assumpte === "") $errors[] = "El camp 'Assumpte' és obligatori.";
if ($missatge === "") $errors[] = "El camp 'Missatge' és obligatori.";
?>
<!doctype html>
<html lang="ca">
<head>
  <meta charset="utf-8" />
  <title>Contacte - Resultat</title>
  <link rel="stylesheet" href="../css/estils.css" />
  <link rel="stylesheet" href="../css/process.css" />
</head>
<body>
  <?php include __DIR__ . '/partials/cap.partial.php'; ?>
  <?php include __DIR__ . '/partials/menu.partial.php'; ?>

  <main>
    <section class="result">
      <h2>Resultat contacte</h2>
      <?php if (!empty($errors)): ?>
        <div class="errors">
          <h3>S'han detectat errors:</h3>
          <ul>
            <?php foreach ($errors as $e): ?>
              <li><?php echo $e; ?></li>
            <?php endforeach; ?>
          </ul>
          <p><a href="../index.php?apartat=contacte">Tornar al contacte</a></p>
        </div>
      <?php else: ?>
        <div class="data">
          <p><strong>Email:</strong> <?php echo $email; ?></p>
          <p><strong>Assumpte:</strong> <?php echo $assumpte; ?></p>
          <p><strong>Missatge:</strong></p>
          <div class="msg"><?php echo nl2br($missatge); ?></div>
        </div>
        <p><a href="../index.php?apartat=inici">Tornar a l'inici</a></p>
      <?php endif; ?>
    </section>
  </main>

  <?php include __DIR__ . '/partials/peu.partial.php'; ?>
</body>
</html>