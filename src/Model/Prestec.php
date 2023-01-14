<?php

namespace App\Model;

use App\Model\Usuari;
use App\Model\Llibre;
use DateTime;

class Prestec extends Model
{
    protected $llibres = [];
    protected Usuari $user;
    protected Llibre $book;
    protected string $idUser;
    protected int $idReserve;
    protected DateTime $reserveDate;
    protected string $isbn;
    protected DateTime $returnDate;
    protected int $days_penalty;


    public function __construct(Usuari $user, Llibre $book, DateTime $reserveDate)
    {
        parent::__construct();
        $this->book = $book;
        $this->idUser = $user->getUserId();
        $this->isbn = $book->getISBN();
        // $this->idReserve = $data['idReserve'];
        $this->reserveDate = $reserveDate;
        $this->days_penalty = 0;
    }

    public function saveReserve(): void
    {
        $reserveData = [
            'idUser' => $this->idUser,
            'ISBN' => $this->isbn,
            'reserve_date' => $this->reserveDate->format('Ymd'),
            'days_penalty' => $this->days_penalty,
            'return_date' => $this->reserveDate->format('Ymd')
        ];

        $this->qb->insert($reserveData)->exec();
    }

    public  function renderReserveTable()
    {
        $srcImg = "\public\img\bookcovers\\{$this->book->getImgPath()}";
        $html = ' 
            <tr>
                <td> <img class="bookcover_reserves" src="' . $srcImg . '"></td>
                <td>' . $this->book->getISBN() . '</td>
                <td>' . $this->book->getTitle() . '</td>
                <td>' . $this->book->getAuthor() . '</td>
                <td>' .
            $this->book->getEdition() . '</td>
                <td>' . $this->reserveDate->format('d-m-Y') . '</td>
            </tr>';

        return $html;
    }


    public function active()
    {
    }

    public function user()
    {
        // return $this->belongsTo(Usuari::class);
    }
}
