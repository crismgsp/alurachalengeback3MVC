<?php

namespace Sistema\Models;

/**
 * classe responsavel por receber os dados das importacoes completas, e é instanciada na controller para mostrar na view
 * importações feitas */

class ModImportacoesDetalhadas
{
    /** @var $result recebe true quando executar o processo com sucesso */
    private $result;

   
    private $parseString = null;

    private $resultBd;
    
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

   

    public function listImportacoes(): void
    {
        
        $this->parseString = "";
        $url = str_replace("Novo/", "", $_SERVER["REQUEST_URI"]);
        $explodeurl = explode("index/", $url);
        $DataImportacaoalt = $explodeurl[1];
            
        $DataImportacao = str_replace("%20", " ", $DataImportacaoalt);

        //var_dump($DataImportacao);
        //exit();
            
          
        //instancia o helper generico para obter os dados do banco de dados, ele quer ordernar de forma decrescente pra aparecer os ultimos inseridos primeiro
        $listImport= new \Sistema\Models\helper\ModRead();
        //$listDataTransacao->fullRead("SELECT DISTINCT SUBSTRING(DataeHora, 1, 10) AS Initial FROM transacoes", $this->parseString);
        $listImport->fullRead("SELECT * FROM transacoes WHERE DataHoraImportacao = '$DataImportacao'", $this->parseString);
        

        $this->resultBd = $listImport->getResult();

        
        if($this->resultBd){
            
            $this->result = true;
        }else{
            
            $this->result = false;
        }
    }


}