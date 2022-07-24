<?php

session_start();

require '../config.php';
require '../classesEsimilares/analisefinanceira.php';


$contas = new Analise($mysql);
$contassuspeitas = $contas->transacaoSuspeita();

$contassusp = new Analise($mysql);
$contassuspeitasmes = $contassusp->contaSuspeita();

$agenciassusp = new Analise($mysql);
$agenciasuspeitasmes = $agenciassusp->agenciaSuspeita();


?>

<!DOCTYPE html>
<html lang="pt">
 
    <head>
        <title>Visualizar importacoes</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="../assets/css/style.css">
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


    </head>

    <header>
    <?php 
        
    $Nome = $_SESSION['Nome'];
             
    ?>                               
        <div class="menu">
            <a href="../paginasadmin/importacoes.php?Nome = <?php echo $Nome ?>"> 
            <button id="botaoacesso">Importacoes</button></a>

            <a href="../paginasadmin/cadastrarusuarios.php?Nome=<?php
            echo $Nome ?>.php"> <button id="botaoacesso">Usuarios</button></a>

            <a href="../index.html"><button class="logout">Logout</button></a>

        </div>  

  	
		
	</header>	

    <body>

    <div>

    <!-- <p1>Escolha o mês de analise (digite o número do mês (1 a 12) e dê enter </p1>    
    <form name="selecao" action="analisetransacoes.php" method="POST">
        <input name="selecao"></input>    
    </form>  -->

    <form name="selecao" action="analisetransacoes.php" method="POST">

        <label>Escolha um mês pra analise</label>
   
        <select name="selecao">
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
            <option>6</option>
            <option>7</option>
            <option>8</option>
            <option>9</option>
            <option>10</option>
            <option>11</option>
            <option>12</option>

        </select>

        <input type="submit" value="Após selecionar clique aqui" />

    </form>

    

    </div>

    <h3>Transacoes Suspeitas</h3>
    
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
                <th scope="col">Mes</th>


            </tr>
        </thead>
        <tbody>
            
            <?php foreach ($contassuspeitas as $contas) : ?>
                <tr>
                    <td><?php echo $contas['BancoOrigem']; ?></td>
                    <td><?php echo $contas['AgenciaOrigem']; ?></td>
                    <td><?php echo $contas['ContaOrigem']; ?></td>
                    <td><?php echo $contas['BancoDestino']; ?></td>
                    <td><?php echo $contas['AgenciaDestino']; ?></td>
                    <td><?php echo $contas['ContaDestino']; ?></td>
                    <td><?php echo $contas['Valor']; ?></td>
                    <td><?php echo $contas['DataeHora']; ?></td>
                    <td><?php echo $contas['DataHoraImportacao']; ?></td>
                    <td><?php echo $contas['Mes']; ?></td>
                    

                </tr>
            <?php endforeach; ?> 
        </tbody>
    </table>

    <h3>Contas Suspeitas</h3>
    <table class="table" >
        <thead>
            <tr>
                <th scope="col">Banco</th>
                <th scope="col">Agencia</th>
                <th scope="col">Conta</th>
                <th scope="col">Valor</th> 
                


            </tr>
        </thead>
        <tbody>
            <?php foreach ($contassuspeitasmes as $contames) : ?>
                <tr>
                    <td><?php echo $contames['Banco']; ?></td>
                    <td><?php echo $contames['Agencia'];  ?></td>
                    <td><?php echo $contames['Conta']; ?></td>
                    <td><?php echo $contames['Soma']; ?></td>
                    
                </tr>
            <?php endforeach; ?> 
        </tbody>
    </table>

    <h3>Agencias Suspeitas</h3>
    <table class="table" >
        <thead>
            <tr>
                <th scope="col">Banco</th>
                <th scope="col">Agencia</th>
                <th scope="col">Valor</th> 


            </tr>
        </thead>
        <tbody>
            <?php foreach ($agenciasuspeitasmes as $agencia) : ?>
                <tr>
                    <td><?php echo $agencia['Banco']; ?></td>
                    <td><?php echo $agencia['Agencia']; ?></td>
                    <td><?php echo $agencia['Soma']; ?></td>
                    
                    

                </tr>
            <?php endforeach; ?> 
        </tbody>
    </table>

