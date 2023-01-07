<?php
    include('segurity.php');
    include('../Configuration/conexao.php');

    if(isset($_POST['Sair'])){
        header('Location: logout.php');
    }
    $cidade_user = "SELECT cidade from usuario where id_usser = ".$_SESSION['id_adm'];
    $sql_code = "SELECT * FROM arquivos where cidade = ($cidade_user)";
    $sql_query = $mysqli->query($sql_code) or die("Falha na execução: " . $mysqli->error);
    $sql_cidade = "SELECT * FROM cidade";
    $sql_query_cidade = $mysqli->query($sql_cidade) or die("Falha na execução: " . $mysqli->error);

 
    


    if(isset($_POST['cidades'])){
        $cidade = $mysqli->real_escape_string($_POST['cidades']);
        if(isset($_POST['date']) && $_POST['date'] != '' && $_POST['nome'] ==''){
            $date = $mysqli->real_escape_string($_POST['date']);
            if($cidade == "Todas"){
                $sql_code = "SELECT * FROM arquivos WHERE ano = '$date' and cidade = ($cidade_user)";
                $sql_query = $mysqli->query($sql_code) or die("Falha na execução: " . $mysqli->error);

            }
            else{
                $sql_code = "SELECT * FROM arquivos where ano = '$date' and cidade = '$cidade' and cidade = ($cidade_user)";
                
                $sql_query = $mysqli->query($sql_code) or die("Falha na execução: " . $mysqli->error);
            }
        }else if(isset($_POST['nome']) && $_POST['nome'] != ''){
            $nome = $mysqli->real_escape_string($_POST['nome']);
            if($cidade == "Todas" && $_POST['date'] == ''){
                $sql_code = "SELECT * FROM arquivos WHERE nome LIKE '%$nome%' and cidade = ($cidade_user)";
                $sql_query = $mysqli->query($sql_code) or die("Falha na execução: " . $mysqli->error);
            }
            else if($cidade == "Todas" && $_POST['date'] != ''){
                $date = $mysqli->real_escape_string($_POST['date']);
                $sql_code = "SELECT * FROM arquivos WHERE nome LIKE '%$nome%' and ano = '$date' and cidade = ($cidade_user)";
                $sql_query = $mysqli->query($sql_code) or die("Falha na execução: " . $mysqli->error);
            }
            else if($cidade != "Todas" && $_POST['date'] != ''){
                $date = $mysqli->real_escape_string($_POST['date']);
                $sql_code = "SELECT * FROM arquivos where nome LIKE '%$nome%' and cidade = '$cidade' and ano = '$date'";
                $sql_query = $mysqli->query($sql_code) or die("Falha na execução: " . $mysqli->error);
            }
            else if($cidade != "Todas" && $_POST['date'] == ''){
                $sql_code = "SELECT * FROM arquivos where nome LIKE '%$nome%' and cidade = '$cidade'";
                $sql_query = $mysqli->query($sql_code) or die("Falha na execução: " . $mysqli->error);
            }
        }
        
        else{
            if($cidade == "Todas"){
                $sql_code = "SELECT * FROM arquivos where cidade = ($cidade_user)";
                $sql_query = $mysqli->query($sql_code) or die("Falha na execução: " . $mysqli->error);
            }else{    
                $sql_code = "SELECT * FROM arquivos where cidade = '$cidade' and cidade = ($cidade_user)";
                $sql_query = $mysqli->query($sql_code) or die("Falha na execução: " . $mysqli->error);
            }
        }
        if($sql_query->num_rows == 0){
            echo "<script>alert('Nenhum arquivo encontrado!')</script>";
            $sql_code = "SELECT * FROM arquivos where cidade = ($cidade_user)";
            $sql_query = $mysqli->query($sql_code) or die("Falha na execução: " . $mysqli->error);

        }
    }


    /*if(isset($_POST['cidades']) && isset($_POST['date'])){
        $cidade = $mysqli->real_escape_string($_POST['cidades']);
        if($cidade == "Todas"){
            $sql_code = "SELECT * FROM arquivos where ano = '$date'";
            $sql_query = $mysqli->query($sql_code) or die("Falha na execução: " . $mysqli->error);
        }else{    
            $sql_code = "SELECT * FROM arquivos where cidade like '$cidade' and ano = '$date'";
            $sql_query = $mysqli->query($sql_code) or die("Falha na execução: " . $mysqli->error);
        }
    }*/
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel</title>
    <style>
        body{
			background-image: url(../img/fundo.png);
		}

    
        span{
            font-family: 'Montserrat', sans-serif;
        }

       
        td{
            border-bottom: 1px solid black;
            color: black;
            text-align: center;
            padding: 0.3em;           
        }
        th{
            
            border-bottom: 1px solid black;
            
            color: black;
            text-align: center;
            padding: 0.3em;
            
        }
        #tabela{
            width: 50vw;
            background-color: white;
            
           
      
        }
        #tabela a{
            text-decoration: none;
            color: black;
            font-family: 'Montserrat', sans-serif;
            
        }
       
        
        #btn_sair{
            background-color: #407BFF;
            width: 100px;
            height: 30px;
            border-radius: 5px;
            color:white;
            font-family: 'Open Sans', sans-serif;
            border: none;
        }

        #form_sair{
            
            position: sticky;
            width: 100px;

        }
        #cidades{
            font-family: 'Montserrat', sans-serif;
            border-radius: 5px;
        }
        #btn_pesquisa{
            background-color: #407BFF;
            width: 100px;
            height: 30px;
            border-radius: 5px;
            color: white;
            border: none;
           
        }
        .conteiner{
            width: 50vw;
            margin-top: 3%;
            margin-left: 20%;   
            padding: 2em;
            background-color: white;
            -webkit-box-shadow: -3px 0px 30px 0px rgba(50, 50, 50, 0.75);
            -moz-box-shadow:    -3px 0px 30px 0px rgba(50, 50, 50, 0.75);
            box-shadow:         -3px 0px 30px 0px rgba(50, 50, 50, 0.75);
           border-radius: 7px;
             
        }
        .cont_form{
            margin-top: 10px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;  
        }
        #data{
            width: 10%;
         
         
        }
        
        
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@1,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
</head>
<body>
    <form action=""  enctype="multipart/form-data" method="post" id="form_sair">
        <button type="submit" id="btn_sair" name="Sair">Sair</button>
    </form>  
    <div class="cont_form">
        <form action=""  enctype="multipart/form-data" method="post" id="form">
            <span>Nome:</span>
            <input type="txt" name="nome">
            <span>Ano:</span>
            <input type="txt" name="date" id="data">
            <span>Cidade:</span>
            <select name="cidades" id="cidades">
                <option value="Todas" >Todas</option>   
                <?php while($row = $sql_query_cidade->fetch_assoc()){ ?>
                <option value="<?php echo $row['nome_cidade']; ?>"><?php echo $row['nome_cidade']; ?></option>
                <?php } ?>
            </select>
           
            <button type="submit" id="btn_pesquisa">Pesquisar</button>
        </form>
    </div>
    <div class="conteiner">
        <div id="aa">
            <table  id="tabela">
                <tr>
                    <th>Nome</th>
                    
                    <th>Ano</th>

                    <th>Cidade</th>
                </tr>
                <?php while($row = $sql_query->fetch_assoc()){ ?>
                <tr>
                    <td id="arq"><a  target="_blank" href="<?php echo $row['path_arq']; ?>"><?php echo $row['Nome']; ?> </td>
                    
                    <td><?php echo $row['ano']; ?></td>

                    <td><?php echo $row['cidade']; ?></td>
                    
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>
    

      
        
        
</body>
</html>