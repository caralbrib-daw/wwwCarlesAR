<?php
// include/processaRegistre.php
include_once 'config.php';
include_once 'funcions.php';

// ... (después de validar los errores básicos de campos vacíos)

if (empty($errors)) {
    $resultat = insereixUsuari($nom, $cognoms, $email, $password_raw);

    if ($resultat === "usuariExisteix") {
        $errors[] = "Error: L'usuari $email ja existeix en la base de dades.";
    } elseif ($resultat === true) {
        // Registro éxito
        registreAccionsUsuari('REGISTRE', $email, __DIR__ . '/../log/accionsUsuari.log');
        echo "<p class='success'>Usuari registrat correctament.</p>";
    } else {
        $errors[] = "Error crític en registrar l'usuari.";
    }
}
// Al principio de index.php, processaRegistre.php y processaContacte.php
session_start();

// Lógica para guardar el estilo en la sesión
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['estil'])) {
    $_SESSION['estil'] = $_POST['estil'];
}

// Recuperar el estilo de la sesión (si no existe, vacío)
$estil = $_SESSION['estil'] ?? "";

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

function print_field($label, $value, $isValuePresent) {
    if ($isValuePresent) {
        echo '<p><strong>' . $label . ':</strong> ' . $value . '</p>';
    } else {
        echo '<p><strong>' . $label . ':</strong> <span class="valor-buit">Valor buit</span></p>';
    }
}

$nom_raw = get_post_raw('nom');
$cognoms_raw = get_post_raw('cognoms');
$email_raw = get_post_raw('email');
$password_raw = get_post_raw('password');
$genere_raw = get_post_raw('genere');
$pais_raw = get_post_raw('pais');
$web_raw = get_post_raw('web');

