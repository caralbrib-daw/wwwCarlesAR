<?php
    $diesSetmana = ["Dilluns", "Dimarts", "Dimecres", "Dijous", "Divendres", "Dissabte", "Diumenge"];
    $mesosAny = ["de gener", "de febrer", "de març", "de abril", "de maig", "de juny", 
                 "de juliol", "de agost", "de setembre", "de octubre", "de novembre", "de desembre"];

    $numDiaSetmana = date('N');
    $diaMes = date('j');
    $numMes = date('n');
    $any = date('Y');

    $dataActual = $diesSetmana[$numDiaSetmana - 1] . ", " . $diaMes . " " . $mesosAny[$numMes - 1] . " de " . $any;
?>

<div style="background-color: #000000; 
            color: white; 
            padding: 10px 30px; 
            border: 2px solid white; 
            border-radius: 10px; 
            display: inline-block; 
            margin: 10px auto;
            font-weight: bold;
            text-align: center;">
    <?php echo $dataActual; ?>
</div>