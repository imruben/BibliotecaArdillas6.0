<?php

namespace App\Controllers;

use App\Controller;
use App\Container;
use App\Request;
use App\Session;
use App\Model;
use App\Model\Llibre;
use App\Model\Prestec;
use App\Model\Usuari;

final class DashboardController extends Controller
{
    protected Usuari $userActual;

    function __construct(Request $request, Session $session)
    {
        parent::__construct($request, $session);

        //Lee el user de la sesión
        $userData = Session::get('user');
        if (!$userData) $this->redirect('/home');
        $this->userActual = new Usuari($userData[0]);
    }


    public function index()
    {
        // Lee todos los libros
        $booksData = $this->qb->select(['*'])->from('llibres')->exec()->fetch();
        foreach ($booksData as $b) {
            $books[] = new Llibre($b);
        }

        // Lee todos los usuarios
        $usersData = $this->qb->select(['*'])->from('usuaris')->exec()->fetch();
        foreach ($usersData as $u) {
            $users[] = new Usuari($u);
        };

        //Redigire a diferente view dependiendo el rol del user
        $rolUser = $this->userActual->getidRol();
        // 1==socio
        if ($rolUser == 1) {
            return view('dashboard', ['user' => $this->userActual, 'books' => $books]);
            // 2==trabajador
        } else if ($rolUser == 2) {
            return view('dashboard', ['user' => $this->userActual, 'users' => $users, 'books' => $books]);
            // 3==admin
        } else if ($rolUser == 3) {
            return view('dashboardAdmin', ['user' => $this->userActual, 'books' => $books]);
        }
    }

    function reserveBook()
    {
        $actualDate = new \DateTime();
        $isbn = $this->request->getParams();

        $bookData = $this->qb->select(['*'])->from('llibres')->where(['isbn' => $isbn])->limit(1)->exec()->fetch();

        $bookReserved = new Llibre($bookData[0]);
        $bookReserved->setUnavailable();


        $reserve = new Prestec($this->userActual, $bookReserved, $actualDate);
        $reserve->saveReserve();
        $this->redirect('/dashboard');
    }

    function reserves()
    {
        $actualDate = new \DateTime();
        $userid = $this->userActual->getUserId();
        $reservesData = $this->qb->select(['*'])->from('prestecs')->where(['idUser' => $userid])->exec()->fetch();
        if (!$reservesData) return view('reserves', ['user' => $this->userActual, 'reserves' => []]);


        foreach ($reservesData as $r) {
            $bookReserved = new LLibre($this->qb->select(['*'])->from('llibres')->where(['isbn' => $r['ISBN']])->limit(1)->exec()->fetch()[0]);

            $reserves[] = new Prestec($this->userActual, $bookReserved, $actualDate);
        }

        return view('reserves', ['user' => $this->userActual, 'reserves' => $reserves]);
    }

    function reservesAdmin()
    {
    }

    function usersAdmin()
    {
        return view('admin', ['username' => 'pablito']);
    }

    function addBook()
    {
        $posts = ['ISBN', 'title', 'edition', 'author', 'imgPath', 'available'];

        if ($this->request->postAll($posts)) {
            $data = $this->request->postAll($posts);
            $book = new Llibre($data);
            $res = $book->persist();
            if ($res) $this->redirect('/dashboard');
            else {
                return view('addBook', ['errorMsg' => 'Ha habido un fallo añadiendo el libro en la bd']);
            }
        } else {
            return view('addBook');
        }
    }

    function editBookForm()
    {
        $isbn = $this->request->getParams();
        $bookData = $this->qb->select(['*'])->from('llibres')->where(['ISBN' => $isbn])->exec()->fetch();
        $book = new Llibre($bookData[0]);
        return view('editBook', ['book' => $book]);
    }


    function editBook()
    {
        $posts = ['ISBN', 'title', 'edition', 'author', 'imgPath', 'available'];
        $data = $this->request->postAll($posts);
        $res = $this->qb->updateWhere('llibres', $data, 'ISBN', $data['ISBN']);
        if ($res) $this->redirect('/dashboard');
    }

    function removeBook()
    {
        $isbn = $this->request->getParams();
        $this->qb->removeRow('llibres', 'ISBN', $isbn);
        $this->redirect('/dashboard');
    }


    function prestecs()
    {
        echo "prestecs";
    }
}
