<?php

if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}

?>

<h1 id="titulo">USUÁRIOS CADASTRADOS</h1>

    <a href="<?php echo URLSISTEMA; ?>usuarios/index"> <button id="botaoacesso">Usuarios</button></a>

    <div class="tabelausuarios">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">NOME</th>
                <th scope="col">EMAIL</th>
                <th scope="col">OPÇÕES</th>

            </tr>
            </thead>
            <tbody>

            <?php
            $url = str_replace("Novo/", "", $_SERVER["REQUEST_URI"]);
            $explodeurl = explode("=", $url);

                            
            $usuariomodificado = $explodeurl[1];

            $usuariomodificado1 = str_replace("%20", " ", $usuariomodificado);

            $usuariomodificado2 = str_replace(".php", "", $usuariomodificado1);
            
            $usuariourl1 = str_replace("%27", " ", $usuariomodificado2);

            

            $usuariourl = substr($usuariourl1, 3, 20);

           
            ?>

                <?php foreach ($this->data['listarusuarios'] as $usuario) : ?>
            
                    <tr>
                    <td><?php echo $usuario['id'];?></td>
                    <td><?php echo $usuario['Nome'];?></td>
                    <td><?php echo $usuario['Email'];?></td>
                    <a href="<?php echo URLSISTEMA; ?>usuarios/index"> <button id="botaoacesso">Usuarios</button></a>
                    <td><a href="<?php echo URLSISTEMA; ?>editar-usuario/index/<?php echo $usuario['id']?>"> <button id="editar">Editar</button></a>          
                    <a href="<?php echo URLSISTEMA; ?>excluir-usuario/index/<?php echo $usuario['id']?>"> <button id="excluir">Excluir</button></a>
                    
                    
                    </td>    


                    </tr>
                <?php endforeach; ?>
            
            </tbody>
        </table>

            

    </div>