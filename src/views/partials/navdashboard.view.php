<header>
    <div class="caja1">
        <div class="cosa">
            <a href="?url=dashboard">
                <img class="logoNav" src="public/img/logo.png" alt="Viva los monos"> </a>
            <p><?php print $user->username; ?></p>
        </div>
    </div>

    <div class="caja2">
        <!-- <i id="settingsicon" class="material-icons">settings</i> -->
        <!-- <a id="settingsbutton" class="navlink button" href="?url=usersettings">
            Configuració</a>
        <a class="navlink derecha" href="?url=privatearea">Area Privada</a> -->
        <a href="/auth/logout"><button id="closesession">Cerrar sesion</button></a>
    </div>

</header>