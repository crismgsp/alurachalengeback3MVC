<table class="table" >
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
                <th scope="col">Usuário responsável</th>


            </tr>
        </thead>
        <tbody>
            <?php foreach ($this->data['listImportacoes'] as $imprimirdados) : ?>
                <tr>
                    <td><?php echo $imprimirdados['BancoOrigem']; ?></td>
                    <td><?php echo $imprimirdados['AgenciaOrigem']; ?></td>
                    <td><?php echo $imprimirdados['ContaOrigem']; ?></td>
                    <td><?php echo $imprimirdados['BancoDestino']; ?></td>
                    <td><?php echo $imprimirdados['AgenciaDestino']; ?></td>
                    <td><?php echo $imprimirdados['ContaDestino']; ?></td>
                    <td><?php echo $imprimirdados['Valor']; ?></td>
                    <td><?php echo $imprimirdados['DataeHora']; ?></td>
                    <td><?php echo $imprimirdados['DataHoraImportacao']; ?></td>
                    <td><?php echo $imprimirdados['Usuario']; ?></td>

                </tr>
            <?php endforeach; ?> 
        </tbody>
    </table>

  
    <a href="<?php echo URLSISTEMA; ?>importacoes-feitas/index"><button>Voltar para importações feitas</button></a>
    