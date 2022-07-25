<?php

namespace Sistema\Models\helper;


class ModValidaEmail
{
    
    private string $email;
    
    private bool $result;

    private $edit;
    private $id;

    private $resultBd;

    function getResult(): bool
    {
        return $this->result;
    }

    public function validaEmail(string $email): void
    {
        $this->email = $email;
        if(filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            //se email for valido vai retornar true
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p style='color:#f00;'>Erro: E-mail inválido</p>";
            $this->result = false;
        }
    }

    public function validaEmailUnico(string $email , $edit, $id): void
    {
       
        $this->email = $email;
        $this->edit = $edit;
        $this->id = $id;

        
        $validaEmailUnico = new \Sistema\Models\helper\ModRead();
        //quando for editar
        if(($this->edit == true) and (!empty($this->id))){
            
            $validaEmailUnico->fullRead("SELECT id FROM usuarios WHERE (Email =:email) AND id <>:id LIMIT :limit", 
            "email={$this->email}&id={$this->id}&limit=1");

        }else{
            //instancia o metodo que busca no banco de dados um id quando o email la for = ao email digitado 
            //agora ao tentar inserir um novo cadastro
            $validaEmailUnico->fullRead("SELECT id FROM usuarios WHERE Email =:email LIMIT :limit", 
            "email={$this->email}&limit=1");
        }    

        $this->resultBd = $validaEmailUnico->getResult();
        //se nao encontrou nenhum usuario com este email, se resultBd nao tiver resultado retorna true
        if(!$this->resultBd){
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p style='color:#f00;'>Erro: Este email já está cadastrado</p>";
            $this->result = false;
        }

        
    }
    

}