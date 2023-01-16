<?php
require 'partials/header.view.php';
require 'partials/navdashboardAdmin.view.php';
?>

<body>
    <?php print '<div class="reserves_body">
        <table class="reserves_table users_table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Contraseña</th>
                    <th>Modificar</th>
                </tr>
            </thead>
            <tbody>';
    foreach ($users as $u) {
        print $u->renderUsersTable();
    }
    print '</tbody>
        </table>
    </div>'; ?>
</body>

</html>