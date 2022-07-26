<?php

namespace app\sistema\Controllers;



class AnaliseTransacoes
{
   
    private $data;

    public function index()
    {
        
        /*
        ainda vou instanciar a model que irei criar baseada na classesesimilares analise financeira
        $listarusuarios = new \Sistema\Models\ModUsuariosCadastrados();
        $listarusuarios->listarUsuarios();
        if($listarusuarios->getResult()){
            
            $this->data['listarusuarios'] = $listarusuarios->getResultBd();
           
        }else{
            
            $this->data['listarusuarios'] = [];
        } */

    
        $loadView = new \Core\ConfigView("sistema/Views/analiseTransacoes", $this->data);
        
        $loadView->loadView();
    }
}