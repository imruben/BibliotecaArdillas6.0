<?php
require 'partials/header.view.php';
require 'partials/navdashboardWorker.view.php';
?>

<body>
    <div class="titleWelcome">
        <h2>Socios de la biblioteca </h2>
    </div>
    <?php print '<div class="reserves_body">
        <table class="reserves_table users_table">
            <thead>
                <tr>
                    <th></th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Contraseña</th>
                </tr>
            </thead>
            <tbody>';
    foreach ($users as $u) {
        print $u->renderUsersTableWorker();
    }
    print '</tbody>
        </table>
    </div>'; ?>
</body>

</html>