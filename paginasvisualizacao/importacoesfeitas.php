<?php

/*session_start();
include('../classesEsimilares/verificalogin.php');

include('../classesEsimilares/service.php');


require '../config.php';

$imprime = new Imprime($mysql);
$imprimir = $imprime->imprimir();



$_SESSION['time']     = time();

?>


<!DOCTYPE html>
<html lang="pt">
 
    <head>  
        
        
        <title>Visualizar importacoes</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../assets/css/style.css">
        <link rel="stylesheet" href="../assets/css/diversos.css">



    </head>

    <body> 

    <?php
                $url = str_replace("Novo/", "", $_SERVER["REQUEST_URI"]);
                $explodeurl = explode("=", $url);

                            
                $usuariomodificado = $explodeurl[1];
            
                $usuario = str_replace("%27", " ", $usuariomodificado);
            

                ?>


<header>  
    <?php */
    
 
             
    ?>                               
      
    
    <p><?php echo 'Bem vindo ' . $_SESSION['user-name'];?></p> <p><?php echo 'Hoje é '. date('d/m/Y ', $_SESSION['time']);?></p>

        <div id="informacoes">

            <div id="cabecalho">
                <h1> Importações realizadas</h1>

              
            </div>

            
                

                <div class="tabela1">

                    <table  id="tabela1">    
                        <thead id="titulo1">
                            <tr id="transacoes">
                                <th scope="col">Data Transações</th>
                                <th scope="col">Data Importações</th>
                                <th scope="col">Visualizar detalhes</th>
                                
                            </tr>
                        </thead>

                        <tbody>
                                
                            <?php foreach ($imprimir as $imprimedata) : ?> 
                                <tr>
                                                
                                    <td>
                                            
                                    <?php 
                                    $dataehora = $imprimedata['DataeHora'];
                                    $datasemh = substr($dataehora, 0, 10);

                                    echo "$datasemh"; 
                                    ?>
                                            
                                    </td>

                                    <td>                                          
                                    <?php 
                                    $dataehora = $imprimedata['DataHoraImportacao'];
                                    $datasemhora = substr($dataehora, 0, 10);

                                    echo "$datasemhora"; 
                                    ?>
                                            
                                    </td>

                                    <td>
                                    <a href="importacoesdetalhadas.php?DataHoraImportacao=<?php echo $imprimedata['DataHoraImportacao'] ?>"><Button >Ver detalhes</Button></a>
                                    </td>
                                </tr>    
                            <?php endforeach; ?>
                        <tbody>    


                    </table>
                </div>
                
               
     
        </div>    

    </body>

</html>