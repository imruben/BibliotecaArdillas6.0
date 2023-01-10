<?php
// echo "{$titulo} Home page";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="..\..\public\css\style.css">
  <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
</head>

<body>
  <div class="buttons">
    <a><button id="loginbutton" class="formloginbutton">Iniciar sesión</button></a>
    <a><button id="registerbutton" class="formloginbutton">Registrarse</button></a>
  </div>

  <div class="card-home">
    <div class="header">
      <img src="..\..\public\img\logo.png" class="logo">
      <h2>Biblioteca de ardillas</h2>
    </div>
    <div class="a">
      <img src="..\..\public\img\ardilla1.jpeg" class="imgArdilla1">
    </div>

    <!--<div class="nav-home">
          <ul>
            <li><a href ="/auth">Sign in</a></li>
            <li><a href ="/reg">Sign up</a></li>
          </ul>
        </div>-->
  </div>
  <!-- modal para login -->
  <div class="loginmodal hidden">
    <form class="formlogin animate" action="/auth/signin" method='POST'>
      <label for="email">Email</label>
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
      <input type="text" name="email" placeholder="youremail@gmail.com" required><br><br>
      <label for="username">Nombre de usuario</label>
      <input type="text" name="username" placeholder="pepeViyuela" required><br><br>
      <label for="phone">Telèfon</label>
      <input type="text" name="phone" placeholder="666555444" required><br><br>
      <label for="password">Contraseña</label>
      <input type="password" name="password" placeholder="1234" required>
      <button type="submit" class="formloginbutton">Registrarse</button>

    </form>
  </div>
</body>
<script src="..\..\public\js\modal.js"></script>

</html>