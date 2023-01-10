<?php
define('APP', __DIR__);
//datos acceso a Base de datos
/*
return [
  'dbuser'=> $_ENV['DB_USER'],
  'dbpasswd'=> $_ENV['DB_PASSWD'],
  'dbname'=>$_ENV['DB_NAME'],
  'connection'=>$_ENV['DB_DRIVER'].':host='.$_ENV['DB_HOST'],
  'options'=>[\PDO::ATTR_ERRMODE=>\PDO::ERRMODE_WARNING]
];
*/

// creo que hay que guardar los datos aqui
// C:\Users\ruben\Desktop\BibliotecaArdillas\vendor\vlucas\phpdotenv\src\Dotenv.php


return [
  'dbuser' => 'root',
  'dbpassword' => '',
  'connection' => 'mysql:host=localhost',
  'dbname' => 'bibliotecaardillas',
  'options' => [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_WARNING]
];




// $dbhost = $_ENV['DB_HOST'];
// $dbname = $_ENV['DB_NAME'];
// $dbuser = $_ENV['DB_USER'];
// $dbpasswd = $_ENV['DB_PASSWD'];
// $dsn = 'mysql:host=' . $dbhost . ';dbname=' . $dbname . ';charset=utf8mb4';
