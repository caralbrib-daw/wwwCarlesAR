<?php
declare(strict_types=1);

function get_post_raw(string $key) {
    return $_POST[$key] ?? null;
}

function safe_text($val) {
    if ($val === null) return "";
    return trim(htmlspecialchars((string)$val, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'));
}

function has_text_value($key): bool {
    if (!isset($_POST[$key])) return false;
    $v = trim(htmlspecialchars((string)$_POST[$key], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'));
    return strcmp($v, "") !== 0;
}

function print_field_contact($label, $value, $present) {
    if ($present) {
        echo '<p><strong>' . $label . ':</strong> ' . $value . '</p>';
    } else {
        echo '<p><strong>' . $label . ':</strong> <span class="valor-buit">Valor buit</span></p>';
    }
}

$email_raw = get_post_raw('email');
$assumpte_raw = get_post_raw('assumpte');
$missatge_raw = get_post_raw('missatge');

$email = safe_text($email_raw);
$assumpte = safe_text($assumpte_raw);
$missatge = safe_text($missatge_raw);

$errors = [];
if (!has_text_value('email'))  $errors[] = "El camp 'Email' és obligatori o buit.";
if (!has_text_value('assumpte')) $errors[] = "El camp 'Assumpte' és obligatori o buit.";
if (!has_text_value('missatge')) $errors[] = "El camp 'Missatge' és obligatori o buit.";

?><!doctype html>
<html lang="ca">
<head>
  <meta charset="utf-8" />
  <title>Contacte - Resultat</title>
  <link rel="stylesheet" href="wwwCarlesAR/css/styles.css" />
  <link rel="stylesheet" href="wwwCarlesAR/css/process.css" />
</head>
<body>
  <?php include __DIR__ . '/partials/cap.partial.php'; ?>
  <?php include __DIR__ . '/partials/menu.partial.php'; ?>

  <main>
<?php
$punts = intval($_POST['punts'] ?? 0);
$mult = intval($_POST['mult'] ?? 1);

$total = $punts * $mult;

switch ($punts) {
    case 1: $img = "wwwCarlesAR/images/pata1.png"; break;
    case 2: $img = "wwwCarlesAR/images/pata2.png"; break;
    case 3: $img = "wwwCarlesAR/images/pata3.png"; break;
    case 4: $img = "wwwCarlesAR/images/pata4.png"; break;
    case 5: $img = "wwwCarlesAR/images/pata5.png"; break;
    default: $img = "wwwCarlesAR/images/pata0.png"; break;
}

echo "<p><strong>Puntuació:</strong> $punts</p>";
echo "<p><strong>Multiplicador:</strong> $mult</p>";
echo "<p><strong>Total d'imatges:</strong> $total</p>";

echo "<div>";

for ($i=0; $i < $total; $i++) {
    echo "<img src='$img' class='pata-img'>";
}

echo "</div>";
?>
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
      <?php endif; ?>

      <div class="data">
<?php
if (has_text_value('missatge')) {
    echo '<h3>Missatge processat:</h3>';

    $paraules = explode(" ", $missatge);

    echo '<ul class="msg-list">';

    foreach ($paraules as $p) {
        $classe = "paraula";

        $pLower = mb_strtolower($p);

        if (strlen($p) >= 10) {
            $classe .= " llarg";
        }

        if ($pLower === "animal" || $pLower === "apadrinar") {
            $classe .= " especial";
        }

        echo "<li><span class='$classe'>$p</span></li>";
    }

    echo '</ul>';
} else {
    echo '<p><strong>Missatge:</strong> <span class="valor-buit">Valor buit</span></p>';
}
?>
      </div>

      <p><a href="../index.php?apartat=inici">Tornar a l'inici</a></p>
    </section>
  </main>

  <?php include __DIR__ . '/partials/peu.partial.php'; ?>
</body>
</html>