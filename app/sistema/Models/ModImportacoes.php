<?php

namespace Sistema\Models;

class ModImportacoes
{
   

    private $result;
    private $resultBd;
    private $dados;

    function getResult()
    {
        return $this->result;
    }

    /** retorna os detalhes do registro */
    function getResultBd()
    {
        return $this->resultBd;
    }

    public function readCsv()

    {
        $arquivo = $_FILES["file"]["tmp_name"];
        $nome = $_FILES["file"]["name"];

        $this->arquivo = $arquivo;
    
        $ext = explode(".", $nome);
    
        $extensao = end($ext);

        /*separando a primeira linha pra comparar data com o banco de dados */

        $objeto = fopen($this->arquivo, 'r');
         
        $header = fgetcsv($objeto, 1000, ",");
    
        $primeiralinha = $header;
        
        
        $primeiralinhadata = $primeiralinha[7];
        $dataehorap = explode("T", $primeiralinhadata);
        $datap = $dataehorap[0];

        $this->datap = $datap;

        if($extensao != "csv") {
            $_SESSION['msg'] = "<p style= 'color: red;'>Extensão inválida</p>"; 
        }else{
            $this->result = true;
            $this-> checaDataBd();
        }    

    }

    public function checaDataBd()
    {
        $parseString = "";
        /*puxando dados de dataehora do banco de dados pra isolar so a data e comparar com a do arquivo */
        $buscaData = new \Sistema\Models\helper\ModRead();
        $buscaData->fullRead("SELECT DataeHora FROM transacoes GROUP BY DataeHora", $parseString);

        $this->resultBd = $buscaData->getResult();
 

        if($this->resultBd){
            
            //$DataeHora = mysqli_fetch_all($this->resultBd);
            $DataeHora = $this->resultBd;
            $this->DataeHora = $DataeHora;
            
          
            $datasbanco = array();
                
            foreach ($this->DataeHora as $datahorabanco) {
                $linhabanco = $datahorabanco;
               
                $stringlinha = implode("", $linhabanco);
                       
                $databanco = substr($stringlinha, 0, 10);
                array_push($datasbanco, $databanco);
            }    
            
            if (in_array($this->datap, $datasbanco)) {
                $_SESSION['msg'] = "<p style= 'color: red;'>Já tem esta data no banco</p>";    
            } else {
                $this->result = true;
                $this->importaCsv();
            }
        }

    }    
        
        
    function importaCsv()
    {

        $objeto = fopen($this->arquivo, 'r');   

            while(($dados = fgetcsv($objeto, 1000, ",")) !== FALSE)
            {
                  
                //$this->dados = $dados;   comentei este pois estava aparecendo 19 colunas em vez de 11
                            
                $this->dados['BancoOrigem'] = utf8_encode($dados[0]);
                $this->dados['AgenciaOrigem'] = utf8_encode($dados[1]);
                $this->dados['ContaOrigem'] = utf8_encode($dados[2]);
                $this->dados['BancoDestino'] = utf8_encode($dados[3]);
                $this->dados['AgenciaDestino'] = utf8_encode($dados[4]);
                $this->dados['ContaDestino'] = utf8_encode($dados[5]);
                $this->dados['Valor'] = utf8_encode($dados[6]);
                $this->dados['DataeHora'] = utf8_encode($dados[7]);
                $this->dados["DataHoraImportacao"] = date("Y-m-d H:i:s");

                $usuario = $_SESSION['user_name'];
                    
                $mes = substr($this->dados['DataeHora'], 6, 2);

                $this->dados['Usuario'] = $usuario;

                $this->dados['Mes'] = $mes;
              
                  
                $inserirTabela = new \Sistema\Models\helper\ModInsert();
                $inserirTabela->exeCreate("transacoes", $this->dados);

                if($inserirTabela->getResult()){
                    $_SESSION['msg'] = "<p style= 'color: green;'>Arquivo importado com sucesso.</p>";
                    $this->result = true;

                }else {
                    $_SESSION['msg'] = "<p style= 'color: red;'>Arquivo não importado.</p>";
                    $this->result = false;

                }
                
            } 
        }       


}       
