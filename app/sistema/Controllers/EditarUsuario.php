<?php

namespace app\sistema\Controllers;


class EditarUsuario
{
    
    private $data;
    
   
    private $dataForm;

    private $id;


    public function index($id): void
    {
        //recebe os dados digitados pelo usuario na edicao
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        //se o id for diferente de vazio e o botao para enviar os dados de edicao do usuario não foi clicado
        if((!empty($id)) and (empty($this->dataForm['SendEditUser']))){
            $this->id = (int) $id;
            $viewUser= new \Sistema\Models\ModEditarUsuario();
            $viewUser->viewUser($this->id);
            if($viewUser->getResult()){
                $this->data['form'] = $viewUser->getResultBd();
               
                $this->viewEditUser();
            }else{
                $urlRedirect = URLSISTEMA. "usuarios/index";
                header("Location: $urlRedirect");
                
            }  

        } else{
            
            $this->editUser();
        }
    }    


    private function viewEditUser(): void
    {
        $loadView = new \Core\ConfigView("sistema/Views/editarUsuario", $this->data);
        $loadView->loadView(); 
    }

    private function editUser(): void
    {
        //se o usuario clicou no botao daquele formulario acessa o if, caso contrario acesse o else
        if(!empty($this->dataForm['SendEditUser'])){
            unset($this->dataForm['SendEditUser']);
            //instancia a model responsavel por editar no banco de dados
            $editUser = new \Sistema\Models\ModEditarUsuario();
            $editUser->update($this->dataForm);
            if($editUser->getResult()){
                $urlRedirect = URLSISTEMA . "usuarios/index/" . $this->dataForm['id'];  
                header("Location: $urlRedirect");
            }else{
                //caso nao retorne true mantem os dados digitados no formulario e carrrega a view
                $this->data['form'] = $this->dataForm;
                $this->viewEditUser();
            }

        }else{
            $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Usuário não encontrado EditUsers linha 84</p>";
            $urlRedirect = URLSISTEMA . "editarUsuario/index";
            header("Location: $urlRedirect");
        } 
    }
        
        
}