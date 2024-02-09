<?php

namespace Core;

class ConfigController extends Config
{
    
    private string $url;
    
    private array $urlArray;
   
    private string $urlController;
    
    private string $urlMetodo;
    
    private string $urlParameter;
    
    private string $classLoad;
    
    private array $format;
    
    private string $urlSlugController;
    
    private string $urlSlugMetodo;


   
    public function __construct()
    {
        $this->configAdmin();
        if(!empty(filter_input(INPUT_GET, 'url', FILTER_DEFAULT))){
            $this->url = filter_input(INPUT_GET, 'url', FILTER_DEFAULT);
            //var_dump($this->url);
            $this->clearUrl();
            $this->urlArray = explode("/", $this->url);
            //var_dump($this->urlArray);

            if(isset($this->urlArray[0])){
                $this->urlController = $this->slugController($this->urlArray[0]);
            }else {
                $this->urlController = $this->slugController(CONTROLLER);
            }

            if(isset($this->urlArray[1])){
                $this->urlMetodo = $this->slugMetodo($this->urlArray[1]);
            }else {
                $this->urlMetodo = $this->slugMetodo(METODO);
            }

            if(isset($this->urlArray[2])){
                $this->urlParameter = $this->urlArray[2];
            }else {
                $this->urlParameter = "";
            }
            
        }else {
            $this->urlController = $this->slugController(CONTROLLERERRO);
            $this->urlMetodo = $this->slugMetodo(METODO);
            $this->urlParameter = "";
        }    
        
       
    } 

  
    private function clearUrl(): void
    {
        //eliminar as tags
        $this->url = strip_tags($this->url);
        //eliminar o espaço em branco
        $this->url = trim($this->url);
        //eliminar barra no final da URL
        $this->url = rtrim($this->url, "/");
        $this->format['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]?;:.,\\\'<>°ºª ';
        $this->format['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr-------------------------------------------------------------------------------------------------';
        //$this->url = strtr(utf8_decode($this->url), utf8_decode($this->format['a']), $this->format['b']); //esta função uft8_decode está depreciada.
         //vou substitui-la pela função mb_convert_encoding...logo abaixo
         $this->url = strtr(mb_convert_encoding($this->url, 'ISO-8859-1', 'UTF-8'), mb_convert_encoding($this->format['a'],'ISO-8859-1', 'UTF-8' ),$this->format['b'] );

    }

  
    private function slugController(string $slugController): string
    {
        $this->urlSlugController = $slugController;
        //converter tudo para minusculo
        $this->urlSlugController = strtolower($this->urlSlugController);
        //converter o traço para espaço em branco
        $this->urlSlugController = str_replace("-", " ", $this->urlSlugController);
        //converter a primeira letra de cada palavra para maiusculo
        $this->urlSlugController = ucwords($this->urlSlugController);
        //retirar o espaço em branco ...acho que so fez isso agora pra poder transformar as iniciais em maiuscula antes
        $this->urlSlugController = str_replace(" ", "", $this->urlSlugController);

        //var_dump($this->urlSlugController);
        return $this->urlSlugController;
    }

   
    private function slugMetodo(string $urlSlugMetodo): string
    {
        $this->urlSlugMetodo = $this->slugController($urlSlugMetodo);
        //Converter para minusculo a primeira letra
        $this->urlSlugMetodo = lcfirst( $this->urlSlugMetodo);
        //var_dump($this->urlSlugMetodo);

        return $this->urlSlugMetodo;
    }
    
   
    public function loadPage(): void
    {
        
        $loadPgAdm = new \Core\CarregarPgAdm();
        $loadPgAdm->loadPage($this->urlController, $this->urlMetodo, $this->urlParameter);
       
        
    }
    
}