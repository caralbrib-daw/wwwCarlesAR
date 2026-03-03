<?php
// Al principio de index.php, processaRegistre.php y processaContacte.php
session_start();

// Lógica para guardar el estilo en la sesión
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['estil'])) {
    $_SESSION['estil'] = $_POST['estil'];
}

// Recuperar el estilo de la sesión (si no existe, vacío)
$estil = $_SESSION['estil'] ?? "";
?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="css-form">
    <label>CSS: </label>
    <label><input type="radio" name="estil" value="1"> Roig</label>
    <label><input type="radio" name="estil" value="2"> Marró</label>
    <label><input type="radio" name="estil" value=""> Per defecte</label>
    <button type="submit">Canvia</button>
</form>