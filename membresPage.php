<?php

require_once('includes/header.php');

?>
<!DOCTYPE html>
<html>
<head>
	<title>Profil | St-Marc</title>
	<meta charset="utf-8">
</head>
<style type="text/css">
	#blue_bar{
		height: 50px;
		background-color: #405d9b;
		color: #d9dfeb;
	}

	#profile_pic{
		width: 150px;
		margin-top: -200px;
		border-radius: 50%;
		border: solid 2px white;
	}


	div nav{
	  width: 100%;
	  top:50px;
	  text-align:center;
	  padding-bottom: 15px; 
	}
	div nav a{
	  font-family: 'tahoma';
	  color: #405d9b;
	  font-weight:500;
	  text-transform:uppercase;
	  text-decoration:none;;
	  margin:0 15px;
	  font-size:16px;
	  letter-spacing:1px;
	  position:relative;
	  display:inline-block;
	}
	div nav a:before{
	  content:'';
	  position: absolute;
	  width: 100%;
	  height: 3px;
	  background:#16151b;
	  top:47%;
	  animation:out 0.2s cubic-bezier(1, 0, 0.58, 0.97) 1 both;
	}
	div nav a:hover:before{
	  animation:in 0.2s cubic-bezier(1, 0, 0.58, 0.97) 1 both;

	}
	@keyframes in{
	  0%{
	    width: 0;
	    left:0;
	    right:auto;
	  }
	  100%{
	    left:0;
	    right:auto;
	    width: 100%;
	  }
	}
	@keyframes out{
	  0%{
	    width:100%;
	    left: auto;
	    right: 0;
	  }
	  100%{
	    width: 0;
	    left: auto;
	    right: 0;
	  }
	}
	@keyframes show{
	  0%{
	    opacity:0;
	    transform:translateY(-10px);
	  }
	  100%{
	    opacity:1;
	    transform:translateY(0);
	  }
	}

	@for $i from 1 through 5 {
	  nav a:nth-child(#{$i}){
	    animation:show .2s #{$i*0.1+1}s ease 1 both;
	  }
	}

	#block{
		background-color: white; 
		width: 800px; 
		margin: auto; 
		margin-top: 5px;
		padding: 10px;
		padding-top: 50px;
		text-align: center;
		font-weight: bold;
	}

	#link{

		background-color: #42b72a;
		width: 70px;
		text-align: center;
		padding: 4px;
		border-radius: 4px;
		color: white;
		text-decoration: none;
	}

	h3{
		color: black;
	}
</style>
<body style="font-family: tahoma; background-color: #d0d8e4;">
<?php
$id = intval($_GET['id']);
$user_id = $_SESSION['user_id'];

$db = new PDO('mysql:host=localhost;dbname=socialsite;charset=utf8', 'root','');		
			$select = $db->prepare("SELECT * FROM membres WHERE id = $id");
			$select->execute();

$s = $select->fetch(PDO::FETCH_OBJ);

$db = new PDO('mysql:host=localhost;dbname=socialsite', 'root','');		
			$selectP = $db->prepare("SELECT * FROM membres WHERE id = $user_id");
			$selectP->execute();

$p = $selectP->fetch(PDO::FETCH_OBJ);

	?>
	<!DOCTYPE html>
	<html>
	<head>
		<title></title>
		<meta charset="utf-8">
	</head>
	<body>
		<br>
		<div id="blue_bar">
			<div style="width: 800px; margin: auto; font-size: 30px;">
				StLovac &ensp;					
			<a href="profile.php"><img src="img_profil/profile/<?php echo "$p->email";?>.jpg" title="Profile" style="width: 50px; float: right; border-radius: 50%; "></a> 	
			<a href="actu.php"><img src="stmarc.png" title="Actualité" style="width: 50px; float: right; border-radius: 50%;"></a>
			</div>
		</div>
		<div style="width: 800px; margin: auto; background-color: black; min-height: 300px;">
			<div style="background-color: white; text-align: center; color: #405d9b">
				<img src="img_profil/fond/<?php echo "$s->email";?>.jpg" style="width: 100%; height: 300px;">
				<img src="img_profil/profile/<?php echo "$s->email";?>.jpg" id="profile_pic">
				<br>
				<h3 style="color:#405d9b;"><?php echo $s->nom; ?> &nbsp <?php echo $s->prenom; ?></h3>
				<h4><?php echo $s->description; ?></h4><br>
				<nav>
					<a href="actu.php">Actualité</a>
					<a href="membres.php">Membres</a>
					<a href="profile.php">Profil</a>
				</nav>	
			</div>
		</div>
		

			<div id="block">
				<a id="link" href="message/envoi.php?r=<?php echo $s->nomprenom ?>">Envoyer un message à <?php echo $s->nomprenom; ?></a><br><br>

					<?php
					$bdd = new PDO("mysql:host=127.0.0.1;dbname=socialsite;charset=utf8", "root", "");
					if(isset($_GET['id']) AND !empty($_GET['id'])) {
					   $get_id = htmlspecialchars($_GET['id']);
					   $destinataire = $bdd->prepare('SELECT * FROM membres WHERE id = ?');
					   $destinataire->execute(array($get_id));
					   if($destinataire->rowCount() == 1) {
					      $destinataire = $destinataire->fetch();
					      $id = $destinataire['id'];
					      $nom = $destinataire['nom'];
					      $prenom = $destinataire['prenom'];
					      $likes = $bdd->prepare('SELECT id FROM likes WHERE id_destinataire = ?');
					      $likes->execute(array($id));
					      $likes = $likes->rowCount();
					      $dislikes = $bdd->prepare('SELECT id FROM dislikes WHERE id_destinataire = ?');
					      $dislikes->execute(array($id));
					      $dislikes = $dislikes->rowCount();
					   } else {
					      die('Cette personne n\'existe pas !');
					   }
					} else {
					   die('Erreur');
					}
					?>
					<!DOCTYPE html>
					<html>
					<head>
					   <title>Accueil</title>
					   <meta charset="utf-8">
					</head>
					<body>

					   <a id="link" href="php/action.php?t=1&id=<?= $id ?>">like</a> (<?= $likes ?>)
					   <br><br>
					   <a id="link" href="php/action.php?t=2&id=<?= $id ?>">dislike</a> (<?= $dislikes ?>) 
					</body>
					</html>
				<div>
		</body>
		</html>
	