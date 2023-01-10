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
        $user = Session::get('user');
        // print_r($user);

        // primer obtenir dades
        $llibres = $this->qb->select(['*'])->from('llibres')->exec()->fetch();
        // var_dump($llibres);
        // $llibres = new Llibre($data);
        // $cataleg = $llibres->find(['disponible' => true]);
        // $cataleg = $this->qb->select(['*'])->from('llibres')->exec()->fetch();
        // return view('dashboard', ['cataleg' => $cataleg, 'user' => $user]);  

        if ($user) {
            return view('dashboard', ['username' => 'pablito', 'user' => $user, 'llibres' => $llibres]);
        } else {
            $this->redirect('/home');
        }
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
        $isbn = $this->request->post('isbn');
        print $isbn;

        $res = $this->qb->select(['*'])->from('llibres')
            ->where(['isbn' => $isbn])->limit(1)->exec()->fetch();
        var_dump($res);

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
