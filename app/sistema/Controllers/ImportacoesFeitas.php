<?php

namespace app\sistema\Controllers;



class ImportacoesFeitas
{
    /** @var $data recebe os dados que devem ser enviados */
    private $data;

    public function index()
    {

        $listDatas = new \Sistema\Models\ModImportacoesFeitas();
        $listDatas->listDatas();

        if($listDatas->getResult()){
            $this->data['listDatas'] = $listDatas->getResultBd();
        }

        //instanciando a classe ConfigView, criando um objeto da classe chamado $loadView
        $loadView = new \Core\ConfigView("sistema/Views/importacoesFeitas", $this->data);
        //instanciando o método loadView que fica na classe ConfigView
        $loadView->loadView();
    }
}