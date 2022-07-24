<?php

namespace Sistema\Models;

/**
 * classe responsavel por receber dados das datas de transacao e importacao, e é instanciada na controller para mostrar na view
 * importações feitas */

class ModImportacoesFeitas
{
    /** @var $result recebe true quando executar o processo com sucesso */
    private $result;

    /** @var $resultBd recebe dados do banco de dados*/
    private $resultBd1;

    /** @var $resultBd recebe dados do banco de dados*/
    private $resultBd2;

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

    /*public function listDataImport(): void
    {
        
        $this->parseString = "";
        //instancia o helper generico para obter os dados do banco de dados, ele quer ordernar de forma decrescente pra aparecer os ultimos inseridos primeiro
        $listDataImport = new \Sistema\Models\helper\ModRead();
        $listDataImport->fullRead("SELECT DISTINCT DataHoraImportacao FROM transacoes", $this->parseString);

        $this->resultBd = $listDataImport->getResult();
        
        if($this->resultBd){
            //var_dump($this->resultBd);
            $this->result = true;
        }else{
            
            $this->result = false;
        }
    } */

    public function listDatas(): void
    {
        
        $this->parseString = "";
        //instancia o helper generico para obter os dados do banco de dados, ele quer ordernar de forma decrescente pra aparecer os ultimos inseridos primeiro
        $listData= new \Sistema\Models\helper\ModRead();
        //$listDataTransacao->fullRead("SELECT DISTINCT SUBSTRING(DataeHora, 1, 10) AS Initial FROM transacoes", $this->parseString);
        $listData->fullRead("SELECT DISTINCT DataHoraImportacao, DataeHora FROM transacoes GROUP BY DataHoraImportacao", $this->parseString);

        /*$this->resultBd2 = $listDataTransacao->getResult();

        $listDataImport = new \Sistema\Models\helper\ModRead();
        $listDataImport->fullRead("SELECT DISTINCT DataHoraImportacao FROM transacoes", $this->parseString); */

        $this->resultBd = $listData->getResult();

        //$this->resultBd = array_merge($this->resultBd1, $this->resultBd2); 
   
       //var_dump($this->resultBd);
       //exit();
        
        if($this->resultBd){
            
            $this->result = true;
        }else{
            
            $this->result = false;
        }
    }


}