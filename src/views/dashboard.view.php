<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="..\..\public\css\style.css">
  <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
</head>

<body>
  <?php
  var_dump($user);
  print $user->username;
  print_r($llibres);
  ?>
  <div class="title">
    <h2>Bienvenido <?php print $user->username ?></h2>
    <h2>Rol: <?php print $user->idRol ?> </h2>
    <h1>Catalogo</h1>
  </div>
  <div class="libros">
    <?php foreach ($llibres as $llibre) {
      $srcImg = '..\..\public\img\bookcovers\\' . $llibre->imgPath;

      print '<div class="libro" id="">
        <img src="' . $srcImg . '">
        <h2 class="titleLibro">' . $llibre->title . '</h2>
        <p class="autorLibro"><b>Autor: </b>' . $llibre->idAuthor . '</p>
        <p class="isbnLibro"><b>ISBN: </b>' . $llibre->ISBN . '</p>
        <p class="edicionLibro"><b>Edicion: </b>' . $llibre->edition . '</p>
        <p class="descripcionLibro">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
        <img src="..\..\public\img\papelera.png" class="papeleraImg">
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