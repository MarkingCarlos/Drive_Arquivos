

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cas_Arquivos</title>
    <style> 
    body{
        background-image: url(../img/fundo.png);

    }
    h1{
        font-family: 'Open Sans', sans-serif;
        text-align: center;
    }

    p{
        font-family: 'Montserrat', sans-serif;
        text-align: center;
    }
    *{
        margin: 0;
        padding: 0;
        
    }
    #btn_logar{
        font-family: 'Montserrat', sans-serif;
        background-color: white;
        border: none;
        width: 40%;
        height: 40px;
        background-color: #407BFF;
        position: absolute;
        top: 70%;
        left: 50%;
        transform: translate(-50%, -50%);
        color:white;
        border-radius: 7px;
        text-align: center;
    }
    
    .central{
        background-color: white;
        width: 30%;
        height: 200px;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        border-radius: 7px;
        -webkit-box-shadow: -3px 0px 30px 0px rgba(50, 50, 50, 0.75);
        -moz-box-shadow:    -3px 0px 30px 0px rgba(50, 50, 50, 0.75);
        box-shadow:         -3px 0px 30px 0px rgba(50, 50, 50, 0.75);
        
    }
    #txt{
        font-family: 'Montserrat', sans-serif;
        position: absolute;
        top: 10px;
        left: 35%;
       
    }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@1,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
</head>
<body >
    


    <div class="central">
    <br>
    <h1>Acesso negado</h1>
    <p>Não pode acessar essa pagina sem login</p>

	<a href=../index.php id="btn_logar" ><p id="txt">Logar</p></a>
    </div>
    <?php

    

    if(!isset($_SESSION['id_adm'])){
        
        if(isset($_POST['Logar'])){
            header("Location: ../index.php");
        }
        die("");
        
    }
    
?>

</body>
</html>