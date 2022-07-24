<?php

namespace Core;


class ConfigView
{
  
    private string $nameView;
    private $data;
     

    public function __construct(string $nameView, $data)
    {
       
       $this->nameView = $nameView;
       $this->data = $data;
        
    }

   
    public function loadViewLogin(): void
    {
        if(file_exists('app/' .$this->nameView . '.php')) {
            include 'app/sistema/Views/include/head.php';
            include 'app/' .$this->nameView . '.php';
            include 'app/sistema/Views/include/footer.php';
        }else{
            
            die("Erro: Por favor tente novamente, caso o erro persista, entre em contato com o administrador
            " . EMAILADM);
        }
    }

  
    public function loadView(): void
    {
        if(file_exists('app/' .$this->nameView . '.php')) {
            include 'app/sistema/Views/include/head.php';
            include 'app/sistema/Views/include/menu.php';
            include 'app/' .$this->nameView . '.php';
            include 'app/sistema/Views/include/footer.php';
        }else{
            
            die("Erro 002: Por favor tente novamente, caso o erro persista, entre em contato com o administrador
            " . EMAILADM);
        }
    }


}