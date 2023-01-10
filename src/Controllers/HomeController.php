<?php

namespace App\Controllers;

use App\Controller;
use App\Request;
use App\Session;

final class HomeController extends Controller
{

    function __construct(Request $request, Session $session)
    {
        parent::__construct($request, $session);
    }

    public function index()
    {

        $user = Session::get('user');

        if ($user) {
            $this->redirect('/dashboard');
        } else {
            return view('home');
        }

        //primer obtenir dades
        // $titol = "Biblioteca de ardillas";
        // return view('home', ['titol' => $titol]);
        //render vista home
    }
}
