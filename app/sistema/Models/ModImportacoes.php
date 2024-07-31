<?php

namespace Sistema\Models;

use DateTime;

class ModImportacoes
{
   

    private $result;
    private $resultBd;
    private $dados;
    private $arquivo;
    private $datap;
    private $DataeHora;

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

        if($extensao != "csv") {
        

            $_SESSION['msg'] = "<p style= 'color: red; margin-left: 10vw;'>Extensão inválida</p>"; 
        }else{
                /*separando a primeira linha pra comparar data com o banco de dados */

            $objeto = fopen($this->arquivo, 'r');
            
            $header = fgetcsv($objeto, 1000, ",");
        
            $primeiralinha = $header;
            
            
            $primeiralinhadata = $primeiralinha[7];
            $dataehorap = explode("T", $primeiralinhadata);
            $datap = $dataehorap[0];

            $this->datap = $datap;
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

            //var_dump($this->DataeHora);
            //echo "datap";
            //var_dump($this->datap);
            //exit();
            
            if (in_array($this->datap, $datasbanco)) {
                $_SESSION['msg'] = "<p style= 'color: red; margin-left: 10vw;'>Já tem esta data no banco</p>";    
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
                         
                //$this->dados['BancoOrigem'] = utf8_encode($dados[0]); //funcao depreciada..substituir esta linha e todas abaixo por outra...
                $this->dados['BancoOrigem'] = mb_convert_encoding($dados[0], "UTF-8", "ISO-8859-1");
                $this->dados['AgenciaOrigem'] = intval(mb_convert_encoding($dados[1], "UTF-8", "ISO-8859-1"));
                $this->dados['ContaOrigem'] = intval(mb_convert_encoding($dados[2], "UTF-8", "ISO-8859-1"));
                $this->dados['BancoDestino'] = mb_convert_encoding($dados[3], "UTF-8", "ISO-8859-1");
                $this->dados['AgenciaDestino'] = intval(mb_convert_encoding($dados[4], "UTF-8", "ISO-8859-1"));
                $this->dados['ContaDestino'] = intval(mb_convert_encoding($dados[5], "UTF-8", "ISO-8859-1"));
                $this->dados['Valor'] =  intval(mb_convert_encoding($dados[6], "UTF-8", "ISO-8859-1"));
                $this->dados['DataeHora'] = mb_convert_encoding($dados[7], "UTF-8", "ISO-8859-1");
                $this->dados["DataHoraImportacao"] = date("Y-m-d H:i:s");
              
               
                $usuario = $_SESSION['user_name'];
                    
                $mes = substr($this->dados['DataeHora'], 5, 2);
				
				//vou acrescentar este pedaço abaixo para fazer um teste:
				$ano = substr($this->dados['DataeHora'], 0, 4);
				
				$mesAno = "$mes$ano";
				
				//var_dump($mesAno);
				//exit();
                

                $this->dados['Usuario'] = $usuario;

                //$this->dados['Mes'] = intval($mes);
				
				$this->dados['Mes'] = intval($mesAno);

                                
                $inserirTabela = new \Sistema\Models\helper\ModInsert();
                $inserirTabela->exeCreate("transacoes", $this->dados);

                //var_dump($inserirTabela->getResult());
                //exit();

                if($inserirTabela->getResult() != NULL){
                    $_SESSION['msg'] = "<p style= 'color: green; margin-left: 10vw;'>Arquivo importado com sucesso.</p>";
                    $this->result = true;

                }else {
                    $_SESSION['msg'] = "<p style= 'color: red; margin-left: 10vw;'>Arquivo não importado.</p>";
                    $this->result = false;

                }
                
            } 
        }       


}       
