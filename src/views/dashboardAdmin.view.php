<?php
require 'partials/header.view.php';
require 'partials/navdashboardAdmin.view.php';
?>

<body>

  <div class="titleWelcome">
    <h2>Bienvenido <?php print $user->getUsername();  ?> </h2>
    <a class="admin_reserves_addbook" href="/dashboard/addBook"><i class="material-icons">add</i>Añadir libro
    </a>
  </div>

  <div class="libros">

    <?php
    foreach ($books as $book) {
      print $book->renderBookAdmin();
    }
    ?>
  </div>
</body>

</html>