<?php

namespace app\sistema\Controllers;


class Login
{
   
    private $data;
    
    private array $dataform;
   
    
    public function index(): void
    {
        
        $data = [];

        $this->data = $data;

        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

                
        //se o usuario clicou no botao de acessar executa o que ta dentro deste if
        if(!empty($this->dataForm['SendLogin'])) {
            
            $valLogin = new \Sistema\Models\ModLogin();
            
            $valLogin->login($this->dataForm);

                      
            if($valLogin->getResult()){

                echo "fez login";
                $urlRedirect = URLSISTEMA. "importacoes/index";
                
                header("Location: $urlRedirect");
            }else {
                $this->data['form'] = $this->dataForm;
            }
           
        }

        $loadView = new \Core\ConfigView("sistema/Views/login", $this->data);
        $loadView->loadViewLogin();
    }
}