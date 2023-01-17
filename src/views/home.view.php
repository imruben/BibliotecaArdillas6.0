<?php
require 'partials/header.view.php';
require 'partials/navhome.view.php';
?>

<body>

  <div class="header">
    <img src="..\..\public\img\logo.png" class="logoHome">
    <h1>Biblioteca de ardillas</h1>
  </div>
  <div id="modalError">
    <?php if (isset($loginError)) print $loginError ?>
  </div>

  <div class="ardillanuts">
    <img src="..\..\public\img\ardilla1.jpeg" class="imgArdilla1">
  </div>

  <!-- modal para login -->
  <div class="loginmodal hidden">
    <form class="formlogin animate" action="/auth/signin" method='POST'>
      <label for="email">Email o Username</label>
      <input type="text" name="email" placeholder="youremail@gmail.com" required><br><br>
      <label for="password">Contraseña</label>
      <input type="password" name="password" placeholder="********" required>
      <p>Recordarme en este equipo</p>
      <input type="checkbox" name="rememberuser">
      <button type="submit" class="formloginbutton">Iniciar Sesión</button>

    </form>
  </div>
  <div class="overlay hidden"></div>

  <!-- modal para registrarse -->
  <div class="registermodal hidden">
    <form class="formlogin animate" action="/auth/signup" method='POST'>
      <label for="email">Email</label>
      <input type="email" name="email" placeholder="youremail@gmail.com" required><br><br>
      <label for="username">Nombre de usuario</label>
      <input type="text" name="username" placeholder="pepeViyuela" required><br><br>
      <label for="phone">Telèfon</label>
      <input type="tel" name="phone" placeholder="666555444" pattern="[0-9]{9}" required><br><br>
      <label for="password">Contraseña</label>
      <input type="password" name="password" placeholder="1234" required>
      <button type="submit" class="formloginbutton">Registrarse</button>

    </form>
  </div>
</body>
<script src="..\..\public\js\modal.js"></script>

</html>