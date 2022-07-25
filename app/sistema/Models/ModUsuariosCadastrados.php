<?php

namespace Sistema\Models;


class ModUsuariosCadastrados
{
    
    private $result;

    
    private $resultBd;

    private $parseString = null;
    
    function getResult(): bool
    {
        return $this->result;
    }

    function getResultBd()
    {
        return $this->resultBd;
    }

    /**
     * listar os usuarios
     *
     * @return void
     */
    public function listarUsuarios(): void
    {
        
        $this->parseString = "";
        
        $listarUsuarios = new \Sistema\Models\helper\ModRead();
        $listarUsuarios->fullRead("SELECT id, Nome, Email, Statuss FROM usuarios", $this->parseString);

        $this->resultBd = $listarUsuarios->getResult();
        
        if($this->resultBd){
            
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Nenhum usuário encontrado!!!</p> nao é aqui que ta acessando  o erro..linha 49 ModUsuariosCadastrados";
            $this->result = false;
        }
    }
}
