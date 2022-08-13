<?php
include('../Configuration\conexao.php');
include('segurity.php');


if(isset($_FILES['arquivo'])){
    $arquivo = $_FILES['arquivo'];

    if($arquivo['error']){
        die("Erro ao enviar o arquivo");
    }
    $nome_arq = $arquivo['name'];
    $extensao = strtolower(pathinfo($nome_arq, PATHINFO_EXTENSION));
    $pasta = "arquivos/";
    $ano = $mysqli->real_escape_string($_POST['ano']);
    $path = $pasta.$nome_arq;

    if($extensao != "pdf"){
        die("Extensão inválida");
    }

    if(move_uploaded_file($arquivo['tmp_name'], $pasta.$nome_arq)){
        if(!isset($_POST['ano'])){
            echo "Digite o ano";
        }
        else{
            $sql_code = "INSERT INTO arquivos (nome,ano,path_arq) VALUES ('$nome_arq','$ano','$path')";
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
    <link href="css/adm_page.css" rel="stylesheet">
</head> 
<body>
    <div class="login">
        <div>
            <form method="post" enctype="multipart/form-data" action="" >
                <label for="">Selecionar arquivo</label><br>
                <input name="arquivo" type="file">
                <br><br>
                <label>Digite o ano:</label><br>
                <input type="number" name="ano">
                <br><br>
                <button type="submit" >Enviar</button>
            </form>
            <br>    
            <button><a href="painel_adm.php">Voltar</a></button>
        </div>
    </div>


</body>
</html>