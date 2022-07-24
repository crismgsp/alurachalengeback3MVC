<?php

namespace App\sistema\Controllers;


class Logout
{
    
    public function index(): void
    {
        unset($_SESSION['user_id'], $_SESSION['user_name'], 
        $_SESSION['user_email']);
        $_SESSION['msg'] = "<p style='color: green;'> Logout realizado com sucesso! </p>";
        $urlRedirect = URLSISTEMA . "login/index";
        header("Location: $urlRedirect");

    }
}