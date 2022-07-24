<?php


session_start(); 

require '../config.php';


if(empty($_POST['Email']) || empty($_POST['Senha'])) {
    header('Location: ../paginasvisualizacao/paginalogin.html');
    exit();
}


$query = sprintf(
    "SELECT Senha, Nome, Statuss, id FROM usuarios WHERE Email='%s'",
    mysqli_real_escape_string($mysql, $_POST['Email'])
);

$result = mysqli_query($mysql, $query);


if (!$result) {
    $message  = 'Invalid query: ' . mysql_error() . "\n";
    $message .= 'Whole query: ' . $query;
    die($message);
}

$row = mysqli_fetch_row($result);

$Nome = $row[1];

$Statuss = $row[2];

/*
var_dump($row[0]); 
exit(); fiz isso pra descobrir a senha criptografada pra colocar no novo banco... */


if (password_verify($_POST['Senha'], $row[0]) && $Statuss == 1)  {
    $_SESSION['Nome']= $Nome; 
    header("Location: ../paginasadmin/importacoes.php?Nome='$Nome'"); 
    
    exit();
}else {
    echo "Usuario ou senha não existem";
    header('Location: ../index.html');
}
