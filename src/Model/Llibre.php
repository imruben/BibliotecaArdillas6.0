<?php

namespace App\Model;

class Llibre extends Model
{
  private string $isbn;
  private string $author;
  private string $title;
  private int $edition;
  // private string $idAuthor;

  private bool $available;

  public function __construct(array $data = [])
  {
    parent::__construct($data);
    $this->isbn = $data['ISBN'];
    $this->author = $data['author'];
    $this->title = $data['title'];
    $this->edition = $data['edition'];
    $this->available = $data['available'];
  }

  public function setIsbn($isbn)
  {
    $this->isbn = $isbn;
  }
  public function setAuthor($author)
  {
    $this->author = $author;
  }
  public function settitle($title)
  {
    $this->title = $title;
  }
  public function setEdicio($edition)
  {
    $this->edition = $edition;
  }

  public function getISBN(): string
  {
    return $this->isbn;
  }
  public function getTitle(): string
  {
    return $this->title;
  }
  public function getAuthor(): string
  {
    return $this->author;
  }
  public function getEdition(): string
  {
    return $this->edition;
  }
  public function getAvailable(): string
  {
    return $this->available;
  }

  public function setUnavailable()
  {
    $this->available = 0;
    $this->qb->updateOneField('available', 0, 'isbn', $this->isbn);
  }
  public function setAvailable()
  {
    $this->available = 1;
    $this->qb->updateOneField('available', 1, 'isbn', $this->isbn);
  }

  public function renderBook(): string
  {
    $bookClass = $this->available ? 'available' : 'unavailable';

    $titleimg = str_replace(' ', '', $this->title);
    $srcImg = "\public\img\bookcovers\\{$titleimg}.jpg";
    $html = '<div class="book-card book_' . $bookClass . '">
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
            ' . $this->title . '
          </div>
          <div class="book-card__author">
          ' . $this->author . '
          </div>
          <div class="book-card__edition">
          ' . $this->edition . '
          </div>
          <div class="book-card__isbn">
          ' . $this->isbn . '
          </div>
          <div class="book-card__description">
          Lorem Ipsum has been the industrys standard dummy text ever since the 1500s</div>
          ';

    if ($this->available) {
      $html .= '<br><a class="botonReservar" href="/dashboard/reserveBook/' . $this->isbn . '">Reservar</a>';
    }

    $html .= '<br></div></div>';
    return $html;
  }


  public function renderBookAdmin(): string
  {
    $bookClass = $this->available ? 'available' : 'unavailable';
    $titleimg = str_replace(' ', '', $this->title);
    $srcImg = "\public\img\bookcovers\\{$titleimg}.jpg";
    $html = '<div class="book-card book_' . $bookClass . '">
        <div class="book-card__cover">
          <div class="book-card__book">
            <div class="book-card__book-front">
              <img class="book-card__img" src="' . $srcImg . '" />
            </div>
            <div class="book-card__book-back"></div>
            <div class="book-card__book-side"></div>
          </div>
        </div>
        <div class="book_card_information">
          <div class="book-card__title">
            ' . $this->title . '
          </div>
          <div class="book-card__author">
          ' . $this->author . '
          </div>
          <div class="book-card__isbn">
          ' . $this->isbn . '
          </div>
          <div class="book-card__edition">
          ' . $this->edition . '
          </div>
          <div class="book-card__description">
          Lorem Ipsum has been the industrys standard dummy text ever since the 1500s</div>
          ';

    if ($this->available) {
      $html .= '<br><p>Disponible 🟢<p><br>';
    } else {
      $html .= '<br><p> No Disponible 🔴<p><br>';
    }
    $html .= '<div class="admin_books_functions">
        <a href="/dashboard/removeBook/' . $this->isbn . '""><i class="material-icons">delete</i></a>
        <a href="/dashboard/editBookForm/' . $this->isbn . '""><i class="material-icons">edit</i></a>
        </div>';
    $html .= '<br></div></div>';
    return $html;
  }
  public function renderBookWorker(): string
  {
    $bookClass = $this->available ? 'available' : 'unavailable';
    $titleimg = str_replace(' ', '', $this->title);
    $srcImg = "\public\img\bookcovers\\{$titleimg}.jpg";
    $html = '<div class="book-card book_' . $bookClass . '">
        <div class="book-card__cover">
          <div class="book-card__book">
            <div class="book-card__book-front">
              <img class="book-card__img" src="' . $srcImg . '" />
            </div>
            <div class="book-card__book-back"></div>
            <div class="book-card__book-side"></div>
          </div>
        </div>
        <div class="book_card_information">
          <div class="book-card__title">
            ' . $this->title . '
          </div>
          <div class="book-card__author">
          ' . $this->author . '
          </div>
          <div class="book-card__isbn">
          ' . $this->isbn . '
          </div>
          <div class="book-card__edition">
          ' . $this->edition . '
          </div>
          <div class="book-card__description">
          Lorem Ipsum has been the industrys standard dummy text ever since the 1500s</div>
          ';

    if ($this->available) {
      $html .= '<br><p>Disponible 🟢<p><br>';
    } else {
      $html .= '<br><p> No Disponible 🔴<p><br>';
    }
    $html .= '<br></div></div>';
    return $html;
  }
}

// <form class="formreserva" action="/dashboard/prestec" method="POST">
//             <input type="hidden" name="isbn" value="' . $this->isbn  . '">
//             <button class="botonReservar" type="submit">Reservar</button>
//             </form>