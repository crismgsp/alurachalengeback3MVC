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
        
        $valEmail = new \Sistema\Models\helper\ModValidaEmail();
        $valEmail->validaEmail($this->data['Email']);

       
        $valEmailUnico = new \Sistema\Models\helper\ModValidaEmail();
        $valEmailUnico->validaEmailUnico($this->data['Email'], $edit, $id);

        $valSenha = new \Sistema\Models\helper\ModValidaSenha();
        $valSenha->validaSenha($this->data['Senha']);

        if($valEmail->getResult() and ($valEmailUnico->getResult()) and ($valSenha->getResult())){
            
            $this->adiciona();
        }else{
            $this->result = false;
        }

    }
    
  
    private function adiciona(): void

    {

        var_dump($this->data['Senha']);
        $this->data['Senha'] = password_hash($this->data['Senha'], PASSWORD_DEFAULT);

        var_dump($this->data['Senha']);
        exit();
        
        $criaUsuario = new \Sistema\Models\helper\ModInsert();
        $criaUsuario->exeCreate("usuarios", $this->data);

        
        if($criaUsuario->getResult()){
            $_SESSION['msg'] = "<p style= 'color: green;'>Usuario cadastrado com sucesso.</p>";
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p style= 'color: #f00;'>Erro: Usuário não cadastrado.</p>";
            $this->result = false;
        }
    }

    
}

