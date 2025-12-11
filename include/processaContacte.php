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
        print_field_contact('Email', $email !== "" ? $email : '', has_text_value('email'));
        print_field_contact('Assumpte', $assumpte !== "" ? $assumpte : '', has_text_value('assumpte'));
        if (has_text_value('missatge')) {
            echo '<div><strong>Missatge:</strong></div>';
            echo '<div class="msg">' . nl2br($missatge) . '</div>';
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