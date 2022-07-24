
  
        <div id="cabecalho">
            <h1 id="bemvindo" style="text-align: center;"> Bem vindo ao Sistema de Importações de Transações financeiras</h1>
            
              
        </div>
        <br>
        <?php
        if(isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>  
        <span id="msg" style="text-align: center;"></span>
        <br>

        <div id="acesso" style="width: 40vw; background-color: rgba(112, 128, 122, 0.284);padding: 5vw; padding-left: 10vw;margin-left: 20vw;">
            <p>Para fazer importações e acessar os usuários cadastrados faça seu login  </p>

            <br><br>

            <form method="POST" action="" id="form-login">
                <?php 
                $email = "";
                $senha = "";
                if(isset($valorForm['email'])){
                    $user = $valorForm['email'];
                    }
                 if(isset($valorForm['senha'])){
                    $password= $valorForm['senha'];
                }
            
                ?>
                <label>Usuário: </label>
                <input type="email" name="email" id="email" placeholder="Digite o email"
                value="<?php echo $email; ?>"><br><br>
            
                  
                <label>Senha: </label>
                <input type="password" name="password" id="senha" placeholder="Digite a senha" autocomplete="on"
                value="<?php echo $senha; ?>"><br><br>
            
                <button type="submit" name="SendLogin" value="Acessar">Acessar</button>
            
            </form>    

     
        </div>
               

    