<?php 
include('../Configuration\conexao.php');
include('segurity.php');
    $sql = "SELECT * FROM arquivos";

    $result = $mysqli->query($sql);

    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta</title>
    <style>
        *{
            margin: 0;
            padding: 0;
         
        }
        body{
			background-image: url(../img/fundo.png);
		}
        .Center_tabela{
            width: 50vw;
            margin-top: 10%;
            margin-left: 25%; 
            
            
        }
      
        .tabela{
            background-color: white;
            border-collapse: collapse; 
            width: 80%;
            border: 1px solid black;
            margin-left: 10%;
           
        }
        h1{
            font-family: 'Open Sans', sans-serif;
          
        }

        .excluir label{
            font-family: 'Open Sans', sans-serif;
            
            color: black;
        }
       
        .tabela th {
        border: 1px solid black;
        background-color: #f2f2f2;
        text-align: center;
        padding: 10px;
        font-family: 'Open Sans', sans-serif;
        }

        .tabela td {
            text-align: center;
            border: 1px solid black;
            font-family: 'Montserrat', sans-serif;
            padding: 10px;
        }
        .excluir button {
            background-color: #407BFF;
            width: 80px;
            height: 25px;
            border-radius: 5px;
            color: white;
            border: none;

        }

        #inp{
            
            margin-left: 30%;
        }

       
        a{
            text-decoration: none;
            color: white;
        }

    
        #inp{
            position: absolute;
            top: 2%;
        }

        span{
            font-family: 'Montserrat', sans-serif;
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@1,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
</head>
<body>

    <div class="Center_tabela">
        <table class="tabela">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Ano</th>
            </tr>
            <?php while($row = $result->fetch_assoc()){ ?>
                <tr>
                    <td><?php echo $row['id_arq']; ?></td>
                    <td><?php echo $row['Nome']; ?></td>
                    <td><?php echo $row['ano']; ?></td>
                </tr>
            <?php } ?>
        </table>       
    </div>

    <div class="excluir">
        <form action="" method="post" >
            <div id="inp">
                <span>Digite o ID para excluir:</span>
                <input type="number" name="id">
                <button  type="submit">Excluir</button>
                <button><a href="painel_adm.php">Voltar</a></button>
            </div>
            
            <?php
                include('../Configuration\conexao.php');
                    if(isset($_POST['id'])){
                        
                            if(strlen($_POST['id']) == 0){
                                echo "Digite o id para exclusão";
                            }else{
                            $id = $mysqli->real_escape_string($_POST['id']);
                            $sql_code = "DELETE FROM arquivos WHERE id_arq = '$id'";

                            $sql_query = $mysqli->query($sql_code) or die("Falha na execução: " . $mysqli->error);
                
                            if($sql_query){
                                echo "Excluido com sucesso"; 
                            }
                            else{
                                echo "Falha na exclusão";   
                                }   	
                            }
                        
                    }
                    
            ?>
        
	    </form>
    </div>
    <br>
    
</body>
</html>