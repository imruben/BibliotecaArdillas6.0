<?php

namespace App\Controllers;

use App\Controller;
use App\Request;
use App\Session;
use App\Container;
use App\Model\Model;
use App\Model\Usuari;


final class AuthController extends Controller
{
    // $this->qb es el constructor de consultes
    function __construct(Request $request, Session $session)
    {
        parent::__construct($request, $session);
    }

    public function index()
    {
        //mostrar form
        return view('home');
    }
    function signin($email = '', $passwd = '')
    {
        //capturar elements de POST
        $email = $this->request->post('email');
        $passwd = $this->request->post('password');

        // print($email);

        // print($passwd);
        //crida al metode privat d'autenticació
        $this->auth($email, $passwd);
        // $this->redirect('/dashboard');
    }

    private function auth(string $email, string $passwd)
    {
        //$password=password_hash($passwd,PASSWORD_BCRYPT,['cost'=>4]);
        $res = $this->qb->select(['*'])->from('usuaris')
            ->where(['email' => $email])->limit(1)->exec()->fetch();
        print('datos sql<br>');
        // var_dump($res);
        // print_r($res[0]);


        if ($res) {
            $user = $res[0];
            // die($user->password);

            //Contrasenya correcta
            if (password_verify($passwd, $user->password)) {
                Session::set('user', $user);
                print_r(Session::get('user'));
                // desar servei auth
                $this->redirect('/dashboard');
            }
            //Contrasenya incorrecta
        } else {
            $this->session->set('error', "Sessión fallida");
            $this->redirect('/dashboard');
        }
    }

    function signup()
    {
        $email = $this->request->post('email');
        $username = $this->request->post('username');
        $passwd = $this->request->post('password');
        $phone = $this->request->post('phone');
        $password = password_hash($passwd, PASSWORD_BCRYPT, ['cost' => 4]);
        $roles_id = '2';
        $data = [
            'email' => $email,
            'phone' => $phone,
            'username' => $username,
            'password' => $password,
            'idRol' => $roles_id,
        ];

        $user = new Usuari($data);
        // print $user->getUsername();

        // persist on DB
        print $user->persist($data);

        if ($user->persist($data)) {
            print_r('registrao');
            $this->redirect('/home');
        };
    }

    function logout()
    {
        $this->session->destroy();
        $this->redirect('/');
    }
}
