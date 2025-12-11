<section>
  <h2>Registre d'usuari</h2>
  <form method="post" action="../include/processaRegistre.php" novalidate>
    <ul class="form-list">
      <li><label>Nom: <input type="text" name="nom" required></label></li>
      <li><label>Cognoms: <input type="text" name="cognoms"></label></li>
      <li><label>Email: <input type="email" name="email" required></label></li>
      <li><label>Password: <input type="password" name="password"></label></li>
      <li>
        <label>Gènere:
          <label><input type="radio" name="genere" value="home"> Home</label>
          <label><input type="radio" name="genere" value="dona"> Dona</label>
          <label><input type="radio" name="genere" value="altre"> Altres</label>
        </label>
      </li>
      <li>
        <label>Pais:
          <select name="pais">
            <option value="">-- tria --</option>
            <option value="espanya">Espanya</option>
            <option value="andorra">Andorra</option>
            <option value="altres">Altres</option>
          </select>
        </label>
      </li>
      <li><label>Web personal: <input type="text" name="web"></label></li>
      <li class="buttons">
        <input type="submit" name="envia" value="Enviar">
        <input type="reset" value="Netejar">
      </li>
    </ul>
  </form>
</section>