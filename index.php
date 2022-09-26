
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cas_Arquivos</title>
	<link href="view/css/principal.css" rel="stylesheet">
	<style>
		body{
			background-image: url(img/fundo.png);
		}

	</style>
</head>
<body >

    
	<div class="login">
	<div>
	<form action="" method="post">
			<label> Usuario</label><br>
			<input type="text" name="user">

		<br><br>
			<label>Senha</label><br>
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