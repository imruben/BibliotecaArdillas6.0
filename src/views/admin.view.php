<?php
require 'partials/header.view.php';
//require 'partials/navhome.view.php';
?>

<body>
    <header>
        <div class="nv">

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
            <img src="/public/img/ardillaSurf.png" class="fotoUser">
            <div class="datosUser">
                <p class="nombreUser">perico</p>
                <p class="rolUser">socio</p>
            </div>
        </div>
        <div class="user">
            <img src="/public/img/ardillaTrabajador.jpg" class="fotoUser">
            <div class="datosUser">
                <p class="nombreUser">salva</p>
                <p class="rolUser">trabajador</p>
            </div>
        </div>
    </div>
</body>
</html>