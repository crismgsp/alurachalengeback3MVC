<?php

session_start();


require '../config.php';

class Analise
{
    private $mysql;
    
    public function __construct(mysqli $mysql)
    {
        $this->mysql = $mysql;
    }

    public function transacaoSuspeita(): array
    { 

        $mesescolhido = $_POST['selecao'];

        $resultado = $this->mysql->query("SELECT * FROM transacoes WHERE Mes = '$mesescolhido'");     
             
        $dadosconta = $resultado->fetch_all(MYSQLI_ASSOC);

        /* checar os valores de todas transacoes se for > que 100.000 armazena no $dadoscontas 
        depois tentar separar por mes para a pessoa poder filtrar*/

        $transacaosuspeita = array();

        foreach($dadosconta as $dados) {
            $valor = $dados['Valor'];
            if ($valor > 100000) {
                array_push($transacaosuspeita, $dados);
            }
        }

        return $transacaosuspeita;
    }


    public function contaSuspeita(): array
    { 

        $mesescolhido = $_POST['selecao'];    
        
        $resultado = $this->mysql->query("SELECT BancoOrigem as Banco, AgenciaOrigem as Agencia, ContaOrigem as Conta, Sum(Valor) as Soma FROM transacoes WHERE Mes = '$mesescolhido' 
        GROUP BY ContaOrigem, BancoOrigem, AgenciaOrigem"); 
                  
        $dadosconta = $resultado->fetch_all(MYSQLI_ASSOC);

        
        $resultado2 = $this->mysql->query("SELECT BancoDestino as Banco, AgenciaDestino as Agencia, ContaDestino as Conta, Sum(Valor) as Soma FROM transacoes WHERE Mes = '$mesescolhido' 
        GROUP BY ContaDestino, BancoDestino, AgenciaDestino");

        
        
        $dadosconta2 = $resultado2->fetch_all(MYSQLI_ASSOC); 

        

         $dadostotais = array_merge($dadosconta, $dadosconta2);  

     
         $contasuspeita1 = array();

         foreach($dadostotais as $dados) {
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
            $soma = $dados['Soma'];

            if($soma > 1000000) {
                array_push($contasuspeita, $dados);
            }
        }

        return $contasuspeita;
    }

    public function agenciaSuspeita(): array
    { 

        
        $mesescolhido = $_POST['selecao'];

        $resultado = $this->mysql->query("SELECT BancoOrigem as Banco, AgenciaOrigem as Agencia, Sum(Valor) as Soma FROM transacoes WHERE Mes = '$mesescolhido' 
        GROUP BY  BancoOrigem, AgenciaOrigem");     
             
        $dadosconta = $resultado->fetch_all(MYSQLI_ASSOC);

        $resultado2 = $this->mysql->query("SELECT BancoDestino as Banco, AgenciaDestino as Agencia, Sum(Valor) as Soma FROM transacoes WHERE Mes = '$mesescolhido' 
        GROUP BY BancoDestino, AgenciaDestino");

        $dadosconta2 = $resultado2->fetch_all(MYSQLI_ASSOC);


        /* checar os valores de todas contas tentar agrupar por conta de alguma forma observando os dados de agencia, banco e numero conta e 
        fazer uma soma dos valores mensais*/

        $dadostotais = array_merge($dadosconta, $dadosconta2);  

     
         $agenciasuspeita1 = array();

         foreach($dadostotais as $dados) {
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
        
      

        $agenciasuspeitatotal = array();

        foreach($agenciasuspeita1 as $suspeita ) {
            $soma = $suspeita['Soma'];
            if($soma > 1000000000) {
                array_push($agenciasuspeitatotal, $suspeita);
            }
        }

        
        return $agenciasuspeitatotal;
        
    }
   
}



