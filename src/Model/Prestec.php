<?php

namespace App\Model;

use App\Model\Usuari;
use App\Model\Llibre;

class Prestec extends Model
{
    protected $llibres = [];
    protected Usuari $user;
    public function __construct(Usuari $user, Llibre $llibres)
    {
        parent::__construct();

        $this->user = $user;
        $this->llibres[] = $llibres;
    }
    public function active()
    {
    }
    public function user()
    {
        return $this->belongsTo(Usuari::class);
    }
}
