<?php

namespace Core;


class CarregarPgAdm
{
     /*** @var string $urlController Recebe da URL o nome da controller   */
     private string $urlController;
     /*** @var string $urlMetodo Recebe da URL o nome do metodo   */
     private string $urlMetodo;
     /*** @var string $urlParameter Recebe da URL o parametro   */
     private string $urlParameter;
      /*** @var string $classLoad Controller que deve ser carregada   */
    private string $classLoad;
    /*** @var string $urlSlugController Recebe o controller tratado   */
    private string $urlSlugController;
    /*** @var string $urlSlugMetodo Recebe o metodo tratado   */
    private string $urlSlugMetodo;

    private array $listPgPublic;
    private array $listPgPrivate; 


     public function loadPage(string $urlController, string $urlMetodo, string $urlParameter)
     {
        $this->urlController = $urlController;
        $this->urlMetodo = $urlMetodo;
        $this->urlParameter = $urlParameter;
        
        $this->classLoad = "\\App\\sistema\\Controllers\\" . $this->urlController;

        $this->pgPublic();

               
        if(class_exists($this->classLoad)){
            $this->loadMetodo();

        }else{
           
            $this->urlController = $this->slugController(CONTROLLER);
            $this->urlMetodo = $this->slugMetodo(METODO);
            $this->urlParameter = "";
            
            $this->loadPage($this->urlController, $this->urlMetodo,$this->urlParameter);

        }
        
     }

     private function loadMetodo(): void
     {
        $classLoad = new $this->classLoad();
        if(method_exists($classLoad, $this->urlMetodo)){
            $classLoad->{$this->urlMetodo}($this->urlParameter);
        }else {
            die("Erro 004: Por favor tente novamente, caso o erro persista, entre em contato 
            com o administrador " . EMAILADM);
        }
     }

     private function pgPublic():void
     {
        
        $this->listPgPublic = ["Login"];
        //
        if(in_array($this->urlController, $this->listPgPublic)) {
            
            $this->classLoad= "\\App\\sistema\\Controllers\\" . $this->urlController;
        }else{
            
            $this->pgPrivate();
        }
     }

     //observacao: estes nomes das paginas publicas(acima) ou privadas(abaixo) sao os nomes dos controllers
     private function pgPrivate(): void
     {
        $this->listPgPrivate = ["Importacoes", "ImportacoesFeitas", "ImportacoesDetalhadas"];
        if(in_array($this->urlController, $this->listPgPrivate)){
            
            $this->verificaLogin();
        }else{
            //$_SESSION['msg'] = "<p style='color: red;'> Erro: página não encontrada, CarregarPGAdmin</p>"; 
            $urlRedirect = URLSISTEMA . "login/index";
            header("Location: $urlRedirect");
        }
     }

     private function verificaLogin(): void
     {
        
        if((isset($_SESSION['user_id'])) and (isset($_SESSION['user_name'])) and (isset($_SESSION['user_email']))) {
            $this->classLoad= "\\App\\sistema\\Controllers\\" . $this->urlController;
        }else {
        $_SESSION['msg'] = "<p style='color: orange;'> Erro: Para acessar a página realize o login </p>";
        $urlRedirect = URLSISTEMA . "login/index";
        header("Location: $urlRedirect");
        }
     }    

    
    private function slugController(string $slugController): string
    {
        $this->urlSlugController = $slugController;
       
        $this->urlSlugController = strtolower($this->urlSlugController);
        
        $this->urlSlugController = str_replace("-", " ", $this->urlSlugController);
        
        $this->urlSlugController = ucwords($this->urlSlugController);
       
        $this->urlSlugController = str_replace(" ", "", $this->urlSlugController);

        //var_dump($this->urlSlugController);
        return $this->urlSlugController;
    }

   
    private function slugMetodo(string $urlSlugMetodo): string
    {
        $this->urlSlugMetodo = $this->slugController($urlSlugMetodo);
     
        $this->urlSlugMetodo = lcfirst( $this->urlSlugMetodo);
       
        return $this->urlSlugMetodo;
    }
    
}