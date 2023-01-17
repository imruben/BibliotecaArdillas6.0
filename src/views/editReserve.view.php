<?php
require 'partials/header.view.php';
require 'partials/navdashboardAdmin.view.php';

?>

<body>
    <div class="admin_addbook_form">
        <div class="loginmodal">
            <form class="formlogin" action="/dashboard/editReserve/<?php print $reserve->getISBN(); ?>" method='POST'>
                <label for="idUser">ID Usuario</label>
                <input type="text" name="idUser" value="<?php print $reserve->getIdUser() ?>" required>
                <label for="username">Nombre Usuario</label>
                <input type="text" name="username" value="<?php print $reserve->getUsername() ?>" required>
                <label for="ISBN">ISBN</label>
                <input type="text" name="ISBN" value="<?php print $reserve->getISBN(); ?>" disabled required>
                <label for="reserve_date">Dia de Reserva</label>
                <input type="date" name="reserve_date" value="<?php print $reserve->getReserveDate()->format('Y-m-d') ?>" required>
                <label for="reserve_date">Dia de Devolución</label>
                <input type="date" name="return_date" value="<?php print $reserve->getReturnDate()->format('Y-m-d') ?>" required>
                <label style="align-self:center" for="setavailable">Poner el libro en disponible</label>
                <input type="checkbox" name="setavailable">
                <button type="submit" class="formloginbutton">Modificar reserva</button>
            </form>
        </div>
    </div>
</body>

</html>