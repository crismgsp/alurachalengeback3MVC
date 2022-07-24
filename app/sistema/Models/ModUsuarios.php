<?php

namespace Sistema\Models;


class ModUsuarios
{
   
    private $data;
     
    private $result;
    
   
    function getResult(): bool
    {
        return $this->result;
    }

    public function criarUsuario($data)
    {
        
        $this->data = $data;
       
        $validaCampo = new \Sistema\Models\helper\ModValidaCampo();
        $validaCampo->validaCampo($this->data);

        
        if ($validaCampo->getResult()) {
            $this->validaEntradas();
        } else{
            $this->result = false;     
        }
    }  
    
   
    private function validaEntradas(): void
    {

        $edit = null;
        $id = null;
        //instancia a classe que valida o email e na outra linha instancia o metodo que ta dentro desta classe
        $valEmail = new \App\adms\Models\helper\AdmsValEmail();
        $valEmail->validateEmail($this->data['email']);

        //instancia a classe e metodo  que validam que ainda nao tem o email ser cadastrado no BD 
        $valEmailSingle = new \App\adms\Models\helper\AdmsValEmailSingle();
        $valEmailSingle->validateEmailSingle($this->data['email'], $edit, $id);

        $valPassword = new \App\adms\Models\helper\AdmsValPassword();
        $valPassword->validatePassword($this->data['password']);

        if($valEmail->getResult() and ($valEmailSingle->getResult()) and ($valPassword->getResult())){
            
            $this->add();
        }else{
            $this->result = false;
        }

    }
    
  
    private function add(): void
    {
        $this->data['Senha'] = password_hash($this->data['password'], PASSWORD_DEFAULT);
        
        $createUser = new \Sistema\Models\helper\ModInsert();
        $createUser->exeCreate("usuarios", $this->data);

        
        if($createUser->getResult()){
            $_SESSION['msg'] = "<p style= 'color: green;'>Usuario cadastrado com sucesso.</p>";
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p style= 'color: #f00;'>Erro: Usuário não cadastrado.</p>";
            $this->result = false;
        }
    }

    
}

