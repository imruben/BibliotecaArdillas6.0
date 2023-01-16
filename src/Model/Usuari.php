<?php

namespace App\Model;

use App\Model\Model;
use App\Model\Prestec;

class Usuari extends Model
{
    protected string $idUser;
    protected string $username;
    protected string $email;
    protected string $password;
    protected int $phone;
    protected string $idRol;

    public function __construct(array $data)
    {
        parent::__construct($data);
        if (isset($data['idUser'])) {
            $this->idUser = $data['idUser'];
        } else {
            $this->idUser = '';
        }

        $this->username = $data['username'];
        $this->email = $data['email'];
        $this->password = $data['password'];
        $this->phone = $data['phone'];
        $this->idRol = $data['idRol'];
    }

    public function signupUser()
    {
    }

    //getters
    public function getUsername()
    {
        return $this->username;
    }
    public function getUserId()
    {
        return $this->idUser;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getPassword()
    {
        return $this->password;
    }

    public function getDecodedPassword()
    {

        return substr($this->password, 0, 7) . '...';
    }

    public function getPhone()
    {
        return $this->phone;
    }
    public function getidRol()
    {
        return $this->idRol;
    }

    public  function renderUsersTable()
    {
        // $srcImg = "\public\img\bookcovers\\{$this->book->getImgPath()}";
        $html = ' 
            <tr>
                <td>' . $this->getUserId() . '</td>
                <td>' . $this->getUsername() . '</td>
                <td>' . $this->getEmail() . '</td>
                <td>' .
            $this->getPhone() .
            '</td>
                <td>' . $this->getDecodedPassword() . '</td>
                <td>
                <a href="/dashboard/removeUser/' . $this->getUserId() . '""><i class="material-icons">delete</i></a>
        <a href="/dashboard/editUserForm/' . $this->getUserId() . '""><i class="material-icons">edit</i></a>
                </td>
            </tr>';

        return $html;
    }


    // public function prestecs()
    // {
    //     return $this->hasMany(Prestec::class);
    // }
}
