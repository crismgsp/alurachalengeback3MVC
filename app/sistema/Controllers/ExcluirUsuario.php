<?php

namespace app\sistema\Controllers;


class ExcluirUsuario
{
    
    private $data;
    
   
    private $dataForm;

    private $id;


    public function index($id): void
    {
        
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        //se o id for diferente de vazio e o botao para enviar os dados de edicao do usuario não foi clicado
        if((!empty($id)) and (!empty($this->dataForm['Exclusaologica']))){
            $this->id = (int) $id;
            $viewUser= new \Sistema\Models\ModExclusaoLogica();
            $viewUser->viewUser($this->id);
            if($viewUser->getResult()){
                $this->data['form'] = $viewUser->getResultBd();
               
                //$this->viewEditUser();
            }else{
                $urlRedirect = URLSISTEMA. "usuarios/index";
                header("Location: $urlRedirect");
                
            }  

        } //else{
            
            //$this->editUser();
        //}

        $loadView = new \Core\ConfigView("sistema/Views/excluirUsuario", $this->data);
        $loadView->loadView(); 
    }    


        
        
}