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
        //primer obtenir dades
        $titol = "Biblioteca de ardillas";
        return view('home', ['titol' => $titol]);
        //render vista home
    }
}
