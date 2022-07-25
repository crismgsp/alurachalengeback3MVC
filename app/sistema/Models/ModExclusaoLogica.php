<?php

namespace Sistema\Models;


class ModExclusaoLogica
{
    /** @var $result recebe true quando executar o processo com sucesso */
    private bool $result = false;

    /** @var $resultBd recebe dados do banco de dados*/
    private array $resultBd;

    
    /** @var $id recebe id do usuario,  */
    private $id;

    private $dataSave;

    

    
    function getResult(): bool
    {
        return $this->result;
    }

    /** retorna os detalhes do registro */
    function getResultBd(): array
    {
        return $this->resultBd;
    }

   
    public function viewUser($id): void
    {
        $this->id = $id;
        
       
        $viewUser = new \Sistema\Models\helper\ModRead();
        $viewUser->fullRead("SELECT id, Nome, Email, Statuss FROM usuarios WHERE id=:id LIMIT :limit", "id={$this->id}&limit=1");

        $this->resultBd = $viewUser->getResult();
        
        if($this->resultBd){
                        
            
            $this->exclusaologica();

        }else{
            $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Usuário não encontrado! nao e aqui que ta acessando o erro.... linha 47 ModEditarUsuario</p>";
            $this->result = false;
        }
    }

      
    public function exclusaologica(): void
    {
        
        if($this->id === 1) {
            $_SESSION['msg'] = "<p style= 'color: #f00;'>o Usuario Admin não pode ser excluido</p>";
        } else{
                       
            //assim funcionou...coloquei so o que quis mudar na edicao dentro da variavel que sera passada como parametro para mudança
            $this->dataSave['Statuss'] = 2;
       
            $upUser = new \Sistema\Models\helper\ModAtualiza();
           // $upUser->exeUpdate("usuarios", $this->data, "WHERE id=:id", "id={$this->data['id']}");
            $upUser->exeUpdate("usuarios", $this->dataSave , "WHERE id=:id", "id={$this->id}");

            
            if($upUser->getResult()){
               
                $_SESSION['msg'] = "<p style= 'color: green;'>Usuario excluído com sucesso.</p>";
                $this->result = true;
            }else{
               
                $_SESSION['msg'] = "<p style= 'color: #f00;'>Erro: Usuário não excluído</p>";
                $this->result = false;
            }
    
        }
        
    }
}