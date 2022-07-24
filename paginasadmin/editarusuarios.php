<?php

session_start();
include('../classesEsimilares/verificalogin.php');

require '../config.php';
require '../classesEsimilares/Usuarios.php';
require '../classesEsimilares/redireciona.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(empty($_POST)) {
        echo "Voce precisa preencher todos dados para editar";
    }elseif($_POST['Nome'] === 'Admin') {
        echo "O usuario Admin nao pode ser editado";
    } 
    else{
        $edita = new Usuarios($mysql);
        $editar = $edita->editar($_POST['id'], $_POST['Nome'], $_POST['Email']);
    
        header("Location: ../paginasvisualizacao/usuarioscadastrados.php");
    }
    
}

$usuario = new Usuarios($mysql);
$user = $usuario->encontrarPorId($_GET['id']);


?>


<!DOCTYPE html>
<html lang="pt">
 
    <head>
        <title>Editar usuario</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="../assets/css/diversos.css">
        <link rel="stylesheet" href="../assets/css/cadastro.css">
        
 
    </head>

    <body>

        <p1>Olá <?php echo $_SESSION['Nome'] ?></p1>

        <div id="diveditar">

            

        <p1><a href="../classesEsimilares/logout.php"><button>Logout</button></a></p1>

        <p id="textoedicao"> Edição do usuário </p>

            <form action="editarusuarios.php?id=<?php echo $user['id']?>"  method="post" class ="formadicionar" data-form>
           
                
                <input type="hidden" class="nomepreco"   name="id" value="
                <?php echo $user['id']; ?>" > 
                
                <input type="text" class="nomepreco"   name="Nome" value="
                <?php echo $user['Nome']; ?>" > 

                <input type="text" class="nomepreco"  required placeholder="Email nome@email.com" name="Email"
                value= "<?php echo $user['Email']; ?>" >

                
                            
                <input type="submit" value="Editar usuario" class="botaoaedita" name="edita">	

            </form>	
   
        </div>

    </body>

</html>    