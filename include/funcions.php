<?php
// include/funcions.php
declare(strict_types=1);

function registreNavegacio(string $apartat, string $ruta_log): void {
    $dir_log = dirname($ruta_log);
    $dir_backup = $dir_log . '/backup';

    // Crear carpetas si no existen [cite: 602, 603]
    if (!file_exists($dir_log)) mkdir($dir_log, 0777, true);
    if (!file_exists($dir_backup)) mkdir($dir_backup, 0777, true);

    // Contar líneas para el número de secuencia y backup [cite: 598, 599]
    $num_linia = 1;
    if (file_exists($ruta_log)) {
        $linies = file($ruta_log);
        $num_linia = count($linies) + 1;
    }

    $data = date('d/m/Y');
    $hora = date('H:i:s');
    $linia = "$num_linia:: Accés a l'apartat " . strtoupper($apartat) . " el dia $data a l'hora $hora\n";

    file_put_contents($ruta_log, $linia, FILE_APPEND);

    // Backup cada 10 líneas [cite: 599, 600, 601]
    if ($num_linia % 10 === 0) {
        $nom_backup = $dir_backup . "/backup_" . date('dmY_His') . ".log";
        copy($ruta_log, $nom_backup);
    }
}

function registreAccionsUsuari(string $accio, string $usuari, string $ruta_log): void {
    if (!file_exists(dirname($ruta_log))) mkdir(dirname($ruta_log), 0777, true);

    $data = date('d/m/Y');
    $hora = date('H:i:s');
    $linia = "L'usuari $usuari ha realitzat l'acció " . strtoupper($accio) . " el dia $data a l'hora $hora\n";

    file_put_contents($ruta_log, $linia, FILE_APPEND);
}