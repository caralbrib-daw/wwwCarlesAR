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
    
    <p><strong>Missatge processat:</strong></p>

<?php 
    $paraules = explode(" ", trim($missatge));
    $num_paraules = count($paraules);

    // --- LÓGICA DE DIMENSIONES ---
    if ($num_paraules <= 36) {
        // Tabla cuadrada: la raíz cuadrada redondeada hacia arriba
        // Ej: 7 palabras -> sqrt(7) = 2.6 -> ceil = 3. Tabla 3x3
        $columnes = ceil(sqrt($num_paraules));
        $files = $columnes;
    } else {
        // Más de 36 palabras: 6 columnas fijas
        $columnes = 6;
        $files = ceil($num_paraules / $columnes);
    }

    // --- DIBUJAR LA TABLA ---
    echo "<table class='taula-missatge'>";
    
    $index_paraula = 0; // Para saber qué palabra toca imprimir

    for ($f = 0; $f < $files; $f++) {
        echo "<tr>";
        for ($c = 0; $c < $columnes; $c++) {
            
            // 1. Elegimos una clase de fondo aleatoria (del 1 al 5)
            $num_aleatori = random_int(1, 5);
            $classe_aleatoria = "fons0" . $num_aleatori;

            // 2. Comprobamos si hay palabra o si la celda queda vacía
            if ($index_paraula < $num_paraules) {
                $p = $paraules[$index_paraula];
                $p_neta = rtrim(mb_strtolower($p), ".,;:?!");
                
                // Aplicamos las reglas especiales de color (animal, llarga, etc.)
                if ($p_neta == "animal" || $p_neta == "apadrinar") {
                    $classe_aleatoria = "fons_destacada";
                } elseif (mb_strlen($p) >= 10) {
                    $classe_aleatoria = "fons_llarga";
                }

                // Imprimimos la celda con la palabra dentro de un span blanco
                echo "<td class='$classe_aleatoria'>";
                echo "<span class='caixa-paraula'>$p</span>";
                echo "</td>";
                
                $index_paraula++;
            } else {
                // Celda vacía (si ya no quedan palabras)
                echo "<td class='$classe_aleatoria'></td>";
            }
        }
        echo "</tr>";
    }
    echo "</table>";
?>
</body>
</html>