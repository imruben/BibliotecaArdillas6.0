<?php
require 'partials/header.view.php';
require 'partials/navdashboardAdmin.view.php';
?>


<body>
    <div class="admin_addbook_form">
        <div class="loginmodal">
            <form class="formlogin" action="/dashboard/addBook" method='POST'>
                <label for="ISBN">ISBN</label>
                <input maxlength="13" minlength="13" type="text" name="ISBN" placeholder="1542635894125" required>
                <label for="title">Título</label>
                <input type="text" name="title" placeholder="Bellota y sus amigos" required>
                <label for="edition">Edición</label>
                <input max=2099 minlength="4" type="number" name="edition" placeholder="2018" required>
                <label for="author">Autor</label>
                <input minlength="3" maxlength="40" type="text" name="author" placeholder="Nil Ojeda" required>
                <label minlength="4" maxlength="40" for="imgpath">Ruta imágen</label>
                <input type="text" name="imgPath" placeholder="bellotaysusamigos.jpg" required>
                Disponible
                <input type="checkbox" name="available" checked="true">
                <button type="submit" class="formloginbutton">Añadir libro</button>
            </form>
        </div>
    </div>
</body>

</html>