<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto PHP</title>
    <link rel="stylesheet" href="css/estils.css">
</head>
<?php
    $include = __DIR__ . '/include/';
?>
<body>
    <?php 
        include $include . 'cap.partial.php';
        $path = "";
        include $include . 'partials/data.partial.php';
        include $include . 'menu.partial.php';
        include $include . 'principal.partial.php';

        $archivo_actual = basename($_SERVER['PHP_SELF']);

        if (strcmp($archivo_actual, 'index.php') == 0) {
            echo "<br>Estàs a la pàgina principal.";
        } else {
            echo "<br>Estàs en una secció interna o de processament.";
        }

        include $include . 'peu.partial.php';
    ?>
</body>
</html>