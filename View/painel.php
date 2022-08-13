<?php
    include('segurity.php');
    include('../Configuration/conexao.php');

    if(isset($_POST['date'])){
        $date = $mysqli->real_escape_string($_POST['date']);
        $sql_code = "SELECT * FROM arquivos where ano = '$date'";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução: " . $mysqli->error);
    }else{
        $sql_code = "SELECT * FROM arquivos";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução: " . $mysqli->error);
    }
    

    
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel</title>
</head>
<body>
    
    <label>Ano</label><br>  
    <form action=""  enctype="multipart/form-data" method="post">
        <input type="number" name="date">
        <button type="submit">Pesquisar</button>
    </form>
    <table border="1" cellpaddinf="10">
        <tr>
            <th>Nome</th>
            
            <th>Ano</th>
        </tr>
        <?php while($row = $sql_query->fetch_assoc()){ ?>
        <tr>
            <td><a  target="_blank" href="<?php echo $row['path_arq']; ?>"><?php echo $row['Nome']; ?> </td>
            
            <td><?php echo $row['ano']; ?></td>
            
        </tr>
        <?php } ?>
    <p>
        <a href="logout.php">Sair </a>
    </p>
</body>
</html>