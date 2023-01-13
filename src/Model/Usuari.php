<?php

namespace App\Model;

use App\Model\Model;
use App\Model\Prestec;

class Usuari extends Model
{
    protected string $username;
    protected string $email;
    protected string $password;
    protected string $phone;
    protected string $idRol;

    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->username = $data['username'];
        $this->email = $data['email'];
        $this->password = $data['password'];
        $this->phone = $data['phone'];
        $this->idRol = $data['idRol'];
    }

    public function signupUser()
    {
    }

    public function getUsername()
    {
        return $this->username;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function getPhone()
    {
        return $this->phone;
    }
    public function getidRol()
    {
        return $this->idRol;
    }


    // public function prestecs()
    // {
    //     return $this->hasMany(Prestec::class);
    // }
}
