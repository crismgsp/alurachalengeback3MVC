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
    <p style="margin-left: 5vw;"><?php echo "Bem vindo " . $_SESSION['user_name'];?></p>

    

        <div id="informacoes">

            <div id="cabecalho">
                <h2 style="padding: 4px; padding-left: 6vw;"> Importações realizadas</h2>

              
            </div>

                            

                <div class="tabela1" style="padding: 4px; padding-left: 5vw;">

                    <table  id="tabela1" >    
                        <thead id="titulo1">
                            <tr id="transacoes">
                                <th scope="col" style="border: 1px solid #444; padding: 3px;">Data Transações    </th>
                                <th scope="col" style="border: 1px solid #444; padding: 3px;">Data Importações    </th>
                                <th scope="col" style="border: 1px solid #444;padding: 3px;">Visualizar detalhes    </th>
                                
                            </tr>
                        </thead>

                        <tbody>
                                
                            <?php foreach ($this->data['listDatas'] as $imprimedata) : ?> 
                                <tr "border: 1px solid #444;padding: 3px;">
                                                
                                    <td style="border: 1px solid #444; padding: 3px;">
                                            
                                    <?php 
                                    $dataehora = $imprimedata['DataeHora'];
                                    $datasemh = substr($dataehora, 0, 10);

                                    echo "$datasemh"; 
                                    ?>
                                            
                                    </td>

                                    <td style="border: 1px solid #444; padding: 3px;">                                          
                                    <?php 
                                    $dataehora = $imprimedata['DataHoraImportacao'];
                                    $datasemhora = substr($dataehora, 0, 10);

                                    echo "$datasemhora"; 
                                    ?>
                                            
                                    </td>

                                    <td style="border: 1px solid #444; padding: 3px;">
                                    
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