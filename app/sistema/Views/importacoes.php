
<?php

if(isset($this->data['form'])) {
    
    $valorForm = $this->data['form'];
  
}

if(isset($this->data['form'][0])) {
    $valorForm = $this->data['form'][0];
    
}

?>
        <br><br>
        <p style="color: darkblue;"> <?php echo "Bem vindo " . $_SESSION['user_name']; ?> </p>
        <div id="titulodiv">

        <h3 id="titulosuperior" style="text-align: center;">Importar transações</h3> 
        
        </div>
        <?php
        if(isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>  
        <span id="msg"></span>
        

        <div class="container">

                                       
            <form action="" method="post" id="sendCSV" enctype="multipart/form-data">
                <div class="jumbotron" style = "border-style: solid;  border-color: black; background-color: rgba(161, 200, 218, 0.464);">
                <h2>Upload do CSV</h2>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="customFile" name="file">
                        <label class="custom-file-label" for="customFile"></label>
                    </div>
                
                    <button type="submit" class="enviar" name="SendCSV">Enviar</button>
            </form>
        </div>

      