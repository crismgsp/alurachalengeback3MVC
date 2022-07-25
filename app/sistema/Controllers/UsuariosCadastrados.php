<?php

namespace app\sistema\Controllers;



class UsuariosCadastrados
{
   
    private $data;

    public function index()
    {
        
        $listarusuarios = new \Sistema\Models\ModUsuariosCadastrados();
        $listarusuarios->listarUsuarios();
        if($listarusuarios->getResult()){
            
            $this->data['listarusuarios'] = $listarusuarios->getResultBd();
           
        }else{
            
            $this->data['listarusuarios'] = [];
        }

    
        $loadView = new \Core\ConfigView("sistema/Views/usuariosCadastrados", $this->data);
        
        $loadView->loadView();
    }
}