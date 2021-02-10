<?php

require_once('includes/header.php');

?>
<!DOCTYPE html>
<html>
<head>
	<title>St-Marc | Connexion</title>
	<meta charset="utf-8">
</head>
<style>
	body{
		font-family: tahoma;
		background-color: #e9ebee;
	}

	#bar{
		height: 100px;
		background-color: rgb(59,89,152); 
		color: #d9dfeb;
		padding: 4px; 	
	}
	a{
		text-decoration: none;
		color: #d9dfeb;
	}

	#signup_button{
		background-color: #42b72a;
		width: 70px;
		text-align: center;
		padding: 4px;
		border-radius: 4px;
		float: right;
	}

	#bar2{
		background-color: white; 
		width: 800px; 
		margin: auto; 
		margin-top: 50px;
		padding: 10px;
		padding-top: 50px;
		text-align: center;
		font-weight: bold;
	}

	#text{
		height: 40px;
		width: 300px;
		border-radius: 4px;
		border:solid 1px #ccc;
		padding: 4px;
		font-size : 14px;
	}

	#button{
		width: 300px;
		height: 40px;
		border-radius: 4px;
		font-weight: bold;
		border:none;
		background-color: rgb(59,89,152); 
		color: white;

	}

</style>
<body>
	<div id="bar">
		<div style="font-size: 40px;">St-Marc</div>
		<div id="signup_button"><a href="signup.php">Inscription</a></div>
	</div>
	<div id="bar2">
		Connexion St-Marc<br><br>
		<form method="post">
		<input type="text" id="text" placeholder="Email" name="email"><br><br>
		<input type="password" id="text" placeholder="Mot de passe" name="mdp"><br><br>
		<input type="submit" id="button" value="Se connecter" name="submit"><br><br><br>
		</form>
	</div>
</body>
</html>

<?php
try
{
	$db = new PDO('mysql:host=localhost;dbname=socialsite', 'root','');
	$db->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
	$db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
}
catch(Exception $e){
	echo "une erreur est survenue";
	die();
}

if(!isset($_SESSION["user_id"])){

	if (isset($_POST['submit'])) {
		$email = $_POST['email'];
		$password = $_POST['mdp'];

		if($email&&$password){

				$select = $db->query("SELECT id FROM membres WHERE email='$email'");
				if($select->fetchColumn()){
					$select = $db->query("SELECT * FROM membres WHERE email='$email'");
					$result = $select->fetch(PDO::FETCH_OBJ);
					if ($result->mdp == $password){
						$_SESSION['user_id'] = $result->id;
						$_SESSION['user_nom'] = $result->nom;
						$_SESSION['user_prenom'] = $result->prenom;
						$_SESSION['user_email'] = $result->email;
						$_SESSION['user_mdp'] = $result->mdp;
						header('Location: profile.php');
						$user_id = $_SESSION['user_id'];
						echo "$user_id";
						header('Location: profile.php');
					}else{
						echo "Mauvais mot de passe";
					}
				}else{

					echo "Mauvais email";

				}

		}else{
			echo "Veuilez remplir tout les champs";
		}
		
	}
}
	?>