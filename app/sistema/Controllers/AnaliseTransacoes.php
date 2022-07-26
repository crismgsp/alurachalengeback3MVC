<?php

namespace app\sistema\Controllers;



class AnaliseTransacoes
{
   
    private $data;
    private $mesescolhido;
    private $dataForm;

    public function index()
    {
        $data = [];
        $this->data = $data;
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        
        if(!empty($this->dataForm['enviaMes'])) {
            $contasuspeita = new \Sistema\Models\ModAnaliseTransacoes();
            $contasuspeita->contaSuspeita();
            if($contasuspeita->getResult()){
                
                var_dump($contasuspeita);
                exit();
               
                $this->data['listarusuarios'] = $listarusuarios->getResultBd();
               
            }else{
                
                $this->data['listarusuarios'] = [];
            }
        }
               

    
        $loadView = new \Core\ConfigView("sistema/Views/analiseTransacoes", $this->data);
        
        $loadView->loadView();
    }
}