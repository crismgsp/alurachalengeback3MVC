<?php

namespace app\sistema\Controllers;


class Usuarios
{
      private $data;

   
    private $dataForm;

    
    public function index(): void
    {
       
        $data = [];

           
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

                      
        //se o usuario clicou no botao de cadastrar executa o que ta dentro deste if
        if(!empty($this->dataForm['Cadastrar'])) {
            unset($this->dataForm['Cadastrar']);    
            
            $criarUsuario = new \Sistema\Models\ModUsuarios();
            //instancia o metodo login que esta dentro da classe AdmsLogin, parametro dados recebidos do usuario
            $criarUsuario->criarUsuario($this->dataForm);
           
            if($criarUsuario->getResult()){
                $urlRedirect = URLSISTEMA . "usuarios/index";
                header("Location: $urlRedirect");
            }else {
                $this->data['form'] = $this->dataForm;
                $this->viewAddUser();
            }
        }else{
            $this->viewAddUser();
        }   
    }  

        
    private function viewAddUser(): void
    {
        $loadView = new \Core\ConfigView("sistema/Views/usuarios", $this->data);
        $loadView->loadView(); 
    }
        
        
}