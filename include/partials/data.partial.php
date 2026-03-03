<?php
// include/partials/data.partial.php
$dies = ['Diumenge', 'Dilluns', 'Dimarts', 'Dimecres', 'Dijous', 'Divendres', 'Dissabte'];
$mesos = ['', 'Gener', 'Febrer', 'Març', 'Abril', 'Maig', 'Juny', 'Juliol', 'Agost', 'Setembre', 'Octubre', 'Novembre', 'Desembre'];

$diaSetmana = $dies[date('w')];
$diaMes = date('j');
$mes = $mesos[date('n')];
$any = date('Y');

echo "<p class='data-actual'>$diaSetmana, $diaMes de $mes de $any</p>";
?>