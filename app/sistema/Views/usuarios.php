<?php

if(isset($this->data['form'])) {
    $valorForm = $this->data['form'];
    
}


?>

        <br><br>
        <h2 style="text-align: center;">Adicionar Usuário</h2>
        <?php

        
        if(isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>  
        <span id="msg"></span>

        <div id="criarUsuario" >

            <form method="POST" action="" id="form-add-user">
        
    
                <?php 
                $Nome = "";
                if(isset($valorForm['Nome'])){
                    $name = $valorForm['Nome'];
                    }
                ?>
                <label>Nome: </label>
                <input type="text" name="Nome" id="Nome" placeholder="Digite o nome completo"
                value="<?php echo $Nome; ?>" required><br><br>

                <?php 
                $Email = "";
                
                if(isset($valorForm['Email'])){
                    $Email= $valorForm['Email'];
                }

                ?>
                <label>Email:</label>
                <input type="email" name="Email" id="email" placeholder="Digite o email"
                value="<?php echo $Email; ?>" required><br><br>

                
                <?php 
                $Senha = "";
                
                if(isset($valorForm['Senha'])){
                    $Senha= $valorForm['Senha'];
                }

                ?> 

                <label>Senha:</label>
                <input type="password" name="Senha" id="Senha" placeholder="Digite a senha"
                value="<?php echo $Senha; ?>" required><br><br>
            
            

                <button type="submit" name="Cadastrar" value="Cadastrar">Cadastrar usuário</button>

            </form>

        </div>

        <br>
        <br>

        <a href="<?php echo URLSISTEMA; ?>usuarios-cadastrados/index"> <button id="botaoacesso" >Ver usuários cadastrados</button></a>