<?php

namespace Sistema\Models\helper;


class ModValidaSenha
{
    
    private string $Senha;
   
    private bool $result;

    function getResult(): bool
    {
        return $this->result;
    }

    
    public function validaSenha(string $Senha): void
    {
        $this->Senha = $Senha;
        //verifica se na senha tem o caratecere ' (aspas) , se tiver dá a msg de erro, caso não passa para a proxima verificacao
        if(stristr($this->Senha, "'")) {
            $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Caracter (') não pode ser utilizado na senha</p>";
            $this->result = false;
        }else{
            if(stristr($this->Senha, " ")) {
                $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Proibido utilizar espaço em branco na senha</p>";
                $this->result = false;
            }else{
                //caso nao tenha tido espaço ou aspas na senha vai verificar se a senha tem 6 ou mais caracteres
                $this->valTamanho();
               
            }
        }
    }   
    
   
    private function valTamanho(): void
    {
        if(strlen($this->Senha) < 6){
            $_SESSION['msg'] = "<p style='color: #f00;'>Erro: A senha deve ter no mínimo 6 caracteres</p>";
                $this->result = false;
        }else{
            $this->valConteudoSenha();
        }
    }
    
    
    private function valConteudoSenha(): void
    {
        if(preg_match('/^(?=.*[0-9])(?=.*[a-zA-Z])[a-zA-Z-0-9@#$%*]{6,}$/', $this->Senha)){
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p style='color: #f00;'>Erro: A senha deve ter letras e numeros</p>";
            $this->result = false;
        }
    }

}