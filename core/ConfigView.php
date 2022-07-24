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

    /**
     * Carregar a view login, verificar se o arquivo existe e carregar caso exista
     * Se nao existir para o carregamento e apresenta mensagem de erro
     *
     * @return void
     */
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

    /**
     * Carregar a view, verificar se o arquivo existe e carregar caso exista
     * Se nao existir para o carregamento e apresenta mensagem de erro, a unica diferença desta view para a loadviewlogin é que esta carrega o menu
     *
     * @return void
     */
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