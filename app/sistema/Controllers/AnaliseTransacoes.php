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
                  
            
            if($contasuspeita->getResult()){
                           
                $this->data['contasuspeita1'] = $contasuspeita->getResultBd();

                $this->data['contasuspeita2'] = $contasuspeita->getResultBd2();

                $this->data['contasuspeita'] = array_merge($this->data['contasuspeita1'], $this->data['contasuspeita2']);

                $contasuspeita1 = array();

                foreach($this->data['contasuspeita'] as $dados) {
                    $chave = $dados['Banco'].$dados['Agencia'].$dados['Conta'];
                    if (!array_key_exists($chave, $contasuspeita1)) {
                        $contasuspeita1[$chave] = array( 
                            'Banco' => $dados['Banco'],
                            'Agencia' => $dados['Agencia'],
                            'Conta' => $dados['Conta'],
                            'Soma' => $dados['Soma'],
                            
                        );
                    }else{
                        $contasuspeita1[$chave] = array (
                            'Banco' => $dados['Banco'],
                            'Agencia' => $dados['Agencia'],
                            'Conta' => $dados['Conta'],
                            'Soma' => $contasuspeita1[$chave]['Soma'] + $dados['Soma'],
                        );
                    }

         }
          
       
            $contasuspeita = array();
            
            foreach($contasuspeita1 as $dados) {
                $soma = intval($dados['Soma']);

                if($soma > 1000000) {
                    array_push($contasuspeita, $dados);
                }
            }

            
            $this->contasuspeita = $contasuspeita;


            $this->data['contasuspeita'] = $this->contasuspeita;
            
            //var_dump( $this->data['contasuspeita']);
            //exit();
           
                
            }else{
                    
                $this->data['contasuspeita'] = [];
            }
                    
        
            
        }

        $loadView = new \Core\ConfigView("sistema/Views/analiseTransacoes", $this->data);
            
        $loadView->loadView();

    }    
}