$nom = safe_text($nom_raw);
$cognoms = safe_text($cognoms_raw);
$email = safe_text($email_raw);
$password = safe_text($password_raw);
$genere = $genere_raw !== null ? htmlspecialchars((string)$genere_raw, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') : null;
$pais = $pais_raw !== null ? htmlspecialchars((string)$pais_raw, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') : null;
$web = safe_text($web_raw);

$errors = [];
if (!has_text_value('nom'))  $errors[] = "El camp 'Nom' és obligatori o buit.";
if (!has_text_value('email')) $errors[] = "El camp 'Email' és obligatori o buit.";

?><!doctype html>
<html lang="ca">
<head>
  <meta charset="utf-8" />
  <title>Registre - Resultat</title>
  <link rel="stylesheet" href="../css/styles.css" />
  <link rel="stylesheet" href="../css/process.css" />

  <?php
  $estil = $_POST['estil'] ?? "";

  if ($estil === "1") {
      echo '<link rel="stylesheet" href="../css/estilsregistre1.css">';
  } else if ($estil === "2") {
      echo '<link rel="stylesheet" href="../css/estilsregistre2.css">';
  }
  ?>
</head>
<body>
  <?php include __DIR__ . '/partials/cap.partial.php'; ?>
  <?php include __DIR__ . '/partials/menu.partial.php'; ?>
  <?php include __DIR__ . '/dadesAnimals.php'; ?>

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
      <?php endif; ?>

      <div class="data">
        <h3>Dades enviades:</h3>

        <?php
        print_field('Nom', $nom !== "" ? $nom : '', has_text_value('nom'));

        print_field('Cognoms', $cognoms !== "" ? $cognoms : '', has_text_value('cognoms'));

        print_field('Email', $email !== "" ? $email : '', has_text_value('email'));

        if (isset($_POST['password']) && strcmp(trim((string)$_POST['password']), "") !== 0) {
            $masked = str_repeat('*', 8);
            echo '<p><strong>Password:</strong> <span class="campo-valor">' . $masked . '</span></p>';
        } else {
            echo '<p><strong>Password:</strong> <span class="valor-buit">Valor buit</span></p>';
        }

        if (isset($_POST['genere'])) {
            echo '<p><strong>Gènere:</strong> <span class="campo-valor">' . $genere . '</span></p>';
        } else {
            echo '<p><strong>Gènere:</strong> <span class="valor-buit">Sense valor</span></p>';
        }

        if (isset($_POST['pais']) && strcmp(trim((string)$_POST['pais']), "") !== 0) {
            echo '<p><strong>País:</strong> <span class="campo-valor">' . $pais . '</span></p>';
        } else {
            echo '<p><strong>País:</strong> <span class="valor-buit">Sense valor</span></p>';
        }

        if (has_text_value('web')) {
            $href = $web;
            if (strpos($href, 'http://') !== 0 && strpos($href, 'https://') !== 0) {
                $href = 'http://' . $href;
            }
            echo '<p><strong>Web:</strong> <a href="' . $href . '" target="_blank" rel="noopener noreferrer">' . $web . '</a></p>';
        } else {
            echo '<p><strong>Web:</strong> <span class="valor-buit">Sense web</span></p>';
        }

        include __DIR__ . '/partials/data.partial.php';

        

        if (isset($_POST['animal']) && isset($dadesAnimals[$_POST['animal']])) {
    $clau = $_POST['animal'];
    $info = $dadesAnimals[$clau];
    
    echo "<h3>Dades de l'animal: " . ucfirst($clau) . "</h3>";
    echo "<table border='1' class='tabla-animal'>";
    foreach ($info as $titol => $valor) {
        echo "<tr><th>$titol</th><td>$valor</td></tr>";
    }
    echo "</table>";
} else {
          echo "<p><strong>Animal apadrinat:</strong> <span class='valor-buit'>Sense valor</span></p>";
          echo "<img src='../desconegut.png' class='animal-img' alt='Sense valor'></br>";
        }

        echo "<br><h2>Animal en Perill del Mes</h2>";

        if (isset($_POST['animalextincio']) && is_array($_POST['animalextincio'])) {
          $animalenextencion = $_POST['animalextincio'];

          $elegidos=$_POST['animalextincio'];
          
          $opciones = [
            '1' => 'Elefent africà de bosc',
            '2' => 'Lleopard dAmur',
            '3' => 'Marsopa de Califòrnia',
            '4' => 'Mussol de Blewitt',
            '5' => 'Pangolí Malai',
            '6' => 'Saolà',
          ];
          
          $fotos = [
            '1' => 'elefantafricadebosc.jpeg',
            '2' => 'loepardodeamur.jpg',
            '3' => 'mariposacaliforniana.jpeg',
            '4' => 'buhoblewitt.jpg',
            '5' => 'pangolinmalayo.jpeg',
            '6' => 'saola.jpg',
          ];

          $nombres = [];

          
    // Convertimos los números a palabras usando el mapa
      foreach ($elegidos as $valor) {
        if (isset($opciones[$valor])) {
            echo "<img src='../images/perill/{$fotos[$valor]}' class='animal-img'> ";
            $nombres[] = $opciones[$valor];
        }
      }

      echo "<br>";

    // Unimos los nombres en un string bonito
      if (count($nombres) > 0) {
        $mensaje = implode(', ', $nombres);
        // Reemplazamos la última coma por una "y" para que suene natural
        $mensaje = preg_replace('/, ([^,]+)$/', ' y $1', $mensaje);
        
        echo "Has elegido al " . $mensaje;
      }
      } else {
        echo "<img src='../images/desconegut.png' class='animal-img'><br>";
        echo "No has seleccionado ninguna casilla.";
      }

      include_once __DIR__ . '/funcions.php';
      if (empty($errors)) {
        registreAccionsUsuari('REGISTRE', $email, __DIR__ . '/../log/accionsUsuari.log');
      }

// include/processaRegistre.php
include_once 'config.php';
include_once 'funcions.php';

// ... (después de validar los errores básicos de campos vacíos)

if (empty($errors)) {
    $resultat = insereixUsuari($nom, $cognoms, $email, $password_raw);

    if ($resultat === "usuariExisteix") {
        $errors[] = "Error: L'usuari $email ja existeix en la base de dades.";
    } elseif ($resultat === true) {
        // Registro éxito
        registreAccionsUsuari('REGISTRE', $email, __DIR__ . '/../log/accionsUsuari.log');
        echo "<p class='success'>Usuari registrat correctament.</p>";
    } else {
        $errors[] = "Error crític en registrar l'usuari.";
    }
}

$password = $_POST['password'] ?? "";
$password_confirm = $_POST['password_confirm'] ?? "";

if ($password !== $password_confirm) {
    // Si no coinciden, redirigimos con un error
    header("Location: ../index.php?apartat=registre&error=password");
    exit;
}
      ?>
      </div>

      <p><a href="../index.php?apartat=inici">Tornar a l'inici</a></p>
      
    </section>
  </main>
  <?php include __DIR__ . '/partials/peu.partial.php'; ?>
</body>
</html>