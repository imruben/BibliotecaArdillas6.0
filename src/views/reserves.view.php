<?php
require 'partials/header.view.php';
require 'partials/navdashboard.view.php';
?>

<body>
    <?php foreach ($reserves as $r) {
        // print_r($r);
    } ?>
    <div class="titleWelcome">
        <h2>Tus reservas </h2>
    </div>
    <?php
    if (!$reserves) {
        print '<h3 style="text-align:center">No tienes ninguna reserva activa<h3>';
    } else {
        print '<div class="reserves_body">
        <table class="reserves_table">
        <thead>
            <tr>
                <th></th>
                <th>ISBN</th>
                <th>Título</th>
                <th>Autor</th>
                <th>Edición</th>
                <th>Fecha Devolución</th>
            </tr>
        </thead>
        <tbody>';
        foreach ($reserves as $r) {
            print $r->renderReserveTable();
        }
        print '</tbody>
    </table>
    </div>';
    } ?>
    </div>


</body>

</html>