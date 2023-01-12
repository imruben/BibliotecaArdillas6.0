<?php
require 'partials/header.view.php';
require 'partials/navhome.view.php';
?>

<body>
<div class="nav__links">
            <li><a id="catalogue__navlink" class="navlink button" href="/dashboard">
                    Cátalogo</a></li>
            <li><a class="navlink derecha" href="/dashboard/bookings">Mis reservas</a></li>
            <li><a class="navlink derecha" href="#">Historial</a></li>
        </div>
        <div class="caja2">
            <div class="closesession">
                <i class="logouticon material-icons">logout</i>
                <a href="/auth/logout">Cerrar sesion</a>
            </div>
        </div>
    </header>
    <div class="users">
        <div class="user">
            <img src="ardillaSurf.png" class="fotoUser">
            <div class="datosUser">
                <p class="nombreUser">perico</p>
                <p class="rolUser">socio</p>
            </div>
        </div>
        <div class="user">
            <img src="ardillaTrabajador.jpg" class="fotoUser">
            <div class="datosUser">
                <p class="nombreUser">salva</p>
                <p class="rolUser">trabajador</p>
            </div>
        </div>
    </div>
</body>
</html>