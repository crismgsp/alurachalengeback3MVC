<?php

namespace app\sistema\Controllers;



class AnaliseTransacoes
{
   
    private $data;
    private $mesescolhido;
    private $dataForm;
    private $contasuspeita;
    private $agenciasuspeitatotal;

    public function index()
    {
        $data = [];
        $this->data = $data;
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        //coloquei isto aqui pra sumir aquele erro da pagina antes de escolher o mes
        $this->data['contasuspeita'] = [];
        $this->data['agenciasuspeita'] = [];
        $this->data['transacaosuspeita'] = [];
        
        if(!empty($this->dataForm['enviaMes'])) {
            $contasuspeita = new \Sistema\Models\ModAnaliseTransacoes();
            $contasuspeita->contaSuspeita();
			
			                  
            
            if($contasuspeita->getResult()){
                           
                $this->data['contasuspeita1'] = $contasuspeita->getResultBd();

                $this->data['contasuspeita2'] = $contasuspeita->getResultBd2();

                $this->data['contas'] = array_merge($this->data['contasuspeita1'], $this->data['contasuspeita2']);
				
				//var_dump($this->data['contas']);
				//exit();

                //parte das contas suspeitas

                $contasuspeita1 = array();

                foreach($this->data['contas'] as $dados) {
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
				
				//parte das agencias suspeitas
			 	

                $agenciasuspeita1 = array();

                foreach($this->data['contas'] as $dados) {
                    $chave = $dados['Banco'].$dados['Agencia'].$dados['Conta'];
                    if (!array_key_exists($chave, $agenciasuspeita1)) {
                        $agenciasuspeita1[$chave] = array( 
                            'Banco' => $dados['Banco'],
                            'Agencia' => $dados['Agencia'],
                            'Conta' => $dados['Conta'],
                            'Soma' => $dados['Soma'],
                            
                        );
                    }else{
                        $agenciasuspeita1[$chave] = array (
                            'Banco' => $dados['Banco'],
                            'Agencia' => $dados['Agencia'],
                            'Conta' => $dados['Conta'],
                            'Soma' => $agenciasuspeita1[$chave]['Soma'] + $dados['Soma'],
                        );
                    }
                }
				
				//var_dump($agenciasuspeita1);
				//exit();
           
           
   
                $agenciasuspeitatotal = array();
        
                foreach($agenciasuspeita1 as $suspeita ) {
                    $soma = intval($suspeita['Soma']);
					//var_dump($soma);
					//echo "-";
					
                    if($soma > 1000000000) {
                        array_push($agenciasuspeitatotal, $suspeita);
                    }
                }
				
				//var_dump($agenciasuspeitatotal);
				//exit();

                

                $this->data['agenciasuspeita'] = $agenciasuspeitatotal;
				
				//var_dump($this->data['agenciasuspeita']);
				//exit();   aqui aparece informacao para o mes que nao tem agencia suspeita...mas ao fazer o var_dump na view nao está aparecendo
	
				
				
			}

			
                
                
                //parte das transacoes suspeitas
                    $transacaosuspeita = new \Sistema\Models\ModAnaliseTransacoes();
                    $transacaosuspeita->transacaosuspeita();
					
					//var_dump($transacaosuspeita->getResultBd());
					//exit();
                        
                    
                    if($transacaosuspeita->getResult()){
                        $this->data['transacaosuspeita'] = $transacaosuspeita->getResultBd();

                        $transacaosuspeita = array();

                        foreach($this->data['transacaosuspeita'] as $dados) {
                            $valor = $dados['Valor'];
                            if ($valor > 100000) {
                                array_push($transacaosuspeita, $dados);
                            }
                        }
                        $this->data['transacaosuspeita'] = $transacaosuspeita;
						
						
                        
                    }
                        
            
                
            
   
        }else{
                            
                $this->data['contasuspeita'] = [];
                $this->data['agenciasuspeita'] = [];
                $this->data['transacaosuspeita'] = [];
            } 

        //var_dump($this->data);
		//exit();
    
        $loadView = new \Core\ConfigView("sistema/Views/analiseTransacoes", $this->data);
                
        $loadView->loadView();
    }    
}