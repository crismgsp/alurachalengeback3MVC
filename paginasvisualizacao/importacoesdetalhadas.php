<?php

session_start();
include('../classesEsimilares/verificalogin.php');

include ('../classesEsimilares/service.php');

require '../config.php';


$imprimedados = new Imprime($mysql);
$imprime = $imprimedados->dadoscompletos();


?>

<!DOCTYPE html>
<html lang="pt">
 
    <head>
        <title>Visualizar importacoes</title>
        <p1><a href="../classesEsimilares/logout.php"><button>Logout</button></a></p1>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="../assets/css/style.css">
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


    </head>

    <body>



    <table class="table" >
        <thead>
            <tr>
                <th scope="col">Banco de Origem</th>
                <th scope="col">Agencia de Origem</th>
                <th scope="col">Conta de Origem</th>
                <th scope="col">Banco de Destino</th>
                <th scope="col">Agencia de Destino</th>
                <th scope="col">Conta de Destino</th>
                <th scope="col">Valor</th>
                <th scope="col">Data e Hora da transação</th>
                <th scope="col">Data e Hora da Importação</th>
                <th scope="col">Usuário responsável</th>


            </tr>
        </thead>
        <tbody>
            <?php foreach ($imprime as $imprimirdados) : ?>
                <tr>
                    <td><?php echo $imprimirdados['BancoOrigem']; ?></td>
                    <td><?php echo $imprimirdados['AgenciaOrigem']; ?></td>
                    <td><?php echo $imprimirdados['ContaOrigem']; ?></td>
                    <td><?php echo $imprimirdados['BancoDestino']; ?></td>
                    <td><?php echo $imprimirdados['AgenciaDestino']; ?></td>
                    <td><?php echo $imprimirdados['ContaDestino']; ?></td>
                    <td><?php echo $imprimirdados['Valor']; ?></td>
                    <td><?php echo $imprimirdados['DataeHora']; ?></td>
                    <td><?php echo $imprimirdados['DataHoraImportacao']; ?></td>
                    <td><?php echo $imprimirdados['Usuario']; ?></td>

                </tr>
            <?php endforeach; ?> 
        </tbody>
    </table>

    <?php

    $url = str_replace("Novo/", "", $_SERVER["REQUEST_URI"]);
                $explodeurl = explode("=", $url);

                            
                $usuariomodificado = $explodeurl[1];
            
                $usuario = str_replace("%27", " ", $usuariomodificado);
            

    ?>

 
    <a href="importacoesfeitas.php?Nome = <?php echo $usuario ?>"><button>Voltar para importações feitas</button></a>
    
    </body>      
    
</html>    
    