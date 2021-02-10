<?php

require_once('includes/header.php');

?>
<!DOCTYPE html>
<html>
<head>
	<title>St-Marc | Inscription</title>
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
		<div id="signup_button"><a href="login.php">Connexion</a></div>
		
	</div>
	<div id="bar2">
		Inscription St-Marc<br><br>
		<form method="post" enctype="multipart/form-data">
		<input type="text" id="text" placeholder="Nom" name="nom"><br><br>
		<input type="text" id="text" placeholder="Prénom" name="prenom"><br><br>
		<span style="font-family: normal;">Sexe : </span><br>
		<select id="text" name="gern">
			<option>Homme</option>
			<option>Femme</option>
		</select><br><br>
		<input type="text" id="text" placeholder="Email" name="email"><br><br>
		<span style="font-family: normal;">Classe : </span><br>
		<select id="text" name="classe">
			<option>Terminale</option>
			<option>Première</option>
			<option>Seconde</option>
		</select><br><br>

		<input type="password" id="text" placeholder="Mot de passe" name="mdp"><br><br>
		<input type="password" id="text" placeholder="Confirmation mot de passe" name="cmdp"><br><br>
		<input type="text" id="text" placeholder="Description" name="description"><br><br>

		<input type="text" id="text" placeholder="Entrez votre snap" name="snap"><br><br>
		<input type="text" id="text" placeholder="Entrez votre insta" name="insta"><br><br>

		<span style="font-family: normal;">Photo de profil : </span><br>
		<input type="file" name="imgp"/><br><br>
		<span style="font-family: normal;">Bannière : </span><br>
		<input type="file" name="imgf"/><br><br>

		<input type="submit" id="button" value="S'inscrire" name="submit"><br><br><br>
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


if (isset($_POST['submit'])){
	$nom = $_POST['nom'];
	$prenom = $_POST['prenom'];
	$email = $_POST['email'];
	$gern=$_POST['gern'];
	$mdp = $_POST['mdp'];
	$cmdp = $_POST['cmdp'];
	$description = $_POST['description'];
	$classe = $_POST['classe'];
	$snap = $_POST['snap'];
	$insta = $_POST['insta'];

	if($nom&$prenom&$email&$gern&$mdp&$cmdp&$description){
		
		if($mdp == $cmdp){

			$db->query("INSERT INTO membres VALUES('', '$nom','$prenom','$email','$mdp','$gern','$description','$nom $prenom','$classe','$snap','$insta')");

			$imgp = $_FILES['imgp']['name'];
			$imgp_tmp = $_FILES['imgp']['tmp_name'];

			if(!empty($imgp_tmp)){
				$image = explode('.', $imgp);
				$image_ext = end($image);

				if (in_array(strtolower($image_ext),array('png','jpg','jpeg'))===false){

					echo "Veuillez rentrer une image ayant pour extention : png, jpg, jpeg.";
				}else{

					$image_size = getimagesize($imgp_tmp);
					if($image_size['mime']=='image/jpeg'){

						$image_src = imagecreatefromjpeg($imgp_tmp);
					}elseif($image_size['mime']=='image/png'){

						$image_src = imagecreatefrompng($imgp_tmp);
					}else{

						$image_src = false;
						echo "rentrer une image valide";

					}
					if($image_src!== false){

						$image_width=200;

						if($image_size[0]==$image_width){

							$image_final = $image_src;

						}else{

							$new_width[0]=$image_width;
							$new_height[1] = 200;

							$image_final = imagecreatetruecolor($new_width[0], $new_height[1]);

							imagecopyresampled($image_final,$image_src,0,0,0,0,$new_width[0],$new_height[1],$image_size[0],$image_size[1]);

						}

						imagejpeg($image_final,'img_profil/profile/'.$email.'.jpg');


					}
				}
			}else{

				echo "Veuillez rentrer une image ";
			}


			$imgf = $_FILES['imgf']['name'];
			$imgf_tmp = $_FILES['imgf']['tmp_name'];

			if(!empty($imgf_tmp)){
				$image1 = explode('.', $imgf);
				$image_ext1 = end($image1);

				if (in_array(strtolower($image_ext1),array('png','jpg','jpeg'))===false){

					echo "Veuillez rentrer une image ayant pour extention : png, jpg, jpeg.";
				}else{

					$image_size1 = getimagesize($imgf_tmp);
					if($image_size1['mime']=='image/jpeg'){

						$image_src1 = imagecreatefromjpeg($imgf_tmp);
					}elseif($image_size1['mime']=='image/png'){

						$image_src1 = imagecreatefrompng($imgf_tmp);
					}else{

						$image_src1 = false;
						echo "rentrer une image valide";

					}
					if($image_src1!== false){

						$image_width1=800;

						if($image_size1[0]==$image_width1){

							$image_final1 = $image_src1;

						}else{

							$new_width1[0]=$image_width1;
							$new_height1[1] = 300;

							$image_final1 = imagecreatetruecolor($new_width1[0], $new_height1[1]);

							imagecopyresampled($image_final1,$image_src1,0,0,0,0,$new_width1[0],$new_height1[1],$image_size1[0],$image_size1[1]);

						}

						imagejpeg($image_final1,'img_profil/fond/'.$email.'.jpg');


					}
				}
			}else{

				echo "Veuillez rentrer une image ";
			}


			header('Location: login.php');

		}else{
			echo "le mot de passe et la confirmation du mot de passe ne sont pas pareil";
		}
	}else{
		echo "Veillez remplir tous les champs";
	}
}
?>