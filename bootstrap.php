<?php
//ESCOGE CONEXION BD: QueryBuilder.php o DB.php
require_once  __DIR__ . '/vendor/autoload.php';

use App\Container;
use App\Database\DB;
use App\Database\connection;
use App\Database\QueryBuilder;
use App\Session;



try {
    //acces a servei de configuració
    Container::bind('config', require 'config.php');

    //acceso a la base de datos
    Container::bind('query', new QueryBuilder(connection::make(Container::get('config'))));
} catch (\PDOException $e) {
    return view('Error', ['errorMsg' => $e->getMessage()]);
}
