<?php

namespace Core;

abstract class Config
{

 
    protected function configAdmin(): void
    {
        define('URL', 'http://localhost/');
        define('URLSISTEMA', 'http://localhost/alurachalengeback3MVC/');

        define('CONTROLLER', 'Login');
        define('METODO', 'index');
        
        define('CONTROLLERERRO', 'Login');

        define('HOST', 'localhost');
        define('USER', 'root');
        define('PASS', '');
        define('DBNAME', 'csv');
        define('PORT', '3306');

        define('EMAILADM', 'crismgsp@gmail.com');
    }
}
