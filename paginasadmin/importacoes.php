<?php
session_start();
include('../classesEsimilares/verificalogin.php');


?>


<!DOCTYPE html>
<html lang="pt">
 
    <head>
        <title>Importar transações</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../assets/css/style.css">
        <link rel="stylesheet" href="../assets/css/diversos.css">

    </head>

    <header>
    <?php 
        
    $Nome = $_SESSION['Nome'];
             
    ?>                               
        <div class="menu">
            <a href="../paginasvisualizacao/importacoesfeitas.php?Nome=<?php
            echo $Nome ?>"> <button id="botaoacesso">Importacoes feitas</button></a>

            <a href="cadastrarusuarios.php?Nome=<?php
            echo $Nome ?>.php"> <button id="botaoacesso">Usuarios</button></a>

            <a href="../paginasvisualizacao/analisetransacoes.php?Nome=<?php
            echo $Nome ?>.php"> <button id="botaoacesso">Transações suspeitas</button></a>

            <a href="../index.html"><button class="logout">Logout</button></a>

        </div>  

  	
		
	</header>	

    <body>
        <div id="titulodiv">

        <h3 id="titulosuperior">Importar transações</h3> 
        
        </div>


        <div class="container">

            
                            
            <form action="../classesEsimilares/importar4.php?Nome = <?php echo $Nome ?>" method="post" enctype="multipart/form-data">
                <div class="jumbotron">
                <h2>Upload do CSV</h2>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="customFile" name="file">
                        <label class="custom-file-label" for="customFile"></label>
                    </div>
                
                    <button type="submit" class="enviar">Enviar</button>
            </form>
        </div>

        <?php 

   
    ?>

    </body>

</html>