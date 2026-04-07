<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto PHP</title>
    <link rel="stylesheet" href="../css/estils.css">
</head>
<?php
    $apartat = isset($_GET['apartat']) ? $_GET['apartat'] : 'inici';

    $estil_error = "style='color: red; font-weight: bold;'";
    $msg_buit = "<span $estil_error>Valor Buit</span>";

    $email = $assumpte = $missatge = "";

    if (isset($_POST['envia'])) {
        if (!isset($_POST['email']) || strcmp(trim(htmlspecialchars($_POST['email'])), "") == 0 ||
            !isset($_POST['assumpte']) || strcmp(trim(htmlspecialchars($_POST['assumpte'])), "") == 0) {
            
            die('Error: Els camps Email i Assumpte són obligatoris.');
        } else {
            $email = trim(htmlspecialchars($_POST['email']));
            $assumpte = trim(htmlspecialchars($_POST['assumpte']));
            
            if (isset($_POST['missatge']) && strcmp(trim(htmlspecialchars($_POST['missatge'])), "") != 0) {
                $missatge = trim(htmlspecialchars($_POST['missatge']));
            } else {
                $missatge = $msg_buit;
            }
        }
    }
?>
<body>
    <?php 
        include 'cap.partial.php';
        $path = "../";
        include 'menu.partial.php';
    ?>
    <main>
    <h2>Dades de Missatge de Contacte</h2>
    <p><strong>Email:</strong> <?php echo $email; ?></p>
    <p><strong>Assumpte:</strong> <?php echo $assumpte; ?></p>
    
    <p><strong>Missatge processat:</strong>
    <ul style="list-style-type: none; padding: 20px; margin: 0; text-align: center;">
    <?php 
    $paraules = explode(" ", trim($missatge));

    foreach ($paraules as $p) {
        if ($p == "") continue;

        // 1. Valores por defecto (Cajita naranja)
        $fondo = "#000000";
        $color = "#ffffff";
        $borde = "#ff0000";

        $p_minuscula = mb_strtolower($p);
        $p_limpia = rtrim($p_minuscula, ".,;:?!");

        // 2. Lógica de colores según tus reglas
        if ($p_limpia == "animal" || $p_limpia == "apadrinar") {
            $fondo = "#2e7d32"; // Verde
            $color = "#ffffff"; // Blanco
            $borde = "#1b5e20";
        } elseif (mb_strlen($p) >= 10) {
            $fondo = "#000000"; // Negro
            $color = "#ffffff"; // Blanco
            $borde = "#333333";
        }

        // 3. Imprimimos con STYLE INLINE para forzar el diseño
        echo "<li style='display: inline-block; 
                         margin: 5px; 
                         padding: 5px 10px; 
                         border: 1px solid $borde; 
                         background-color: $fondo; 
                         color: $color; 
                         border-radius: 3px; 
                         font-weight: bold;'>$p</li>";
    }
    ?>
    </ul>
    </p>
    </main>
    <?php
        include 'peu.partial.php';
    ?>
</body>
</html>