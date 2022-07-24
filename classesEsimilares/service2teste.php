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
            
                $resultado = $this->mysql->query('SELECT DISTINCT DataHoraImportacao FROM transacoes'); 
                
                $imprimir2 = $resultado->fetch_all(MYSQLI_ASSOC);

                $resultadodata = $this->mysql->query('SELECT  DISTINCT SUBSTRING(DataeHora, 1, 10) AS Initial FROM transacoes');
                $imprimirdata = $resultadodata->fetch_all(MYSQLI_ASSOC);

                $imprimir = array_merge($imprimir2, $imprimirdata);
   
        
                return $imprimir;
            }

        public function imprimirdata () : array
            {
                
                $resultadodata = $this->mysql->query('SELECT  DISTINCT SUBSTRING(DataeHora, 1, 10) AS Initial FROM transacoes');
                $imprimirdata = $resultadodata->fetch_all(MYSQLI_ASSOC);
                
                
                return $imprimirdata; 
            } 
            
    }        