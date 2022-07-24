<?php

session_start();
include('../classesEsimilares/verificalogin.php');

require '../config.php';
require '../classesEsimilares/Usuarios.php';


$usuariomostra = new Usuarios($mysql);
$usuarios = $usuariomostra->exibirTodos();

?>

<!DOCTYPE html>
<html lang="pt">
 
    <head>
        <p><?php echo $_SESSION['Nome'];?></p>
        
        <title>Usuarios Cadastrados</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="../assets/css/style.css">
        <link rel="stylesheet" href="../assets/css/usuarios.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../assets/css/style.css">
        <link rel="stylesheet" href="../assets/css/usuarios.css">

    </head>

    <body>
       
    

    <h1 id="titulo">USUÁRIOS CADASTRADOS</h1>

    <a href="../paginasadmin/cadastrarusuarios.php"><button id="novo">Novo usuário</button></a>

    <div class="tabelausuarios">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">NOME</th>
                <th scope="col">EMAIL</th>
                <th scope="col">OPÇÕES</th>

            </tr>
            </thead>
            <tbody>

            <?php
            $url = str_replace("Novo/", "", $_SERVER["REQUEST_URI"]);
            $explodeurl = explode("=", $url);

                            
            $usuariomodificado = $explodeurl[1];

            $usuariomodificado1 = str_replace("%20", " ", $usuariomodificado);

            $usuariomodificado2 = str_replace(".php", "", $usuariomodificado1);
            
            $usuariourl1 = str_replace("%27", " ", $usuariomodificado2);

            

            $usuariourl = substr($usuariourl1, 3, 20);

           
            ?>

                <?php foreach ($usuarios as $usuariomostra) : ?>
            
                    <tr>
                    <td><?php echo $usuariomostra['ID'];?></td>
                    <td><?php echo $usuariomostra['Nome'];?></td>
                    <td><?php echo $usuariomostra['Email'];?></td>
                    <td><a href="../paginasadmin/editarusuarios.php?id=<?php echo $usuariomostra['ID'] ?>"> <button id="editar">Editar</button></a>          
                    
                    
                    <?php 
                        if ($usuariourl === $usuariomostra['Nome']) { ?>
                            <a href="usuarioscadastrados.php"><button id="remover">Excluir</button></a> 
                        
                    <?php 
                        }else{ ?>
                            <a href="../paginasadmin/removerusuario.php?id=<?php echo $usuariomostra['ID'] ?>">
                            <button id="remover">Excluir</button></a> 
                    <?php 
                        }?>
                    </td>    


                    </tr>
                <?php endforeach; ?>
            
            </tbody>
        </table>

        

        <a href="../paginasadmin/importacoes.php?Nome = <?php echo $usuariourl ?>"><button >Voltar</button></a>        

    </div>

    </body>

</html>



