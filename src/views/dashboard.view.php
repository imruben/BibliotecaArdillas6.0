<?php
require 'partials/header.view.php';
require 'partials/navdashboard.view.php';
?>

<body>

  <div class="titleWelcome">
    <h2>Bienvenido <?php print $user->username  ?> </h2>
  </div>


  <div class="libros">
    <?php
    foreach ($llibres as $llibre) {
      $srcImg = '..\..\public\img\bookcovers\\' . $llibre['imgPath'];

      // print '<div class="libro" id="">
      //   <img class="portadaLibroCatalogo" src="' . $srcImg . '">
      //   <h2 class="titleLibro">' . $llibre->title . '</h2>
      //   <p class="autorLibro"><b>Autor: </b>' . $llibre->idAuthor . '</p>
      //   <p class="isbnLibro"><b>ISBN: </b>' . $llibre->ISBN . '</p>
      //   <p class="edicionLibro"><b>Edicion: </b>' . $llibre->edition . '</p>
      //   <p class="descripcionLibro">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
      // <form class="formreserva" action="/dashboard/prestec" method="POST">
      // <input type="hidden" name="isbn" value="' . $llibre->ISBN . '">
      // <button class="botonReservar" type="submit">Reservar</button>
      // </form>
      // </div>';
      print '
      <div class="book-card">
    <div class="book-card__cover">
      <div class="book-card__book">
        <div class="book-card__book-front">
          <img class="book-card__img" src="' . $srcImg . '" />
        </div>
        <div class="book-card__book-back"></div>
        <div class="book-card__book-side"></div>
      </div>
    </div>
    <div>
      <div class="book-card__title">
        ' . $llibre['title'] . '
      </div>
      <div class="book-card__author">
      Nil ojeda
      </div>
      <div class="book-card__isbn">
      ' . $llibre['ISBN'] . '
      </div>
      <div class="book-card__description">
      Lorem Ipsum has been the industrys standard dummy text ever since the 1500s
      </div>
      <form class="formreserva" action="/dashboard/prestec" method="POST">
        <input type="hidden" name="isbn" value="' . $llibre['ISBN'] . '">
        <button class="botonReservar" type="submit">Reservar</button>
        </form>
    </div>
    </div>';
    } ?>
    <!-- <a class="botonReservar" href="/dashboard/prestec"><button>Reservar</button></a> -->
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