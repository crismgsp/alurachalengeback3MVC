<?php

namespace Sistema\Models;

/**
 * classe responsavel por receber dados dos usuarios cadastrados no banco de dados, é instanciada no controller ListUsers para que 
 * ele mostre estes usuários
 */
class ModAnaliseTransacoes
{
    /** @var $result recebe true quando executar o processo com sucesso */
    private $result;

    /** @var $resultBd recebe dados do banco de dados*/
    private $resultBd;

    /** @var $resultBd recebe dados do banco de dados*/
    private $resultBd2;

    private $parseString = null;
    
    function getResult(): bool
    {
        return $this->result;
    }

    function getResultBd()
    {
        return $this->resultBd;
    }

    function getResultBd2()
    {
        return $this->resultBd2;
    }

    /**
     * listar os usuarios
     *
     * @return void
     */
    public function contasuspeita(): void
    {
        //o professor nao fez isso..to faendo pq tava dando erro...pedindo 2 argumentos em fullRead ai criei o parseString e coloquei vazio
        //se nao funcionar vou criar um fullReadSemParse
        $this->parseString = "";

        
        $mesescolhido = $_POST['selecao'];  

        //instancia o helper generico para obter os dados do banco de dados, ele quer ordernar de forma decrescente pra aparecer os ultimos inseridos primeiro
        $contassuspeitas = new \Sistema\Models\helper\ModRead();
        $contassuspeitas->fullRead("SELECT BancoOrigem as Banco, AgenciaOrigem as Agencia, ContaOrigem as Conta, Sum(Valor) as Soma FROM transacoes WHERE Mes = 
        '$mesescolhido' GROUP BY ContaOrigem, BancoOrigem, AgenciaOrigem", $this->parseString);

        $this->resultBd = $contassuspeitas->getResult();

        $contassuspeitas2 = new \Sistema\Models\helper\ModRead();
        $contassuspeitas2->fullRead("SELECT BancoDestino as Banco, AgenciaDestino as Agencia, ContaDestino as Conta, Sum(Valor) as Soma FROM transacoes WHERE Mes = '$mesescolhido' 
        GROUP BY ContaDestino, BancoDestino, AgenciaDestino", $this->parseString);

        $this->resultBd2 = $contassuspeitas2->getResult();

              
        if(($this->resultBd) and ($this->resultBd2)){
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Nenhum usuário encontrado!!!</p> nao é aqui que ta acessando  o erro..linha 49 admslistusers";
            $this->result = false;
        }
    }
}
