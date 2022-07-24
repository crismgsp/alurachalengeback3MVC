<?php

session_start();
include('../classesEsimilares/verificalogin.php');

require '../config.php';
require '../classesEsimilares/Usuarios.php';
require '../classesEsimilares/redireciona.php';





if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(empty($_POST)) {
        echo "Voce precisa digitar o 2 para excluir";
    }
    
    elseif($_POST['nome'] === $_SESSION['Nome']) {
        echo " Um usuario não pode excluir ele mesmo";
    }elseif($_POST['nome'] === 'Admin') {
        echo "O usuario Admin nao pode ser excluido";
    }
    
    else{
        $mudastatusUsuario = new Usuarios($mysql);
        $remove = $mudastatusUsuario->mudastatus($_POST['id'], $_POST['Statuss']);
        
        header("Location: ../paginasvisualizacao/usuarioscadastrados.php");

    }  

}

/*preciso arrumar esta logica aqui.... nao ta reconhecendo o id...session 
    /*$mudastatusUsuario = new Usuarios($mysql);
    $remove = $mudastatusUsuario->mudastatus($_POST['id'], $_POST['Statuss']); */

    

$usuario = new Usuarios($mysql);
$user = $usuario->encontrarPorId($_GET['id']);

/*$nome = new Usuarios($mysql);
$nomeusuario = $nome->encontrarPorId($_GET['Nome']); */


?>


<!DOCTYPE html>
<html lang="pt">
 
    <head>
        <title>Remover usuario</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="../assets/css/diversos.css">
        <link rel="stylesheet" href="../assets/css/cadastro.css">
 
    </head>

    <body>

        <div id="divexclusao">

        
        <p1>Olá <?php echo $_SESSION['Nome'] ?></p1>

        

        <p id="textoedicao"> Para "excluir" digite 2 no Status e clique no botão </p>

    
            
            <form action="removerusuario.php?id=<?php echo $user['id']?>" method="post" class ="formadicionar" data-form>

                <input type="hidden" class="nomepreco"   name="id" value="<?php echo $user['id']; ?>">

                <input type="hidden" class="nomepreco"   name="nome" value="<?php echo $user['Nome']; ?>">

                <input type="text" class="nomepreco"   name="Statuss" value="<?php echo $user['Statuss']; ?>">
                          
                <input type="submit" value="Excluir usuario" class="botaoaexclui" name="exclui">	

            </form>	
  
        </div>

    </body>

</html>    