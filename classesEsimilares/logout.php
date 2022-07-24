<?php

function logout() {

    session_start();  
    unset($_SESSION['Name']);        
    session_destroy();
    
}      


logout();

header('Location:../index.html');
die();

/*

header('Location:../index.html');
die();


if(isset($_SESSION['Nome'])) {
    unset($_SESSION['Nome']);
    header('Location:../index.html');
    
    exit();
} */



