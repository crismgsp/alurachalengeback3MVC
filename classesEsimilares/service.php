<?php

    

    class Imprime 
    {

        private $mysql;

        public function __construct(mysqli $mysql)
        {
            $this->mysql = $mysql;
        }
        

        public function imprimir (): array 
        {
            
            $resultado = $this->mysql->query('SELECT DISTINCT DataHoraImportacao, DataeHora FROM transacoes GROUP BY DataHoraImportacao');
                
            $imprimir = $resultado->fetch_all(MYSQLI_ASSOC);

                    
            return $imprimir;
        }

       

        

        /*public function imprimir (): array 
        {
            
            $resultado = $this->mysql->query('SELECT DISTINCT DataHoraImportacao FROM transacoes'); 
            
            $imprimir = $resultado->fetch_all(MYSQLI_ASSOC);
                
    
            return $imprimir;
        } */

        public function imprimirdata () : array
        {
            
            $resultadodata = $this->mysql->query('SELECT  DISTINCT SUBSTRING(DataeHora, 1, 10) AS Initial FROM transacoes');
            $imprimirdata = $resultadodata->fetch_all(MYSQLI_ASSOC);
            
            
            return $imprimirdata; 
        }  

        public function dadoscompletos () : array
        {
            $url = str_replace("Novo/", "", $_SERVER["REQUEST_URI"]);
            $explodeurl = explode("=", $url);
            $DataImportacaoalt = $explodeurl[1];
            
            $DataImportacao = str_replace("%20", " ", $DataImportacaoalt);
            
            

            $resultadodados = $this->mysql->query("SELECT * FROM transacoes WHERE DataHoraImportacao = '$DataImportacao'");
            $imprimirdados = $resultadodados->fetch_all(MYSQLI_ASSOC);
        
            return $imprimirdados;

        }
            
    }

?>
   