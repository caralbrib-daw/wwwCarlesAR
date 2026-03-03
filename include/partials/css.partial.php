<?php
// include/partials/css.partial.php
?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="css-form">
    <label>CSS: </label>
    <label><input type="radio" name="estil" value="1"> Roig</label>
    <label><input type="radio" name="estil" value="2"> Marró</label>
    <label><input type="radio" name="estil" value=""> Per defecte</label>
    <button type="submit">Canvia</button>
</form>