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
    <link href="css/cons_pages.css" rel="stylesheet">
</head>
<body>

<div class="Center_tabela">
    <div>
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
</div>

    <div class="excluir">
        <h1>Excluir</h1>
        <form action="" method="post" >

            <label>Indentificação</label><br>
            <input type="number" name="id">
            <br><br>
            <button class="btn-16" type="submit">Excluir</button>
            <button class="btn-16"><a href="painel_adm.php">Voltar</a></button>
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
    <br>
    
</body>
</html>