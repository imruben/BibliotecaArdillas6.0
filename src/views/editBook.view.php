<?php
require 'partials/header.view.php';
require 'partials/navdashboardAdmin.view.php';
?>


<body>
    <div class="admin_addbook_form">
        <div class="loginmodal">
            <form class="formlogin" action="/dashboard/editBook/<?php print $book->getISBN() ?>" method='POST'>
                <label for="ISBN">ISBN</label>
                <input maxlength="13" minlength="13" type="text" name="ISBN" placeholder="1542635894125" value="<?php print $book->getISBN() ?>" required>
                <label for="title">Título</label>
                <input type="text" name="title" placeholder="Bellota y sus amigos" value="<?php print $book->getTitle(); ?>" required>
                <label for="edition">Edición</label>
                <input max=2099 minlength="4" type="number" name="edition" placeholder="2018" value="<?php print $book->getEdition() ?>" required>
                <label for="author">Autor</label>
                <input minlength="3" maxlength="40" type="text" name="author" placeholder="Nil Ojeda" value="<?php print $book->getAuthor() ?>" required>
                <label minlength="4" maxlength="40" for="imgpath">Ruta imágen</label>
                <input type="text" name="imgPath" placeholder="bellotaysusamigos.jpg" value="<?php print $book->getImgPath() ?>" required>
                Disponible
                <input type="checkbox" name="available" <?php if ($book->getAvailable()) print 'checked' ?>>
                <button type="submit" class="formloginbutton">Modificar libro</button>
            </form>
        </div>
    </div>
</body>

</html>