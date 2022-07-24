<?php

namespace Sistema\Models\helper;


class ModValidaCampo
{
    
    private $data;
    private bool $result;

    function getResult(){
        return $this->result;
    }

    public function validaCampo($data)
    {
        $this->data = $data;
        //vai verificar se o usuario nao vai enviar tag, se tiver é pra tirar elas
        $this->data = array_map('strip_tags', $this->data);
        //retirar espaço em branco no inicio e no final
        $this->data = array_map('trim', $this->data);

        //verificar se algum campo está vazio, caso nao tenha nenhum vazio recebe o true e pode continuar
        if(in_array('', $this->data)){
            $_SESSION['msg'] = "<p style = 'color: #f00'>Erro: Necessario preencher todos os campos</p>";
            $this->result = false;
        }else {
            $this->result = true;
        }


    }
        
    
    

}