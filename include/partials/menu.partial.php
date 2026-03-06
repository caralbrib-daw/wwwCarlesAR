<nav>
  <ul class="menu">
    <li><a href="index.php?apartat=inici">Inici</a></li>
    <li><a href="index.php?apartat=registre">Registre</a></li>
    <li><a href="index.php?apartat=contacte">Contacte</a></li>
    <li><a href="index.php?apartat=apadrina">Apadrina</a></li>
    <li><a href="login.partial.php">Login</a></li>
  </ul>
</nav>
<?php if (isset($_SESSION['user_nom'])): ?>
    <li>Hola, <?php echo $_SESSION['user_nom']; ?></li>
    <li><a href="include/logout.php">Logout</a></li>
    
    <?php if ($_SESSION['user_role'] === 'admin'): ?>
        <li><a href="index.php?apartat=admin">Administració</a></li>
    <?php endif; ?>
    
<?php else: ?>
    <li><a href="index.php?apartat=login">Login</a></li>
<?php endif; ?>