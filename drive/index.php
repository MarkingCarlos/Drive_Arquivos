
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cas_Arquivos</title>
	
	<style>
		body{
			background-image: url(img/fundo.png);
		}
		.login {
			padding: 3em;
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
			width: 20%;



		}
		.login form{
			
			width: 80%;
			margin-left: 30px;
		}
		span{
			font-family: 'Montserrat', sans-serif;

		}
		input{
			font-family: 'Montserrat', sans-serif;
			width: 90%;
			padding: 10px;
    		border-radius: 10px;
    		outline: none;
		}
		h1{
			text-align: center;
			font-family: 'Open Sans', sans-serif;
		}
		button {
		background-color: dodgerblue;
		border: none;
		color: white;
		width: 100%;
		height: 45px;
		border-radius: 10px;
		}
		.op{
			width: 10%;
		}
		
		
		
	</style>
	
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@1,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">

</head>
<body >

    
	<div class="login">
	<div>
	<form action="" method="post">
			<h1>LOGIN</h1>
			
			<span> Usuario</span><br>
			<input type="text" name="user">

		<br><br>
			<span>Senha</span><br>
			<input type="password" name="senha">
		<br><br>
			<input class="op" type="radio" name="adm_btn" value="adm" >Administrador
			
			<input  class="op" type="radio" name="user_btn" value="user" >Usuario
			<br><br>
			<button type="submit" name="entrar">Entrar</button>
			<?php
			include('Configuration\conexao.php');
			if(isset($_POST['entrar'])){
				if(isset($_POST['adm_btn'])){
					if(isset($_POST['user'])|| isset($_POST['senha'])){

						if(strlen($_POST['user']) == 0){
							echo "Digite seu usuario";
						}else if(strlen($_POST['senha']) == 0 ){
							echo "Digite sua senha";
						} else{

						$user = $mysqli->real_escape_string($_POST['user']);
						$senha = $mysqli->real_escape_string($_POST['senha']);
						$senha = md5($senha);
						$sql_code = "SELECT * from adm where user_adm = '$user' and senha_adm = '$senha'";
						$sql_query = $mysqli->query($sql_code) or die("Falha na execução: " . $mysqli->error);

						$quant = $sql_query->num_rows;

						if($quant == 1){
							$usuario = $sql_query->fetch_assoc();

							if(!isset($_SESSION)){
								session_start();
							}

							$_SESSION['id_adm'] = $usuario['id_adm'];

							header("Location: View/painel_adm.php");

							}else{
								echo "Usuario ou senha incorretos";
							}

						}
					}
				}else if(isset($_POST['user_btn'])){
					if(isset($_POST['user'])|| isset($_POST['senha'])){

						if(strlen($_POST['user']) == 0){
							echo "Digite seu usuario";
						}else if(strlen($_POST['senha']) == 0 ){
							echo "Digite sua senha";
						} else{
	
						$user = $mysqli->real_escape_string($_POST['user']);
						$senha = $mysqli->real_escape_string($_POST['senha']);
						$senha = md5($senha);
						$sql_code = "SELECT * from usuario where usuario = '$user' and senha_user = '$senha'";
						$sql_query = $mysqli->query($sql_code) or die("Falha na execução: " . $mysqli->error);
	
						$quant = $sql_query->num_rows;
	
						if($quant == 1){
							$usuario = $sql_query->fetch_assoc();
	
							if(!isset($_SESSION)){
								session_start();
							}
	
							$_SESSION['id_adm'] = $usuario['id_usser'];
	
							header("Location: View/painel.php");
	
						}else{
							echo "Usuario ou senha incorretos";
						}
	
						}
					}
				}
				
			}
				
		
			?>
		<br>
	</form>
	</div>
	</div>

</body>
</html>