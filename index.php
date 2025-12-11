<?php
$apartat = "inici";
if (isset($_GET['apartat']) && is_string($_GET['apartat']) && $_GET['apartat'] !== "") {
    $apartat = $_GET['apartat'];
}

$allowed = ['inici','registre','contacte','apadrina'];
if (!in_array($apartat, $allowed)) {
    $apartat = 'inici';
}

$partials_dir = __DIR__ . '/include/partials/';
?>
<!doctype html>
<html lang="ca">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Projecte PHP - <?php echo htmlspecialchars($apartat); ?></title>
  <link rel="stylesheet" href="css/styles.css" />
</head>
<body>
  <?php include $partials_dir . 'cap.partial.php'; ?>
  <?php include $partials_dir . 'menu.partial.php'; ?>

  <main>
    <?php
      include $partials_dir . $apartat . '.partial.php';
    ?>
  </main>

  <?php include $partials_dir . 'peu.partial.php'; ?>
</body>
</html>