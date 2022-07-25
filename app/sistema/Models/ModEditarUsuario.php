<?php

namespace Sistema\Models;


class ModEditarUsuario
{
    /** @var $result recebe true quando executar o processo com sucesso */
    private bool $result = false;

    /** @var $resultBd recebe dados do banco de dados*/
    private array $resultBd;

    
    /** @var $id recebe id do usuario,  */
    private $id;

    /** @var $data recebe as informações do formulario que serão salvos (os dados que serão atualizados no banco de dados)  */
    private $data;
    
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
                       
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Usuário não encontrado! nao e aqui que ta acessando o erro.... linha 47 ModEditarUsuario</p>";
            $this->result = false;
        }
    }

    public function update($data): void
    {
        $this->data = $data;
       
        $validaCampo = new \Sistema\Models\helper\ModValidaCampo();
        $validaCampo->validaCampo($this->data);

        //se getResult retornar true significa que nao houve erro, entao pode cadastar no banco de dados
        if ($validaCampo->getResult()) {
            $this->valInput();
        } else{
            $this->result = false;     
        }
    }

    private function valInput(): void
    {
        //instancia a classe que valida o email e na outra linha instancia o metodo que ta dentro desta classe
        $valEmail = new \Sistema\Models\helper\ModValidaEmail();
        $valEmail->validaEmail($this->data['Email']);

        $valEmailUnico = new \Sistema\Models\helper\ModValidaEmail();
        //ele coloca true pra mostrar que é o editar (e nao o criar usuario), ver isso em AdmsValEmailSingle..e em anotacoes2 expliquei
        $valEmailUnico->validaEmailUnico($this->data['Email'], true, $this->data['id']);
        
        
        if(($valEmail->getResult()) and ($valEmailUnico->getResult()))
        {
            //se email for valido isntancia o metodo edit que edita os dados ao banco de dados
            $this->edit();
        }else{
            $this->result = false;
        }
    }

    private function edit(): void
    {
        
        //var_dump($this->data);
        //exit();

        if($this->data['id'] === '1') {
            $_SESSION['msg'] = "<p style= 'color: #f00;'>o Usuario Admin não pode ser editado</p>";
        } else{
            $upUser = new \Sistema\Models\helper\ModAtualiza();
            $upUser->exeUpdate("usuarios", $this->data, "WHERE id=:id", "id={$this->data['id']}");
            
            if($upUser->getResult()){
               
                $_SESSION['msg'] = "<p style= 'color: green;'>Usuario editado com sucesso.</p>";
                $this->result = true;
            }else{
               
                $_SESSION['msg'] = "<p style= 'color: #f00;'>Erro: Usuário não editado</p>";
                $this->result = false;
            }
    
        }
        
    }

    
}