<h2>Registre</h2>
<form action="include/processaRegistre.php" method="post">
    <label for="nom">Nom:</label>
    <input type="text" id="nom" name="nom" required><br><br>
    <label for="cognoms">Cognoms:</label>
    <input type="text" id="cognoms" name="cognoms"><br><br>
    <label for="Adreca">Adreça:</label>
    <input type="text" id="Adreca" name="Adreca" placeholder="Adreça"><br><br>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br><br>
    <label for="contrasenya">Contrasenya:</label>
    <input type="password" id="contrasenya" name="contrasenya" required><br><br>
    <label for="Telefon">Telefon:</label>
    <input type="text" id="Telefon" name="Telefon" placeholder="Telefon"><br><br>
    <label for="donacio">Donació:</label>
    <select id="donacio" name="donacio">
        <option value="">-- Tria una opció --</option> <!-- Opció per defecte buida 
        <option value="gorilla">Gorilla</option>
        <option value="tortuga">Tortuga</option>
        <option value="tigre">Tigre</option>
        <option value="rinoceront">Rinoceront</option>
        <option value="orangutan">Orangutan</option>-->
    </select><br><br>
    <label for="apadrina">Animal a Apadrinar:</label>
    <select id="apadrina" name="apadrina">
        <option value="">-- Tria una opció --</option>
        <option value="gorilla">Gorilla</option>
        <option value="tortuga">Tortuga</option>
        <option value="tigre">Tigre</option>
        <option value="rinoceront">Rinoceront</option>
        <option value="orangutan">Orangutan</option>
    </select><br><br>
    <label>Continent:</label>
        <label for="europa">Europa:</label>
        <input type="radio" id="europa" name="continent" value="europa">

        <label for="asia">Àsia:</label>
        <input type="radio" id="asia" name="continent" value="asia">

        <label for="africa">Àfrica:</label>
        <input type="radio" id="africa" name="continent" value="africa">

        <label for="america">Amèrica:</label>
        <input type="radio" id="america" name="continent" value="america">

        <label for="oceania">Oceania:</label>
        <input type="radio" id="oceania" name="continent" value="oceania"><br><br>
    <label>Estils Registre:</label>
        <input type="radio" id="rojo" name="estilos" value="rojo">
        <label for="estilos">Rojo</label>

        <input type="radio" id="verde" name="estilos" value="verde">
        <label for="estilos">Verde</label><br><br>
    <label for="puntuacion">Puntua la página (1-5)</label>
    <input type="number" id="puntuacion" name="puntuacion" min="1" max="5" value="1" required>
    <input type="range" id="multiplicador" name="multiplicador" min="1" max="100" value="1"><br><br>
    <input type="submit" name="envia" id="envia" value="Envia">
    <input type="reset" value="Reset">
</form>