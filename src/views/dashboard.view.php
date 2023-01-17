<?php
require 'partials/header.view.php';
require 'partials/navdashboard.view.php';
?>

<body>

  <div class="titleWelcome">
    <h2>Bienvenido <?php print $user->getUsername();  ?> </h2>
  </div>
  <div class="dashboard_container">
    <div class="libros">
      <?php
      foreach ($books as $book) {
        print $book->renderBook();
      }
      ?>
    </div>
  </div>
</body>

</html>