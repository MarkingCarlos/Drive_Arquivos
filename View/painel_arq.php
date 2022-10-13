<?php
include('../Configuration\conexao.php');
include('segurity.php');

$sql_cidade = "SELECT * FROM cidade";
$sql_query_cidade = $mysqli->query($sql_cidade) or die("Falha na execução: " . $mysqli->error);

if(isset($_POST['sair'])){
    header('Location: painel_adm.php');
}
if(isset($_POST['excluir'])){
    header('Location: painel_excluir.php');
}

if(isset($_FILES['arquivo'])){
    $arquivo = $_FILES['arquivo'];

    if($arquivo['error']){
        die("Erro ao enviar o arquivo");
    }
    $nome_arq = $arquivo['name'];
    $extensao = strtolower(pathinfo($nome_arq, PATHINFO_EXTENSION));
    $pasta = "arquivos/";
    $ano = $mysqli->real_escape_string($_POST['ano']);
    $cidade = $mysqli->real_escape_string($_POST['cidades']);
    $path = $pasta.$nome_arq;

    if($extensao != "pdf"){
        die("Extensão inválida");
    }

    if(move_uploaded_file($arquivo['tmp_name'], $pasta.$nome_arq)){
        if(!isset($_POST['ano'])){
            echo "Digite o ano";
        }
        else{
            $sql_code = "INSERT INTO arquivos (nome,ano,path_arq,cidade) VALUES ('$nome_arq','$ano','$path','$cidade')";
            $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
            if($sql_query){
                echo "Arquivo enviado com sucesso";
            }else{
                echo "Falha ao enviar arquivo";
            }
        }
        
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>arquivos</title>
    
    <style>
        *{
            margin: 0;
            padding: 0;
         
        }
        body{
			background-image: url(../img/fundo.png);
		}
        form{
            width: 350px;
          
        }
        .login{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            -webkit-box-shadow: -3px 0px 30px 0px rgba(50, 50, 50, 0.75);
            -moz-box-shadow:    -3px 0px 30px 0px rgba(50, 50, 50, 0.75);
            box-shadow:         -3px 0px 30px 0px rgba(50, 50, 50, 0.75);
            background-color: white;
            padding: 5%;
            border-radius: 5px;
        
        }
        #ano{
            border-radius: 5px;
            height: 20px;
            width: 30%;
        }
        .login label {
            margin-left: 5px;
            font-size: 1.2em;
        }

        .login h1 {
            text-align: center;
        }

        .login a {
           
           color: white;
            text-decoration: none;
            
        }
        label{
            font-family: 'Montserrat', sans-serif;
        }

        button:hover {
            background-color: deepskyblue;
        }
        a{
            padding-left: 45%;
            padding-right: 50%;
        }
        #btns button{
            background-color: #407BFF;
            width: 49%;
            height: 30px;
            border-radius: 5px;
            color:white;
            font-family: 'Open Sans', sans-serif;
            border: none;
            
        }
        #btns button:hover{
            background-color: #1E90FF;
        }
        #btns{
            text-align: left;
           
        }
        #select_cidade{
            margin-left: 70px;
        }

        #cidades{
            margin-left: 40px;
            border-radius: 5px;
            height: 20px;
            width: 30%;
        }
        #btn_enviar{
            background-color: #407BFF;
            width: 100%;
            height: 30px;
            border-radius: 5px;
            color:white;
            font-family: 'Open Sans', sans-serif;
            border: none;
        }
        #btn_enviar:hover{
            background-color: #1E90FF;
        }
       
    </style>    
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@1,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
</head> 
<body>
    <div class="login">
        
            <form method="post" enctype="multipart/form-data" action="" >
                <label for="">Selecionar arquivo</label><br>
                <input name="arquivo" type="file" >
                <br><br>
                <div id="inputs">
                    <span>Digite o ano</span>
                    <span id="select_cidade">Selecione a cidade</span>
                    <input type="number" name="ano" id="ano">
                    
                    <select name="cidades" id="cidades">
                        <option value="todas" >Todas</option>   
                        <?php while($row = $sql_query_cidade->fetch_assoc()){ ?>
                        <option  value="<?php echo $row['nome_cidade']; ?>"><?php echo $row['nome_cidade']; ?></option>
                        <?php } ?>
                    </select>  
                </div>  
                <br>   
                <button type="submit" name="enviar" id="btn_enviar">Enviar</button>
            </form>
            <br>
           <form action="" method="post" id="btns">
              
                <button type="submit" name="sair">Voltar</button>
                <button type="submit" name="excluir">Excluir</button>
            </form>
            
        
    </div>


</body>
</html>