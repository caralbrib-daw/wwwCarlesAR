<?php
    $default = "../css/estils.css";
    $estil1  = "../css/estilsregistre1.css";
    $estil2  = "../css/estilsregistre2.css";

    // Validamos el estilo antes de cargarlo
    $hoja_estilo = $default;
    if (isset($_POST['estilos'])) {
        if ($_POST['estilos'] == 'rojo') $hoja_estilo = $estil1;
        else if ($_POST['estilos'] == 'verde') $hoja_estilo = $estil2;
    }
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Processa Registre</title>
    <link rel="stylesheet" href="<?php echo $hoja_estilo; ?>">
</head>

<?php
    // Estilo para valores vacíos (requisito de tu ejercicio)
    $msg_buit = "<span style='color: red; font-style: italic;'>Valor Buit</span>";

    if (isset($_POST['envia'])) {
        // VALIDACIÓN OBLIGATORIOS
        if ((!isset($_POST['nom']) || strcmp(trim(htmlspecialchars($_POST['nom'])), '') == 0) ||
            (!isset($_POST['email']) || strcmp(trim(htmlspecialchars($_POST['email'])), '') == 0) || 
            (!isset($_POST['contrasenya']) || strcmp(trim(htmlspecialchars($_POST['contrasenya'])), '') == 0) ||
            (!isset($_POST['puntuacion']) || strcmp(trim($_POST['puntuacion']), '') == 0) ||
            ($_POST['puntuacion'] < 1 || $_POST['puntuacion'] > 5)) {
            
            die('Error: Els camps Nom, Email, Contrasenya i Puntuacio (1-5) són obligatoris.');
        } else {
            // CAMPOS OBLIGATORIOS
            $nom = htmlspecialchars(trim($_POST['nom']));
            $email = htmlspecialchars(trim($_POST['email']));
            $contrasenya = htmlspecialchars(trim($_POST['contrasenya']));
            $puntuacio = (int)trim($_POST['puntuacion']);

            // CAMPOS OPCIONALES (Ojo a las mayúsculas del POST que pusiste en el HTML)
            $cognoms = (isset($_POST['cognoms']) && strcmp(trim($_POST['cognoms']), '') != 0) ? htmlspecialchars(trim($_POST['cognoms'])) : $msg_buit;
            
            // Aquí usamos 'Adreca' con A mayúscula como en tu HTML
            $adreca = (isset($_POST['Adreca']) && strcmp(trim($_POST['Adreca']), '') != 0) ? htmlspecialchars(trim($_POST['Adreca'])) : $msg_buit;
            
            // Aquí usamos 'Telefon' con T mayúscula como en tu HTML
            $telefon = (isset($_POST['Telefon']) && strcmp(trim($_POST['Telefon']), '') != 0) ? htmlspecialchars(trim($_POST['Telefon'])) : $msg_buit;

            // Select y Radios (según tus instrucciones, basta con isset)
            $apadrina = (isset($_POST['apadrina']) && $_POST['apadrina'] != "") ? $_POST['apadrina'] : "";
            $continent = isset($_POST['continent']) ? $_POST['continent'] : $msg_buit;

            // Configuración de imágenes (Ruta corregida a ../images/)
            $imagenelegida = [
                '' => '../images/desconocido.png',
                'gorilla' => '../images/gorilla.png',
                'tortuga' => '../images/tortuga.png',
                'tigre' => '../images/tigre.png',
                'rinoceront' => '../images/rinoceront.png',
                'orangutan' => '../images/orangutan.png'
            ];

            include 'dadesAnimals.php';

            $multiplicador = isset($_POST['multiplicador']) ? (int)$_POST['multiplicador'] : 1;
            $total_imatges = $puntuacio * $multiplicador;

            if (isset($_POST["animalenperill"])) {
                $animalenperill=$_POST["animalenperill"];
            } else {
                $animalenperill = [];
            }

            $quantitatNoms = count($animalenperill);
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
        <h2>Dades de Registre d'Usuari</h2>
        <p><strong>Nom:</strong> <?php echo $nom; ?></p>
        <p><strong>Cognoms:</strong> <?php echo $cognoms; ?></p>
        <p><strong>Adreça:</strong> <?php echo $adreca; ?></p>
        <p><strong>Email:</strong> <?php echo $email; ?></p>
        <p><strong>Contrasenya:</strong> <?php echo $contrasenya; ?></p>
        <p><strong>Telefon:</strong> <?php echo $telefon; ?></p>
        
        <p><strong>Animal a Apadrinar:</strong> <?php echo ($apadrina == "") ? $msg_buit : $apadrina; ?><br><br>
        <img src="<?php echo isset($imagenelegida[$apadrina]) ? $imagenelegida[$apadrina] : $imagenelegida['']; ?>" 
             alt="Imatge animal" width="150">_
        </p>
        <?php 
            if ($apadrina != "" && isset($dadesAnimals[$apadrina])): 
                $infoAnimal = $dadesAnimals[$apadrina];
        ?>
        <section style="margin-top: 30px; border: 2px solid red; border-radius: 10px; overflow: hidden; font-family: sans-serif;">
            <header style="background-color: black; color: white; padding: 10px;">
                <h3 style="margin: 0;">Fitxa Tècnica: <?php echo ucfirst($apadrina); ?></h3>
            </header>
        
            <div style="padding: 15px; background-color: black;">
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="padding: 8px; font-weight: bold; border-bottom: 1px solid #ddd; width: 30%;">Nom Científic:</td>
                        <td style="padding: 8px; border-bottom: 1px solid #ddd; font-style: italic;"><?php echo $infoAnimal['nom_cientific']; ?></td>
                    </tr>
                    <tr>
                        <td style="padding: 8px; font-weight: bold; border-bottom: 1px solid #ddd;">Estat de conservació:</td>
                        <td style="padding: 8px; border-bottom: 1px solid #ddd; color: #d32f2f;"><?php echo $infoAnimal['estat']; ?></td>
                    </tr>
                    <tr>
                        <td style="padding: 8px; font-weight: bold; border-bottom: 1px solid #ddd;">Hàbitat:</td>
                        <td style="padding: 8px; border-bottom: 1px solid #ddd;"><?php echo $infoAnimal['habitat']; ?></td>
                    </tr>
                    <tr>
                        <td style="padding: 8px; font-weight: bold; border-bottom: 1px solid #ddd;">Alimentació:</td>
                        <td style="padding: 8px; border-bottom: 1px solid #ddd;"><?php echo $infoAnimal['alimentacio']; ?></td>
                    </tr>
                </table>
            
                <div style="margin-top: 15px; padding: 10px; background: black; border-left: 4px solid black;">
                    <strong>Descripció:</strong>
                    <p style="margin: 5px 0 0 0; line-height: 1.5; color: #ffffff;"><?php echo $infoAnimal['descripcio']; ?></p>
                </div>
            </div>
        </section>

    <?php elseif ($apadrina != ""): ?>
        <p style="color: orange;">No s'ha trobat informació detallada per a aquest animal.</p>
    <?php endif; ?>
        
        <p><strong>Continent:</strong> <?php echo $continent; ?></p>
        <p><strong>Puntuació:</strong> <?php echo $puntuacio." * ".$multiplicador; ?><br><br>
        <?php for ($i = 0; $i < (int)$total_imatges; $i++): ?> 
            <img src='../images/pata.png' alt='Pata' width='30' style='margin-right: 5px;'>
        <?php endfor; ?>
        <p><strong>Animals del mes:</strong><br><br>
            <?php 
                if (!empty($animalenperill)) {
                    foreach($animalenperill as $nom){
                        echo "<img src='../images/".$nom.".png' alt='".$nom."' width='150'><br><br>";
                    }
                } else {
                    echo "<img src='../images/desconocido.png' alt='desconocido' width='150'>";
                }
            ?>
        </p>
        </p> 
    </main>
    <?php include 'peu.partial.php'; ?>
</body>
</html>