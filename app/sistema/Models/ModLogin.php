<?php

namespace Sistema\Models;


class ModLogin
{
    /**@var $dados recebe os dados enviados pelo usuario, quem deve enviar estes dados é a controller Login */
    private array $data;
    private $resultBd;
    private $result;

    function getResult(){
        return $this->result;
    }

    public function login(array $data)
    {
        
        $this->data = $data;

        

        $viewUser = new \Sistema\Models\helper\ModRead();
     
        $viewUser->fullRead("SELECT id, Nome,  Email, Senha, Statuss FROM usuarios WHERE Email
        =:email LIMIT :limit", "email={$this->data['email']}&limit=1");

        $this->resultBd = $viewUser->getResult();

        
        //se resultBd for true existe o usuario, entao precisa validar a senha
        if($this->resultBd){
            $this->valStatus();
            
        }else{
            $_SESSION['msg'] = "<p style='color: #f00'>Erro: Usuário ou senha incorreta</p>";
            $this-> result = false;
        }
    }    

    
    //vai validar se o email tem permissao de acessar o login, de acordo com o status, so deve acessar com status = 1
    private function valStatus():void
    {
        if($this->resultBd[0]['Statuss'] == 1){
            //se for igual a 1 o usuario esta habilitado a acessar o  login entao vai checar a senha agora
            $this->valSenha();
        }else {
            //se tiver com status 2 é inativo
            $_SESSION['msg'] = "<p style='color: #f00'>Erro: Usuário com status inativo</a></p>";
            $this-> result = false;
        }

    }
        
    private function valSenha()
    {
        //var_dump($this->resultBd[0]);
       // exit();

        //var_dump((password_verify($this->data['password'], $this->resultBd[0]['Senha'])));
        //exit();
       

        if(password_verify($this->data['Senha'], $this->resultBd[0]['Senha'])) {
                       

            $_SESSION['user_id'] = $this->resultBd[0]['id'];
            $_SESSION['user_email'] = $this->resultBd[0]['Email'];
            $_SESSION['user_name'] = $this->resultBd[0]['Nome'];

            $this->result = true;
            
        }else{
            

            $_SESSION['msg'] = "<p style='color: #f00'>Erro: Usuario ou senha incorreta</p>";
            $this-> result = false;
            
        }
    } 

}




