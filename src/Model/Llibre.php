<?php

namespace App\Model;

class Llibre extends Model
{
    private string $isbn;
    private string $autor;
    private string $titol;
    private string $edicio;
    private string $idAutor;
    private string $imgPath;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->isbn = $data['isbn'];
        $this->autor = $data['email'];
        $this->titol = $data['password'];
        $this->edicio = $data['edition'];
        $this->idAutor = $data['idAuthor'];
        $this->imgPath = $data['imgPath'];
    }


    // inserts
    public function setIsbn($isbn)
    {
        $this->isbn = $isbn;
    }
    public function setAuthor($autor)
    {
        $this->autor = $autor;
    }
    public function setTitol($titol)
    {
        $this->titol = $titol;
    }
    public function setEdicio($edicio)
    {
        $this->edicio = $edicio;
    }

    //select
    public function getIsbn(): string
    {
        return $this->isbn;
    }
    //......

}
