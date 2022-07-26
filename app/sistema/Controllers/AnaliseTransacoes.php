<?php

namespace app\sistema\Controllers;



class AnaliseTransacoes
{
   
    private $data;
    private $mesescolhido;
    private $dataForm;
    private $contasuspeita;

    public function index()
    {
        $data = [];
        $this->data = $data;
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        
        if(!empty($this->dataForm['enviaMes'])) {
            $contasuspeita = new \Sistema\Models\ModAnaliseTransacoes();
            $contasuspeita->contaSuspeita();

            echo "tentando acessar this-.contasuspeita do controller";
            var_dump($this->contasuspeita);
            
            //if($contasuspeita->getResult()){
                
                           
            $this->data['contasuspeita'] = $this->contasuspeita;

            var_dump( $this->contasuspeita);
            exit();

            
               
        }//else{
                
            //    $this->data['contasuspeita'] = [];
            //}
                
       
        $loadView = new \Core\ConfigView("sistema/Views/analiseTransacoes", $this->data);
        
        $loadView->loadView();
    }
}