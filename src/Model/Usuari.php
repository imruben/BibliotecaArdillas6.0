<?php

namespace App\Model;

use App\Model\Model;
use App\Model\Prestec;

class Usuari extends Model
{
    protected string $nom;
    protected string $email;
    protected string $password;

    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->nom = $data['username'];
        $this->email = $data['email'];
        $this->password = $data['password'];
    }

    public function signupUser()
    {
    }

    public function getUsername()
    {
        return $this->nom;
    }

    public function prestecs()
    {
        return $this->hasMany(Prestec::class);
    }

    public function getUsernameId()
    {
        return $this->email;
        // $res = $this->qb->select([''])->from('llibres')
        //     ->where(['isbn' => $isbn])->limit(1)->exec()->fetch();
    }
}
