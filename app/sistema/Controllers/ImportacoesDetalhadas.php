<?php

namespace app\sistema\Controllers;



class ImportacoesDetalhadas
{
    /** @var $data recebe os dados que devem ser enviados */
    private $data;

    public function index()
    {

        $listImportacoes = new \Sistema\Models\ModImportacoesDetalhadas();
        $listImportacoes->listImportacoes();


        if($listImportacoes->getResult()){
            $this->data['listImportacoes'] = $listImportacoes->getResultBd();
        }

        //instanciando a classe ConfigView, criando um objeto da classe chamado $loadView
        $loadView = new \Core\ConfigView("sistema/Views/importacoesDetalhadas", $this->data);
        //instanciando o método loadView que fica na classe ConfigView
        $loadView->loadView();
    }
}