<?php

    require '../config.php';

        /*lendo arquivo csv e verificando a extensao, la embaixo vai fazer um if com isto */
        $arquivo = $_FILES["file"]["tmp_name"];
        $nome = $_FILES["file"]["name"];
    
        $ext = explode(".", $nome);
    
        $extensao = end($ext);

        /*separando a primeira linha pra comparar data com o banco de dados */

        $objeto = fopen($arquivo, 'r');
         
        $header = fgetcsv($objeto, 1000, ",");
    
        $primeiralinha = $header;
        
        
        $primeiralinhadata = $primeiralinha[7];
        $dataehorap = explode("T", $primeiralinhadata);
        $datap = $dataehorap[0];
            

        /*puxando dados de dataehora do banco de dados pra isolar so a data e comparar com a do arquivo */
            
            
            
        $mysql = new mysqli('localhost', 'root', '','csv');
        $mysql-> set_charset('utf8');

        $query = ( "SELECT DataeHora FROM transacoes GROUP BY DataeHora");
                
                
        $result = mysqli_query($mysql, $query);
        
                      
                
        if (!$result) {
            $message  = 'Invalid query: ' . mysql_error() . "\n";
            $message .= 'Whole query: ' . $query;
            die($message);
        }
                
        $DataeHora = mysqli_fetch_all($result);
            
          
        $datasbanco = array();
                
        foreach ($DataeHora as $datahorabanco) {
            $linhabanco = $datahorabanco;
               
            $stringlinha = implode("", $linhabanco);
                
        
            $databanco = substr($stringlinha, 0, 10);
            array_push($datasbanco, $databanco);
        } 
            
        /* retornando ao $extensao pra checar se o arquivo é csv */    
    
        if($extensao != "csv") {
            echo "Extensao invalida";
        }elseif (in_array($datap, $datasbanco)) {
            echo("Já tem esta data no banco");
       
        }else{
        
            $objeto = fopen($arquivo, 'r');   

                while(($dados = fgetcsv($objeto, 1000, ",")) !== FALSE)
                {
                    
                            
                    $BancoOrigem = utf8_encode($dados[0]);
                    $AgenciaOrigem = utf8_encode($dados[1]);
                    $ContaOrigem = utf8_encode($dados[2]);
                    $BancoDestino = utf8_encode($dados[3]);
                    $AgenciaDestino = utf8_encode($dados[4]);
                    $ContaDestino = utf8_encode($dados[5]);
                    $Valor = utf8_encode($dados[6]);
                    $DataeHora = utf8_encode($dados[7]);
                                
                    $url = str_replace("Novo/", "", $_SERVER["REQUEST_URI"]);


                    $explodeurl = explode("=", $url);

                                
                    $usuariomodificado = $explodeurl[1];
                                            
                    $usuariomodificado2 = str_replace("%27", " ", $usuariomodificado);

                    $usuario = str_replace("%20", " ", $usuariomodificado2);

                    $mes = substr($DataeHora, 6, 2);

                            
                    $result = $mysql->query("INSERT INTO transacoes (BancoOrigem, AgenciaOrigem, ContaOrigem, BancoDestino, AgenciaDestino, ContaDestino, Valor, DataeHora,
                    Usuario, Mes ) VALUES ('$BancoOrigem', '$AgenciaOrigem', '$ContaOrigem', '$BancoDestino', '$AgenciaDestino', '$ContaDestino',
                    '$Valor', '$DataeHora', '$usuario', '$mes')");
                }


                
                if ($result){
                    echo "Dados inseridos com sucesso !!!";
                    header('Location:../paginasadmin/importacoes.php');
                    exit();
                    
                }else {
                    echo "Ocorreu um erro ao inserir os dados";
                }
                 
        }

       
        
?>

       

        