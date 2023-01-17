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
use DateTime;

final class DashboardController extends Controller
{
    protected Usuari $userActual;
    protected array $users;

    function __construct(Request $request, Session $session)
    {
        parent::__construct($request, $session);

        //Lee el user de la sesión
        $userData = Session::get('user');
        if (!$userData) $this->redirect('/home');
        $this->userActual = new Usuari($userData[0]);

        //Lee todos los usuarios de la bd
        $usersData = $this->qb->select(['*'])->from('usuaris')->exec()->fetch();
        foreach ($usersData as $u) {
            $this->users[] = new Usuari($u);
        };
    }


    public function index()
    {
        // Lee todos los libros
        $booksData = $this->qb->select(['*'])->from('llibres')->exec()->fetch();
        foreach ($booksData as $b) {
            $books[] = new Llibre($b);
        }

        //Redigire a diferente view dependiendo el rol del user
        $rolUser = $this->userActual->getidRol();
        // 1==socio
        if ($rolUser == 1) {
            return view('dashboard', ['user' => $this->userActual, 'books' => $books]);
            // 2==trabajador
        } else if ($rolUser == 2) {
            return view('dashboard', ['user' => $this->userActual, 'users' => $this->users, 'books' => $books]);
            // 3==admin
        } else if ($rolUser == 3) {
            return view('dashboardAdmin', ['user' => $this->userActual, 'books' => $books]);
        }
    }

    function reserveBook()
    {
        $actualDate = new \DateTime();
        $returnDate = new \DateTime();
        $returnDate->modify('+30 days');
        $isbn = $this->request->getParams();

        $bookData = $this->qb->select(['*'])->from('llibres')->where(['isbn' => $isbn])->limit(1)->exec()->fetch();

        $bookReserved = new Llibre($bookData[0]);
        $bookReserved->setUnavailable();

        $reserve = new Prestec($this->userActual, $bookReserved, $actualDate, $returnDate);
        $reserve->saveReserve();
        $this->redirect('/dashboard');
    }

    function reserves()
    {
        $userid = $this->userActual->getUserId();
        $reservesData = $this->qb->select(['*'])->from('prestecs')->where(['idUser' => $userid])->exec()->fetch();
        if (!$reservesData) return view('reserves', ['user' => $this->userActual, 'reserves' => []]);

        foreach ($reservesData as $r) {
            $bookReserved = new LLibre($this->qb->select(['*'])->from('llibres')->where(['isbn' => $r['ISBN']])->limit(1)->exec()->fetch()[0]);

            $reserves[] = new Prestec($this->userActual, $bookReserved, new DateTime($r['reserve_date']), new DateTime($r['return_date']));
        }

        return view('reserves', ['user' => $this->userActual, 'reserves' => $reserves]);
    }

    function reservesAdmin()
    {
    }

    function addBook()
    {
        $posts = ['ISBN', 'title', 'edition', 'author', 'available'];

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
        $isbn = $this->request->getParams();
        $posts = ['title', 'edition', 'author',  'available'];
        $data = $this->request->postAll($posts);
        $res = $this->qb->updateWhere('llibres', $data, 'ISBN', $isbn);
        if ($res) $this->redirect('/dashboard');
    }

    function usersAdmin()
    {
        return view('usersAdmin', ['users' => $this->users]);
    }

    function editUserForm()
    {
        $userid = $this->request->getParams();
        $userData = $this->qb->select(['*'])->from('usuaris')->where(['idUser' => $userid])->exec()->fetch();
        $user = new Usuari($userData[0]);
        return view('editUser', ['user' => $user]);
    }


    function editUser()
    {
        $userid = $this->request->getParams();
        $posts = ['idUser', 'username', 'email', 'phone', 'oldpassword', 'password'];

        $userData = $this->qb->select(['password'])->from('usuaris')->where(['idUser' => $userid])->exec()->fetch();
        print $userData[0]['password'];

        var_dump($posts);

        // $data = $this->request->postAll($posts);
        // var_dump($data);



        // $res = $this->qb->updateWhere('usuaris', $data, 'idUser', $userid);
        // if ($res) $this->redirect('/dashboard');
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
