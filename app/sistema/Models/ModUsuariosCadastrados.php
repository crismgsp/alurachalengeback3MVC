<?php

namespace Sistema\Models;

/**
 * classe responsavel por receber dados dos usuarios cadastrados no banco de dados, é instanciada no controller ListUsers para que 
 * ele mostre estes usuários
 */
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
        //instancia o helper generico para obter os dados do banco de dados, ele quer ordernar de forma decrescente pra aparecer os ultimos inseridos primeiro
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
