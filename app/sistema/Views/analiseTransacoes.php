<?php

if(isset($this->data['form'])) {
    $valorForm = $this->data['form'];
    
}

?>

        <br><br>
        
        <div>

<!-- <p1>Escolha o mês de analise (digite o número do mês (1 a 12) e dê enter </p1>    
<form name="selecao" action="analisetransacoes.php" method="POST">
    <input name="selecao"></input>    
</form>  -->

<form name="selecao" action="" method="POST">

    <label>Escolha um mês pra analise</label>

    <select name="selecao">
        <option value="1">janeiro</option>
        <option value="2">fevereiro</option>
        <option value="3">março</option>
        <option value="4">abril</option>
        <option value="5">maio</option>
        <option value="6">junho</option>
        <option value="7">julho</option>
        <option value="8">agosto</option>
        <option value="9">setembro</option>
        <option value="10">outubro/option>
        <option value="11">novembro</option>
        <option value="12">dezembro</option>

    </select>

    <input type="submit" name="enviaMes" value="Após selecionar clique aqui" />

</form>

<?php


$contaSuspeita = $this->data['contasuspeita'];
$agenciaSuspeita = $this->data['agenciasuspeita'];
$transacaoSuspeita = $this->data['transacaosuspeita'];


if(isset($_POST['enviaMes'])){ 
    if(!empty($transacaoSuspeita)){?>
        </div>

        <h3 style="text-align:center;">Transações Suspeitas</h3>

        <table class="table" style="border: 1px solid blue;" >
            <thead>
                <tr>
                    <th scope="col">Banco de Origem</th>
                    <th scope="col">Agencia de Origem</th>
                    <th scope="col">Conta de Origem</th>
                    <th scope="col">Banco de Destino</th>
                    <th scope="col">Agencia de Destino</th>
                    <th scope="col">Conta de Destino</th>
                    <th scope="col">Valor</th>  
                    <th scope="col">Data e Hora da transação</th>
                    <th scope="col">Data e Hora da Importação</th>
                    <th scope="col">Mes</th>


                </tr>
            </thead>
            <tbody>
                
                
                <?php foreach ($this->data['transacaosuspeita'] as $contas) : ?>
                    <tr>
                        <td><?php echo $contas['BancoOrigem']; ?></td>
                        <td><?php echo $contas['AgenciaOrigem']; ?></td>
                        <td><?php echo $contas['ContaOrigem']; ?></td>
                        <td><?php echo $contas['BancoDestino']; ?></td>
                        <td><?php echo $contas['AgenciaDestino']; ?></td>
                        <td><?php echo $contas['ContaDestino']; ?></td>
                        <td><?php echo $contas['Valor']; ?></td>
                        <td><?php echo $contas['DataeHora']; ?></td>
                        <td><?php echo $contas['DataHoraImportacao']; ?></td>
                        <td><?php echo $contas['Mes']; ?></td>
                        

                    </tr>
                <?php endforeach; ?> 
            </tbody>
        </table>

        <?php } /*else{
            echo "Este mês selecionado não tem transações suspeitas";
        }   */
    }?> 
    
<?php
    
if(isset($_POST['enviaMes'])){    
    if(!empty($contaSuspeita)){?>

        <h3 style="text-align:center; ">Contas Suspeitas</h3>
        <table class="table" style="border: 1px solid blue;">
            <thead>
                <tr>
                    <th scope="col">Banco</th>
                    <th scope="col">Agencia</th>
                    <th scope="col">Conta</th>
                    <th scope="col">Valor</th> 
                    


                </tr>
            </thead>
            <tbody>
                <?php foreach ($this->data['contasuspeita']  as $contames) : ?>
                    <tr>
                        <td><?php echo $contames['Banco']; ?></td>
                        <td><?php echo $contames['Agencia'];  ?></td>
                        <td><?php echo $contames['Conta']; ?></td>
                        <td><?php echo $contames['Soma']; ?></td>
                        
                    </tr>
                <?php endforeach; ?> 
            </tbody>
        </table>
    <?php } /*else{
        echo "Este mês selecionado não tem conta suspeita";
    }  */
}            
 

if(isset($_POST['enviaMes'])){ 
    if(!empty($agenciaSuspeita)){?>    
        <h3 style="text-align:center;">Agências Suspeitas</h3>
        <table class="table" style="border: 1px solid blue;" >
            <thead>
                <tr>
                    <th scope="col">Banco</th>
                    <th scope="col">Agencia</th>
                    <th scope="col">Valor</th> 


                </tr>
            </thead>
            <tbody>
                <?php foreach ($this->data['agenciasuspeita'] as $agencia) : ?>
                    <tr>
                        <td><?php echo $agencia['Banco']; ?></td>
                        <td><?php echo $agencia['Agencia']; ?></td>
                        <td><?php echo $agencia['Soma']; ?></td>
                        
                        

                    </tr>
                <?php endforeach; ?> 
            </tbody>
        </table>
    <?php } /*else{
        echo "Este mes selecionado não tem agencia suspeita";
    } */
}    

if(isset($_POST['enviaMes']) && (empty($contaSuspeita)) && (empty($agenciaSuspeita)) && (empty($transacaoSuspeita))) {
    echo "Este mês selecionado não tem conta, nem agencia e nem transação suspeita";
} ?>