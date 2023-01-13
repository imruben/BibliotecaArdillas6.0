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
    protected Usuari $user;

    function __construct(Request $request, Session $session)
    {
        parent::__construct($request, $session);
        // $user = new Usuari(Session::get('user'));
        // $this->user = $user;
    }

    public function index()
    {
        $userData = Session::get('user');
        $user = new Usuari($userData[0]);

        $rolUser = $user->getidRol();


        $books = $this->qb->select(['*'])->from('llibres')->exec()->fetch();

        $users = $this->qb->select(['*'])->from('usuaris')->exec()->fetch();


        //1==socio
        //2==trabajador
        //3==admin
        // if ($rolUser == 1) {
        //     return view('dashboard', ['username' => 'pablito', 'user' => $user, 'llibres' => $llibres]);
        // } else if ($rolUser == 2) {
        //     return view('dashboard', ['username' => 'pablito', 'user' => $user, 'llibres' => $llibres]);
        // } else if ($rolUser == 3) {
        //     return view('admin', ['username' => 'pablito', 'users' => $users]);
        // }
        // print_r($user);

        // primer obtenir dades

        // var_dump($llibres);
        // $llibres = new Llibre($data);
        // $cataleg = $llibres->find(['disponible' => true]);
        // $cataleg = $this->qb->select(['*'])->from('llibres')->exec()->fetch();
        // return view('dashboard', ['cataleg' => $cataleg, 'user' => $user]);  

        // if ($user) {
        //     return view('dashboard', ['username' => 'pablito', 'user' => $user, 'llibres' => $llibres]);
        // } else {
        //     $this->redirect('/home');
        // }
    }

    function bookings()
    {
        return view('bookings', ['username' => 'pablito']);
    }

    function admin()
    {
        return view('admin', ['username' => 'pablito']);
    }


    function reserva()
    {
        $id = $this->request->getParams();
        $llibre = (new Llibre())->find(['id' => $id])[0];

        return view('reserva', [
            'llibre' => $llibre,
            'user' => $this->user
        ]);
    }

    function prestec()
    {
        $userData = Session::get('user');


        $user = new Usuari($userData);

        $isbn = $this->request->post('isbn');
        print $isbn;

        $bookData = $this->qb->select(['*'])->from('llibres')
            ->where(['isbn' => $isbn])->limit(1)->exec()->fetch();

        var_dump($bookData[0]);

        $book = new Llibre($bookData[0]);
        print $book->getIsbn();

        $booking = new Prestec($user, $book);




        // $dataBooking = [];




        // $booking = new Prestec($user, $book);

        // $this->qb->insert();

        // print $user->idUser;

        // $llibre = (new Llibre())->find(['id' => $id])[0];
        //crear prèstec
        // $id = $this->request->getParams();
        // 

        // $prestec = new Prestec($this->user, $llibre);
    }



    function prestecs()
    {
        echo "prestecs";
    }
}
