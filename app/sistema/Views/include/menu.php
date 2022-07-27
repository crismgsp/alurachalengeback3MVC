<header>
    <?php 
        
    $Nome = $_SESSION['Nome'];
             
    ?>                               
        <div class="menu">
            <a href="<?php echo URLSISTEMA; ?>importacoes-feitas/index"> <button id="botaoacesso">Importacoes feitas</button></a>

            <a href="<?php echo URLSISTEMA; ?>usuarios/index"> <button id="botaoacesso">Usuarios</button></a>

            <a href="<?php echo URLSISTEMA; ?>analise-transacoes/index"> <button id="botaoacesso">Transações suspeitas</button></a>

            <a href="<?php echo URLSISTEMA; ?>importacoes/index"> <button id="botaoacesso">Fazer importações</button></a>

            <a href="<?php echo URLSISTEMA; ?>logout/index"><button class="logout">Logout</button></a>

        </div>  

  	
		
</header>	

