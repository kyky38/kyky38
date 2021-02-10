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
	#button{
		width: 75px;
		height: 30px;
		border-radius: 4px;
		font-weight: bold;
		border:none;
		background-color: rgb(59,89,152); 
		color: white;

	}

	h4{
		font-family: tahoma; 
		color: #405d9b;
		font-size: 30px;
	}
	#link2{
		color: #405d9b;
		font-size: 18px;
		text-decoration: none;
	}
	#link2:hover{
		color: #405d9b;
		text-decoration: underline;
	}

</style>
<body style="font-family: tahoma; background-color: #d0d8e4;">
<?php

$user_id=$_SESSION['user_id'];
$select = $db->query("SELECT * FROM membres WHERE id='$user_id'");

while($s = $select->fetch(PDO::FETCH_OBJ)){
	?>
	<br>
	<form method="GET">
	<div id="blue_bar">
		<div style="width: 800px; margin: auto; font-size: 40px;">
			
			 StLovac &ensp;					
			<a href="profile.php"><img src="img_profil/profile/<?php echo "$s->email";?>.jpg" title="Profile" style="width: 50px; float: right; border-radius: 50%; "></a> 	
			<a href="actu.php"><img src="stmarc.png" title="Actualité" style="width: 50px; float: right; border-radius: 50%;"></a>
		</div>
	</div>
	</form>
	<div style="width: 800px; margin: auto; background-color: black; min-height: 300px;">
		<div style="background-color: white; text-align: center; color: #405d9b">
			<img src="img_profil/fond/<?php echo "$s->email";?>.jpg" style="width: 100%; height: 300px;">
			<img src="img_profil/profile/<?php echo "$s->email";?>.jpg" id="profile_pic">
			<br>
			<h3><?php echo $s->nom; ?> &nbsp <?php echo $s->prenom; ?></h3>
			<h4><?php echo $s->description; ?></h4>
			<br>
		<nav>
			<a href="actu.php">Actualité</a>
			<a href="membres.php">Membres</a>
			<a href="message/reception.php">Messages</a>
			<a href="profile.php">Profil</a>
			<a href="modifier.php">Modifier</a>
		</nav>	
		</div>
	</div>

<?php
}
?>
<div id="block">
	<div>
		<?php 
		$select = $db->query("SELECT * FROM membres WHERE id='$user_id'");
		$s = $select->fetch(PDO::FETCH_OBJ);
		?>
		<h3 style="color: #405d9b;">Classe : &ensp; <?php echo $s->classe; ?></h3><br>
	</div>
	<div>
		
		<div>
			<h3 style="color: #405d9b;">Résaux :</h3>
			<a href="https://instagram.com/<?php echo $s->insta; ?>"><img src="insta.png" style="width: 100px; height: 100px; padding: 20px; margin: 20px;"></a>
			<a href="https://www.snapchat.com/add/<?php echo $s->snap; ?>"><img src="snap.png" style="width: 100px; height: 100px; padding: 20px; margin: 20px;"></a>
		</div>
		<div>
			
			<?php
			$bdd = new PDO("mysql:host=127.0.0.1;dbname=socialsite;charset=utf8", "root", "");

			$id = $user_id;
			$likes = $bdd->prepare('SELECT id FROM likes WHERE id_destinataire = ?');
			$likes->execute(array($id));
			$likes = $likes->rowCount();
			$dislikes = $bdd->prepare('SELECT id FROM dislikes WHERE id_destinataire = ?');
			$dislikes->execute(array($id));
			$dislikes = $dislikes->rowCount();
		   
			?>
			<table style="margin: auto; padding: auto;">
				<tr style="margin: auto; padding: auto; ">
					<td style="margin: auto; padding: auto;border:4px solid #405d9b; width: 350px;"><h4>like (<?= $likes ?>) </h4></td>
					<td style="margin: auto; padding: auto;border:4px solid #405d9b; width: 350px;"><h4>dislike (<?= $dislikes ?>) </h4></td>
				</tr>
				<tr style="margin: auto; padding: auto;">
					<td style="margin: auto; padding: auto; border:4px solid #405d9b; width: 350px;">
						<div>
							<?php
							$bdd = new PDO("mysql:host=127.0.0.1;dbname=socialsite;charset=utf8", "root", "");

							$msg = $bdd->prepare('SELECT * FROM likes WHERE id_destinataire = ? ');
							$msg->execute(array($_SESSION['user_id']));

							while($m = $msg->fetch()) {
								$personne = $m['id_membre'];

								$sel = $bdd->prepare('SELECT * FROM membres WHERE id = ?');
								$sel->execute(array($personne));
								while($w = $sel->fetch()){
								?>
								<table style="margin: auto; padding: auto;">
									<tr style="margin: auto; padding: auto;">
										<td style="margin: auto; padding: auto; width: 50px;"><a href="membresPage.php?id=<?php echo $w['id']; ?>"><img style="width: 50px; height: 50px; margin: auto; border-radius: 5px; border: 3px  #405d9b solid;" src="img_profil/profile/<?php echo $w['email'];?>.jpg"></a></td>
										<td style="margin: auto; padding: auto; width: 250px;"><a id="link2" href="membresPage.php?id=<?php echo $w['id']; ?>"><h3><?= $w['nomprenom'] ?></h3></a></td>
									</tr>
								</table>
								
				   				<?php
							}
							}
								
							?>
						</div>
					</td>
					<td style="margin: auto; padding: auto; border:4px solid #405d9b; width: 350px;">
						<div>
							<?php
							$bdd = new PDO("mysql:host=127.0.0.1;dbname=socialsite;charset=utf8", "root", "");

							$msg = $bdd->prepare('SELECT * FROM dislikes WHERE id_destinataire = ? ');
							$msg->execute(array($_SESSION['user_id']));

							while($m = $msg->fetch()) {
								$personne = $m['id_membre'];

								$sel = $bdd->prepare('SELECT * FROM membres WHERE id = ?');
								$sel->execute(array($personne));
								while($w = $sel->fetch()){
								?>
								<table style="margin: auto; padding: auto;">
									<tr style="margin: auto; padding: auto;">
										<td style="margin: auto; padding: auto;  width: 50px;"><a href="membresPage.php?id=<?php echo $w['id']; ?>"><img style="width: 50px; height: 50px; margin: auto; border-radius: 5px; border: 3px  #405d9b solid;" src="img_profil/profile/<?php echo $w['email'];?>.jpg"></a></td>
										<td style="margin: auto; padding: auto;  width: 250px;"><a id="link2" href="membresPage.php?id=<?php echo $w['id']; ?>"><h3><?= $w['nomprenom'] ?></h3></a></td>
									</tr>
								</table>
				   				<?php
							}
							}
								
							?>
						</div>
					</td>
				</tr>
			</table>
			
		</div>
		
	</div>

 <br><br><a id="link" href="deconnexion.php">Se deconnecter</a>
</div>
</body>
</html>		