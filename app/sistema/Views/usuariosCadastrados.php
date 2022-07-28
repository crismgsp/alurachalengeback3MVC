<?php

if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}

?>

<br>

<h2 id="titulo" style="text-align:center;">USUÁRIOS CADASTRADOS</h2>



    

    <div class="tabelausuarios" style="padding: 5vw;">
        <table class="table" style="border: 1px solid darkgreen">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">NOME</th>
                <th scope="col">EMAIL</th>
                <th scope="col">OPÇÕES</th>

            </tr>
            </thead>
            <tbody>

            

                <?php foreach ($this->data['listarusuarios'] as $usuario) : ?>
            
                    <tr>
                    <td><?php echo $usuario['id'];?></td>
                    <td><?php echo $usuario['Nome'];?></td>
                    <td><?php echo $usuario['Email'];?></td>
                    
                    <td><a href="<?php echo URLSISTEMA; ?>editar-usuario/index/<?php echo $usuario['id']?>"> <button id="editar">Editar</button></a>          
                    <a href="<?php echo URLSISTEMA; ?>excluir-usuario/index/<?php echo $usuario['id']?>"> <button id="excluir">Excluir</button></a>
                    
                    
                    </td>    


                    </tr>
                <?php endforeach; ?>
            
            </tbody>
        </table>

            

    </div>