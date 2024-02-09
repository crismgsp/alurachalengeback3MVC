
  
        
            <p id="bemvindo"> Sistema de Importações de Transações financeiras</p>
            
              
        
        <br>
        <?php
        if(isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>  
        <span id="msg" style="text-align: center;"></span>
        <br>

        <div id="acesso" >
            

            <br><br>

            <form method="POST" action="" id="form-login">
                <?php 
                $email = "";
                $Senha= "";
                if(isset($valorForm['email'])){
                    $user = $valorForm['email'];
                    }
                 if(isset($valorForm['Senha'])){
                    $Senha= $valorForm['Senha'];
                }
            
                ?>
                <label>Usuário: </label>
                <input type="email" name="email" id="email" placeholder="Digite o email"
                value="<?php echo $email; ?>"><br><br>
            
                  
                <label>Senha: </label>
                <input type="password" name="Senha" id="Senha" placeholder="Digite a senha" autocomplete="on"
                value="<?php echo $Senha; ?>"><br><br>
            
                <button type="submit" name="SendLogin" value="Acessar">Acessar</button>
            
            </form>    

     
        </div>
               

    