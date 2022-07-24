<?php

/* verifica se tem algum usuario permitido logado pra acessar as paginas...caso nao volta pra pagina inicial */

/*session_start(); */

if(!$_SESSION['Nome']) {
    header('Location:../index.html');
    exit();
}

