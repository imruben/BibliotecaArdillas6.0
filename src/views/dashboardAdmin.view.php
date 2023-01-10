<?php
require 'partials/header.view.php';
require 'partials/navdashboard.view.php';
?>

<body>
  <?php
  // var_dump($user);
  // print $user->username;
  // print_r($llibres);
  ?>
  <div class="title">
    <h2>Rol: <?php print $user->idRol ?> </h2>
    <h1 id="tituloseccionDashboard">Catalogo</h1>
  </div>

  <div class="libros">
    <?php foreach ($llibres as $llibre) {
      $srcImg = '..\..\public\img\bookcovers\\' . $llibre->imgPath;

      print '<div class="libro" id="">
        <img id="portadaLibroCatalogo" src="' . $srcImg . '">
        <h2 class="titleLibro">' . $llibre->title . '</h2>
        <p class="autorLibro"><b>Autor: </b>' . $llibre->idAuthor . '</p>
        <p class="isbnLibro"><b>ISBN: </b>' . $llibre->ISBN . '</p>
        <p class="edicionLibro"><b>Edicion: </b>' . $llibre->edition . '</p>
        <p class="descripcionLibro">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
        <img src="..\..\public\img\papelera.png" class="papeleraImg">
        <a href="#"><button>Reservar</button></a>
      </div>';
    } ?>

    <!-- <div class="libro" id="">
      <img src="..\..\public\img\bookcovers\bellotaysusamigos.jpg">
      <h2 class="titleLibro">Las bellotas y el ser humano</h2>
      <p class="autorLibro"><b>Autor: </b>Nil Ojeda</p>
      <p class="isbnLibro"><b>ISBN: </b>696969</p>
      <p class="edicionLibro"><b>Edicion: </b>2077</p>
      <p class="descripcionLibro">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
      <img src="..\..\public\img\papelera.png" class="papeleraImg">
    </div>
    <div class="libro" id="">
      <img src="..\..\public\img\bookcovers\lasbellotasyelserhumano.jpg">
      <h2 class="titleLibro">Bellota y sus amigos</h2>
      <p class="autorLibro"><b>Autor: </b>Jaime Altozano</p>
      <p class="isbnLibro"><b>ISBN: </b>123546</p>
      <p class="edicionLibro"><b>Edicion:</b> 2020</p>
      <p class="descripcionLibro">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
      <img src="..\..\public\img\papelera.png" class="papeleraImg">
    </div> -->
  </div>
</body>

</html>