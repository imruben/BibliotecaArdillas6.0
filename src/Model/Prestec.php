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
    // protected int $days_penalty;
    protected DateTime $actualDate;

    public function __construct(Usuari $user, Llibre $book, DateTime $reserveDate, DateTime $returnDate)
    {
        parent::__construct();
        $this->book = $book;
        $this->user = $user;
        $this->idUser = $user->getUserId();
        $this->isbn = $book->getISBN();
        // $this->idReserve = $data['idReserve'];
        $this->reserveDate = $reserveDate;
        $this->returnDate = $returnDate;
        // $this->days_penalty = 0;
        $this->actualDate = new DateTime();
    }

    public function getIdUser()
    {
        return $this->user->getUserId();
    }
    public function getUsername()
    {
        return $this->user->getUsername();
    }


    public function getISBN()
    {
        return $this->book->getISBN();
    }
    public function getReserveDate()
    {
        return $this->reserveDate;
    }
    public function getReturnDate()
    {
        return $this->returnDate;
    }


    public function saveReserve(): void
    {
        $reserveData = [
            'idUser' => $this->idUser,
            'ISBN' => $this->isbn,
            'reserve_date' => $this->reserveDate->format('Ymd'),
            'return_date' => $this->returnDate->format('Ymd')
        ];

        $this->qb->insert($reserveData)->exec();
    }

    public function getPenalty()
    {
        $moneyPenalty = 0.50;

        $diffDays = $this->returnDate->diff($this->actualDate)->format("%r%a");
        if ($diffDays > 0) {
            return $diffDays * $moneyPenalty;
        } else {
            return 0;
        };
    }

    public  function renderReserveTable()
    {
        $penaltyClass = $this->getPenalty() ? 'reserve_penalty' : '';
        $titleimg = str_replace(' ', '', $this->book->getTitle());
        $srcImg = "\public\img\bookcovers\\{$titleimg}.jpg";
        $html = ' 
            <tr class="' . $penaltyClass . '">
                <td> <img class="bookcover_reserves" src="' . $srcImg . '"></td>
                <td>' . $this->book->getISBN() . '</td>
                <td>' . $this->book->getTitle() . '</td>
                <td>' . $this->book->getAuthor() . '</td>
                <td>' .
            $this->book->getEdition() . '</td>
                <td>' . $this->returnDate->format('d-m-Y') . '</td><td>';
        if ($this->getPenalty()) $html .=
            '<div class ="reserves_penalty_td"><i class="material-icons">warning</i>' .  $this->getPenalty() . '€</div>';
        $html .= '</td></tr>';

        return $html;
    }

    public  function renderReserveTableAdmin()
    {
        $penaltyClass = $this->getPenalty() ? 'reserve_penalty' : '';

        $titleimg = str_replace(' ', '', $this->book->getTitle());
        $srcImg = "\public\img\bookcovers\\{$titleimg}.jpg";
        $html = ' 
            <tr class="' . $penaltyClass . '">
                <td>' . $this->user->getUsername() . ' (' . $this->user->getUserId() . ')</td>
                <td> <img class="bookcover_reserves" src="' . $srcImg . '"></td>
                <td>' . $this->book->getISBN() . '</td>
                <td>' . $this->reserveDate->format('d-m-Y')  . '</td>
                <td>' . $this->returnDate->format('d-m-Y') . '</td><td>';
        if ($this->getPenalty()) {
            $html .=
                '<div class ="reserves_penalty_td"><i class="material-icons">warning</i>' .  $this->getPenalty() . '€</div>';
        }
        $html .= '</td><td><div class="admin_reserves_functions">
        <a href="/dashboard/removeReserve/' . $this->isbn . '""><i class="material-icons">delete</i></a>
        <a href="/dashboard/editReserveForm/' . $this->isbn . '""><i class="material-icons">edit</i></a>
        </div></td></tr>';

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
