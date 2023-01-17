<?php
require 'partials/header.view.php';
require 'partials/navdashboardWorker.view.php';
?>

<body>
    <?php foreach ($reserves as $r) {
        // print_r($r);
    } ?>
    <div class="titleWelcome">
        <h2>Reservas </h2>
    </div>
    <?php
    if (!$reserves) {
        print '<h3 style="text-align:center">No hay reservas activas<h3>';
    } else {
        print '<div class="reserves_body">
        <table class="reserves_table reservas_table">
        <thead>
            <tr>
                <th>Usuario</th>
                <th></th>
                <th>ISBN</th>
                <th>Fecha Reserva</th>
                <th>Fecha Devolución</th>
                <th>Recargo</th>
                <th>Modificar</th>
            </tr>
        </thead>
        <tbody>';
        foreach ($reserves as $r) {
            print $r->renderReserveTableAdmin();
        }
        print '</tbody>
    </table>
    </div>';
    } ?>
    </div>


</body>

</html>