<?php

namespace app\sistema\Controllers;


/**
 * Controller da pagina listar usuarios
 */
class UsuariosCadastrados
{
    /** @var $data recebe os dados que devem ser enviados */
    private $data;

    public function index()
    {
        //vai instanciar a model responsavel por buscar os usuarios no banco de dados
        $listarusuarios = new \Sistema\Models\ModUsuariosCadastrados();
        $listarusuarios->listarUsuarios();
        if($listarusuarios->getResult()){
            //se getResult for true encontrou registro de usuario no banco de dados, entao instancia o metodo que recebe estes dados
            $this->data['listarusuarios'] = $listarusuarios->getResultBd();
            //var_dump($this->data['listUsers']);
        }else{
            //caso nao receba nada recebe um vazio
            $this->data['listarusuarios'] = [];
        }

        //instanciando a classe ConfigView, criando um objeto da classe chamado $loadView
        $loadView = new \Core\ConfigView("sistema/Views/usuariosCadastrados", $this->data);
        //instanciando o método loadView que fica na classe ConfigView
        $loadView->loadView();
    }
}