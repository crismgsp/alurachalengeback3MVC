<?php

if(isset($this->data['form'])) {
    
    $valorForm = $this->data['form'];
  
}

if(isset($this->data['form'][0])) {
    $valorForm = $this->data['form'][0];
    
}

?>

        <h1>Excluir Usuário</h1>
        <?php

               
        if(isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>  
        <span id="msg"></span>

    <br>
    <br>

    <form method="POST" action="" id="form-edit-user">
        <?php 
            $id = "";
            if(isset($valorForm['id'])){
                $id = $valorForm['id'];
                }
            ?>
            
            <input type="hidden" name="id" id="id" 
            value="<?php echo $id; ?>" ><br>
    
    <button type="submit" name="Exclusaologica" value="Exclusaologica">Confirmar exclusão</button>