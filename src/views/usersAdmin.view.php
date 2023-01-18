<?php
require 'partials/header.view.php';
require 'partials/navdashboardAdmin.view.php';
?>

<body>
    <div class="titleWelcome">
        <h2>Usuarios Aplicación </h2>
    </div>
    <?php print '<div class="reserves_body">
        <table class="reserves_table users_table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Rol</th>
                    <th>Modificar</th>
                </tr>
            </thead>
            <tbody>';
    foreach ($users as $u) {
        print $u->renderUsersTableAdmin();
    }
    print '</tbody>
        </table>
    </div>'; ?>
</body>

</html>