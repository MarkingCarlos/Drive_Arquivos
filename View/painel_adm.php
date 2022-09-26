<?php
    include('segurity.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel adm</title>
    <link href="css/adm_page.css" rel="stylesheet">
    <style>
		body{
			background-image: url(../img/fundo.png);
		}

	</style>
</head>
<body>
    <div class="login">
        <div>
            <form action="" method="post">
                
                <label> Nome usuario</label><br>
                <input type="text" name="usuario">
            
                <br><br>
                <label>Senha</label><br>
                <input type="password" name="senha_user">
                
                <br><br>
                <button  type="submit" name="cadastrar">Cadastrar </button>
                <br><br>
                <button  type="submit" name="sair">Voltar a pagina de login</button>
                <?php
                    include('../Configuration\conexao.php');
                        if(isset($_POST['cadastrar'])){
                            if(isset($_POST['usuario'])|| isset($_POST['senha_user'])){
                                if(strlen($_POST['usuario']) == 0){
                                    echo "Digite  usuario";
                                }else if(strlen($_POST['senha_user']) == 0 ){
                                    echo "Digite senha";
                                }else{
                                $usuario = $mysqli->real_escape_string($_POST['usuario']);
                                $senha_user = $mysqli->real_escape_string($_POST['senha_user']);
                    
                    
                                $sql_code = "INSERT into usuario(usuario,senha_user)  values ('$usuario','$senha_user')";
                                $sql_query = $mysqli->query($sql_code) or die("Falha na execução: " . $mysqli->error);
                    
                                if($sql_query){
                                    echo "Usuario cadastrado com sucesso"; 
                                }
                                else{
                                    echo "Falha ao cadastrar usuario";   
                                    }   	
                                }
                            }
                        }
                        
                ?>
                    
                <?php
                    if(isset($_POST['sair'])){
                        include('logout.php'); 
                    }
                        
                ?>

                <a href="painel_cons.php">Consultar/Excluir</a>
                <a href="painel_arq.php">Adcionar arquivos</a>
                    
                
            </form>
        </div>           
    </div>
    

</body>
</html>