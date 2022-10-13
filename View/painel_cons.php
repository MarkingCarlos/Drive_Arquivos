<?php 
include('../Configuration\conexao.php');
    $sql = "SELECT * FROM usuario";

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
            position: absolute;
            top: 40%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        .tabela{
            background-color: white;
            border-collapse: collapse; 
            width: 50%;
            border: 1px solid black;
           
        }
        h1{
            font-family: 'Open Sans', sans-serif;
          
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
        
        a{
            text-decoration: none;
            color: white;
        }

        #inp{
            position: absolute;
            top: 2%;
        }
        .excluir span{
            font-family: 'Montserrat', sans-serif;
            color: black;
        }
        #inp{
            margin-left: 32%;
           
        }
        .excluir{
            width: 100%;
        }
        .excluir input{
           border-radius: 7px;  
        }
        .excluir button{
            background-color: #407BFF;
            width: 90px;
            height: 20px;
            border-radius: 5px;
            color:white;
            font-family: 'Open Sans', sans-serif;
            border: none;
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@1,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
</head>
<body>

    <div class="excluir">
        <form action="" method="post" >
            <div id="inp">
                <span>Digite o ID para excluir:</span>
                <input type="txt" name="id">
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
                            $sql_code = "DELETE FROM usuario WHERE id_usser = '$id'";

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

    <div class="Center_tabela">
        <table class="tabela">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Senha</th>
            </tr>
            <?php while($row = $result->fetch_assoc()){ ?>
                <tr>
                    <td><?php echo $row['id_usser']; ?></td>
                    <td><?php echo $row['usuario']; ?></td>
                    <td><?php echo $row['senha_user']; ?></td>
                </tr>
            <?php } ?>
        </table>       
    </div>

    
            
            
        
	    

    
    
</body>
</html>