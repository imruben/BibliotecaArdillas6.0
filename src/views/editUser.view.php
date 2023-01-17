<?php
require 'partials/header.view.php';
require 'partials/navdashboardAdmin.view.php';
?>

<body>
    <div class="admin_addbook_form">
        <div class="loginmodal">
            <form class="formlogin" action="/dashboard/editUser/<?php print $user->getUserId(); ?>" method='POST'>
                <label for="idUser">ID</label>
                <input type="text" name="idUser" value="<?php print $user->getUserId() ?>" required>
                <label for="username">Username</label>
                <input type="text" name="username" value="<?php print $user->getUsername(); ?>" required>
                <label for="email">Email</label>
                <input type="email" name="email" value="<?php print $user->getEmail() ?>" required>
                <label for="phone">Teléfono</label>
                <input max=999999999 type="number" name="phone" value="<?php print $user->getPhone() ?>" required>
                <label for="oldpassword">Contraseña actual</label>
                <input type="password" name="oldpassword" required>
                <label for="oldpassword">Contraseña nueva (rellenar contraseña actual)</label>
                <input type="password" name="password" required>
                <button type="submit" class="formloginbutton">Modificar usuario</button>
            </form>
        </div>
    </div>
</body>

</html>