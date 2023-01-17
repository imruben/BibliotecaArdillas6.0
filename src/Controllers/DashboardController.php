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
            return view('dashboard', ['user' => $this->userActual, 'users' => $this->users, 'books' => $books]);
            // 2==trabajador
        } else if ($rolUser == 2) {
            return view('dashboardWorker', ['user' => $this->userActual, 'books' => $books]);
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
        $reservesData = $this->qb->select(['*'])->from('prestecs')->exec()->fetch();

        if (!$reservesData) return view('reservesAdmin', ['user' => $this->userActual, 'reserves' => []]);

        foreach ($reservesData as $r) {
            $bookReserved = new LLibre($this->qb->select(['*'])->from('llibres')->where(['isbn' => $r['ISBN']])->limit(1)->exec()->fetch()[0]);

            $userReserve = new Usuari($this->qb->select(['*'])->from('usuaris')->where(['idUser' => $r['idUser']])->limit(1)->exec()->fetch()[0]);

            $reserves[] = new Prestec($userReserve, $bookReserved, new DateTime($r['reserve_date']), new DateTime($r['return_date']));
        }
        return view('reservesAdmin', ['user' => $this->userActual, 'reserves' => $reserves]);
    }

    function reservesWorker()
    {
        $reservesData = $this->qb->select(['*'])->from('prestecs')->exec()->fetch();

        if (!$reservesData) return view('reservesWorker', ['user' => $this->userActual, 'reserves' => []]);

        foreach ($reservesData as $r) {
            $bookReserved = new LLibre($this->qb->select(['*'])->from('llibres')->where(['isbn' => $r['ISBN']])->limit(1)->exec()->fetch()[0]);

            $userReserve = new Usuari($this->qb->select(['*'])->from('usuaris')->where(['idUser' => $r['idUser']])->limit(1)->exec()->fetch()[0]);

            $reserves[] = new Prestec($userReserve, $bookReserved, new DateTime($r['reserve_date']), new DateTime($r['return_date']));
        }
        return view('reservesWorker', ['user' => $this->userActual, 'reserves' => $reserves]);
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

    function usersWorker()
    {
        return view('usersWorker', ['users' => $this->users]);
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
        $userPasswordHashed =  $userData[0]['password'];

        $dataPosts = $this->request->postAll($posts);
        $dataPosts['password'] = password_hash($dataPosts['password'], PASSWORD_BCRYPT, ['cost' => 4]);

        if (password_verify($dataPosts['oldpassword'], $userPasswordHashed)) {
            unset($dataPosts['oldpassword']);
            $res = $this->qb->updateWhere('usuaris', $dataPosts, 'idUser', $userid);
            if ($res) $this->redirect('/dashboard');
        } else {
            $this->redirect('/dashboard/editUserForm/' . $userid);
        }
    }

    function removeUser()
    {
        $userid = $this->request->getParams();
        $this->qb->removeRow('usuaris', 'idUser', $userid);
        $this->qb->removeRow('prestecs', 'idUser', $userid);
        $this->redirect('/dashboard/usersAdmin');
    }

    function removeBook()
    {
        $isbn = $this->request->getParams();
        $this->qb->removeRow('llibres', 'ISBN', $isbn);
        $this->redirect('/dashboard');
    }

    function editReserveForm()
    {
        $isbn = $this->request->getParams();
        $reserveData = $this->qb->select(['*'])->from('prestecs')->where(['ISBN' => $isbn])->exec()->fetch()[0];

        $book = new Llibre($this->qb->select(['*'])->from('llibres')->where(['ISBN' => $isbn])->exec()->fetch()[0]);
        $userActual = new Usuari($this->qb->select(['*'])->from('usuaris')->where(['idUser' => $reserveData['idUser']])->exec()->fetch()[0]);

        $reserve = new Prestec($userActual, $book, new DateTime($reserveData['reserve_date']), new DateTime($reserveData['return_date']));

        return view('editReserve', ['reserve' => $reserve]);
    }

    function editReserve()
    {
        $isbn = $this->request->getParams();
        $posts = ['idUser', 'reserve_date', 'return_date'];
        $dataPosts = $this->request->postAll($posts);

        if ($this->request->post('setavailable')) {
            $book = new Llibre($this->qb->select(['*'])->from('llibres')->where(['ISBN' => $isbn])->exec()->fetch()[0]);
            $book->setAvailable();
        }

        $res = $this->qb->updateWhere('prestecs', $dataPosts, 'ISBN', $isbn);

        if ($res) $this->redirect('/dashboard/reservesAdmin');
    }

    function removeReserve()
    {
        $isbn = $this->request->getParams();
        $book = new Llibre($this->qb->select(['*'])->from('llibres')->where(['ISBN' => $isbn])->exec()->fetch()[0]);
        $book->setAvailable();
        $this->qb->removeRow('prestecs', 'ISBN', $isbn);
        $this->redirect('/dashboard/reservesAdmin');
    }


    function prestecs()
    {
        echo "prestecs";
    }
}
