<?php
    include('segurity.php');
    include('../Configuration/conexao.php');
    $sql_cidade = "SELECT * FROM cidade";
    $sql_query_cidade = $mysqli->query($sql_cidade) or die("Falha na execução: " . $mysqli->error);
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
        .login {
            padding: 4em;
            padding-bottom: 3em;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            border-radius: 10px;
            background-color: white;
            -webkit-box-shadow: -3px 0px 30px 0px rgba(50, 50, 50, 0.75);
            -moz-box-shadow:    -3px 0px 30px 0px rgba(50, 50, 50, 0.75);
            box-shadow:         -3px 0px 30px 0px rgba(50, 50, 50, 0.75);
        }
        span{
            font-family: 'Open Sans', sans-serif;
            margin-top: 50px;
        }
        a{
            text-decoration: none;
            color: black;
        }
        .login input {
            
            border-radius: 10px;
            outline: none;
            width: 42%;
            height: 26px;
            
            
        }
        #senha{
            margin-left: 65px;
        }
        #inp_senha{
            margin-left: 10px;
        }
        #inputs{
            margin-left: 10px;
            margin-bottom: 10px;;
        }
        #inp_cidade{
            margin-left: 90px;
            width: 100%;
        }
        #cidades{
            border-radius: 7px;
            border: 1px solid black;
            width: 30%;
            height: 22px;
        }
      

	</style>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@1,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
</head>
<body>
    <div class="login">
        <div>
            <form action="" method="post">
                <div id="inputs">
                    <span> Nome usuario</span>
                    <span id="senha">Senha</span><br>
                    <input type="text" name="usuario">
                    <input type="password" name="senha_user" id="inp_senha"><br><br>
                
                    <span> Cidade:</span><br>
                    <select name="cidades" id="cidades">
                        <option value="todas" >Todas</option>   
                        <?php while($row = $sql_query_cidade->fetch_assoc()){ ?>
                        <option  value="<?php echo $row['nome_cidade']; ?>"><?php echo $row['nome_cidade']; ?></option>
                        <?php } ?>
                    </select> 
                    
                  
                </div>
                <button  type="submit" name="cadastrar">Cadastrar </button>
                <br><br>
                <button  type="submit" name="sair">Voltar a pagina de login</button>
                <?php
                    include('../Configuration\conexao.php');
                        if(isset($_POST['cadastrar'])){
                            if(isset($_POST['usuario']) || isset($_POST['senha_user']) || isset($_POST['cidades'])){

                                if(strlen($_POST['usuario']) == 0){
                                    if(strlen($_POST['cidade']) == 0){
                                         echo "<script>alert('Preencha o campo usuario')</script>";
                                    }       
                                }else if(strlen($_POST['senha_user']) == 0 ){
                                    if(strlen($_POST['cidade']) == 0){
                                        echo "<script>alert('Preencha o campo Senha')</script>";
                                   }      
                                }else if(strlen($_POST['cidades']) == 0){
                                    if(strlen($_POST['cidade']) == 0){
                                        echo "<script>alert('Preencha o campo Cidade')</script>";
                                   }
                                }
                                else{
                                $usuario = $mysqli->real_escape_string($_POST['usuario']);
                                $senha_user = $mysqli->real_escape_string($_POST['senha_user']);
                                $cidade = $mysqli->real_escape_string($_POST['cidades']);
                    
                                $sql_code = "INSERT into usuario(usuario,senha_user,cidade)  values ('$usuario','$senha_user','$cidade')";
                                $sql_query = $mysqli->query($sql_code) or die("Falha na execução: " . $mysqli->error);
                    
                                if($sql_query){
                                    echo "Usuario cadastrado com sucesso"; 
                                }
                                else{
                                    echo "Falha ao cadastrar usuario";   
                                    }   	
                                }
                            }
                            /*if(isset($_POST['cidade'])){
                                if(strlen($_POST['cidade']) == 0){
                                    if(strlen($_POST['usuario']) == 0){
                                        echo "<script>alert('Preencha algum campo')</script>";
                                   }   
                                    
                                }else{
                                    $cidade = $mysqli->real_escape_string($_POST['cidade']);
                                    $sql_code = "INSERT into cidade(nome_cidade)  values ('$cidade')";
                                    $sql_query = $mysqli->query($sql_code) or die("Falha na execução: " . $mysqli->error);
                    
                                    if($sql_query){
                                        echo "Cidade cadastrada com sucesso"; 
                                    }
                                    else{
                                        echo "Falha ao cadastrar cidade";   
                                        }   	
                                    }
                                }*/
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