<section>
  <h2>Contacte</h2>
  <form method="post" action="/wwwCarlesAR/include/processaContacte.php" novalidate>
    <ul class="form-list">
      <li><label>Correu electrònic: <input type="email" name="email" required></label></li>
      <li><label>Assumpte: <input type="text" name="assumpte" required></label></li>
      <li><label>Missatge:<br>
          <textarea name="missatge" rows="6" required></textarea>
      </label></li>
      <li class="buttons">
        <input type="submit" name="envia" value="Enviar">
        <input type="reset" value="Netejar">
      </li>
      <li>
        <label>Puntuació (1 a 5):
          <input type="number" name="punts" min="1" max="5" required>
        </label>
      </li>
      <li>
        <label>Multiplicador:
          <input type="range" name="mult" min="1" max="100" value="1">
        </label>
      </li>
    </ul>
  </form>
</section>