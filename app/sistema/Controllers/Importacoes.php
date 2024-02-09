<?php

namespace app\sistema\Controllers;


class Importacoes
{
   
    private $data;
    private $dataForm;
    
        
       
    public function index(): void
    {
        
        if(!empty($_FILES['file'])){
            $this->dataForm = $_FILES['file'];
        }       
        

                        
        //se o usuario clicou no botao de acessar executa o que ta dentro deste if
        //troquei o nome do botao a ser clicado pelo nome "name" que apareceu no var_dump que fiz de teste e ai acessou o if
        if(!empty($this->dataForm['name'])) {

                                    
            $valCsv = new \Sistema\Models\ModImportacoes();
            
            $valCsv->readCsv($this->dataForm);

            
                        
            if($valCsv->getResult()){
               
                //$_SESSION['msg'] = "<p style= 'color: green;'>Arquivo importado com sucesso.</p>";
                $this->result = true;
                
            }else {
                $this->result = false;
            }
           
        }
                    
        $loadView = new \Core\ConfigView("sistema/Views/importacoes", $this->data);
        $loadView->loadView();
    }
}