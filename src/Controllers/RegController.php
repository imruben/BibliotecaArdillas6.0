<?php

namespace App\Controllers;

use App\Controller;
use App\Request;
use App\Session;

final class RegController extends Controller
{

    function __construct(Request $request, Session $session)
    {
        parent::__construct($request, $session);
    }

    public function index()
    {
        //primer obtenir dades

        return view('reg');
        //render vista home
    }
}
