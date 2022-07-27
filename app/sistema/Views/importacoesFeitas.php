<?php


if(isset($this->data['form'])) {
    
    $valorForm = $this->data['form'];
  
}

if(isset($this->data['form'][0])) {
    $valorForm = $this->data['form'][0];
    
}

if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    
             
?>                               
      
    <br><br>
    <p><?php echo "Bem vindo " . $_SESSION['user_name'];?></p>

    

        <div id="informacoes">

            <div id="cabecalho">
                <h1> Importações realizadas</h1>

              
            </div>

                            

                <div class="tabela1">

                    <table  id="tabela1">    
                        <thead id="titulo1">
                            <tr id="transacoes">
                                <th scope="col">Data Transações</th>
                                <th scope="col">Data Importações</th>
                                <th scope="col">Visualizar detalhes</th>
                                
                            </tr>
                        </thead>

                        <tbody>
                                
                            <?php foreach ($this->data['listDatas'] as $imprimedata) : ?> 
                                <tr>
                                                
                                    <td>
                                            
                                    <?php 
                                    $dataehora = $imprimedata['DataeHora'];
                                    $datasemh = substr($dataehora, 0, 10);

                                    echo "$datasemh"; 
                                    ?>
                                            
                                    </td>

                                    <td>                                          
                                    <?php 
                                    $dataehora = $imprimedata['DataHoraImportacao'];
                                    $datasemhora = substr($dataehora, 0, 10);

                                    echo "$datasemhora"; 
                                    ?>
                                            
                                    </td>

                                    <td>
                                    
                                    <?php 
                                    $dataimportacao = $imprimedata['DataHoraImportacao'];
                                    echo "<a href='".URLSISTEMA."importacoes-detalhadas/index/$dataimportacao'><Button>Ver detalhes</Button></a>"; 
                                    ?>
                                    </td>
                                </tr>    
                            <?php endforeach; ?>
                        <tbody>    


                    </table>
                </div>
                
               
     
        </div>    

    </body>

</html>