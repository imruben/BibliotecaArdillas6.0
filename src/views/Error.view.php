<?php
require 'partials/header.view.php';
?>

<body>
    <div id="errorCaja">
        <div id="error">
            <h1>ERROR 🐿️</h1>
            <h2>
                <?php if (isset($errorMsg)) {
                    print $errorMsg;
                } else {
                    print 'Ruta no encontrada 😢';
                }
                ?>
            </h2>
            <img src="..\..\public\img\ardillaerror.png" alt="">
        </div>
    </div>
</body>

</html>