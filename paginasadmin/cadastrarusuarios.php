<?php

session_start();

include('../classesEsimilares/verificalogin.php');

require '../classesEsimilares/Usuarios.php';

$adiciona = filter_input(INPUT_POST, 'adiciona', FILTER_SANITIZE_SPECIAL_CHARS);
if($adiciona) {
	require '../config.php';
}


if ($_SERVER['REQUEST_METHOD'] ==='POST') {
	$inserirus = new Usuarios($mysql);
	$_POST['Senha']= password_hash($_POST['Senha'], PASSWORD_DEFAULT);
	$inserirus->adicionarusuario($_POST['Nome'], $_POST['Email'], $_POST['Statuss'], $_POST['Senha']);

	header('Location: ../paginasvisualizacao/usuarioscadastrados.php');
	die();
}


?>

<!DOCTYPE html>

<html lang=”pt-br”>

    <head>
		<meta charset =”UTF-8
		<meta name="viewport" content="width=device-width initial-scale=1.0"> 
		
		<link rel="stylesheet" href="../assets/css/usuarios.css">
        	
		
		<link rel="stylesheet" href="../assets/css/cadastro.css">
        
		<link rel='stylesheet' href='//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css' type='text/css'>
		
		<link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">

		
	</head>

	<?php $Nome = $_SESSION['Nome']; ?>
             
			                                
			<div class="menu">
				<a href="importacoes.php?Nome=<?php
				echo $Nome ?>"> <button id="botaoacesso">Importacoes</button></a>
		 
				<a href="../paginasvisualizacao/usuarioscadastrados.php?Nome=<?php
				echo $Nome ?>.php"> <button id="botaoacesso">Ver usuários cadastrados</button></a>
		 
				<a href="../paginasvisualizacao/analisetransacoes.php?Nome=<?php
				echo $Nome ?>.php"> <button id="botaoacesso">Transações suspeitas</button></a>
		 
				<a href="../index.html"><button class="logout">Logout</button></a>
		 
			</div>  
		 
			   
				 
			 </header>	

	<body>

        <header>

			<?php

			$url = str_replace("Novo/", "", $_SERVER["REQUEST_URI"]);
                $explodeurl = explode("=", $url);

                            
                $usuariomodificado = $explodeurl[1];
            
                $usuario = str_replace("%27", " ", $usuariomodificado);
            

                ?>

               
	
			
				
		</header>	

		<p>Olá <?php echo $_SESSION['Nome'];?></p>
        
		
		       
        

		<form action="cadastrarusuarios.php" method="post" class ="formadicionar" data-form>
			
			

				
			<input type="text" class="nomepreco"  required placeholder="Nome Completo" name="Nome" > 

			<input type="text" class="nomepreco"  required placeholder="Email nome@email.com" name="Email" >

				

			<input type="text" class="nomepreco"  required placeholder="Status 1" name="Statuss" >
			<input type="text" class="nomepreco"  required placeholder="Digite a senha" name="Senha" >
							
			<input type="submit" value="Adicionar usuario" class="botaoadiciona" name="adiciona">	

		</form>	
		

    </body>
    
</html>    