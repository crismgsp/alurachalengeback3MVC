<?php

if(isset($this->data['form'])) {
    
    $valorForm = $this->data['form'];
  
}

if(isset($this->data['form'][0])) {
    $valorForm = $this->data['form'][0];
    
}

?>

        <h1>Editar Usuário</h1>
        <?php

               
        if(isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>  
        <span id="msg"></span>

        <form method="POST" action="" id="form-edit-user">
        <?php 
            $id = "";
            if(isset($valorForm['id'])){
                $id = $valorForm['id'];
                }
            ?>
            
            <input type="hidden" name="id" id="id" 
            value="<?php echo $id; ?>" ><br>
                        
            
            <?php 
            $Nome = "";
            if(isset($valorForm['Nome'])){
                $name = $valorForm['Nome'];
                }
            ?>
            <label>Nome:</label>
            <input type="text" name="Nome" id="Nome" placeholder="Digite o nome completo"
            value="<?php echo $name; ?>" required><br><br>

           
            <?php 
            $Email = "";
            
            if(isset($valorForm['Email'])){
                $email= $valorForm['Email'];
            }

            ?>
            <label>Email:</label>
            <input type="email" name="Email" id="Email" placeholder="Digite o email"
            value="<?php echo $email; ?>" required><br><br>
                       
            <button type="submit" name="SendEditUser" value="Salvar">Salvar</button>

        </form>