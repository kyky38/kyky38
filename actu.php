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

$user_id=$_SESSION['user_id'];
$select = $db->query("SELECT * FROM membres WHERE id='$user_id'");




while($s = $select->fetch(PDO::FETCH_OBJ)){
	?>
	<br>
	<div id="blue_bar">
		<div style="width: 800px; margin: auto; font-size: 30px;">
			StLovac &ensp;					
			<a href="profile.php"><img src="img_profil/profile/<?php echo "$s->email";?>.jpg" title="Profile" style="width: 50px; float: right; border-radius: 50%; "></a> 	
			<a href="actu.php"><img src="stmarc.png" title="Actualité" style="width: 50px; float: right; border-radius: 50%;"></a>
		</div>
	</div>
	<div style="width: 800px; margin: auto; background-color: black; min-height: 300px;">
		<div style="background-color: white; text-align: center; color: #405d9b">
			<img src="img_profil/fond/<?php echo "$s->email";?>.jpg" style="width: 100%; height: 300px;">
			<img src="img_profil/profile/<?php echo "$s->email";?>.jpg" id="profile_pic">
			<br>
			<h3 style="color:#405d9b;"><?php echo $s->nom; ?> &nbsp <?php echo $s->prenom; ?></h3>
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
<?php

$user_id = $_SESSION['user_id'];

	$db = new PDO('mysql:host=localhost;dbname=socialsite;charset=utf8', 'root','');		
			$select = $db->prepare("SELECT * FROM actu ");
			$select->execute();

	while ($s=$select->fetch(PDO::FETCH_OBJ)) {
		$lenght = 500;
		$description = $s->description;
		$new_description = substr($description, 0, $lenght)."...";

		$description_final= wordwrap($new_description, 100,'<br/>',false);
		
		
		 ?>
		<center>
				<img style="width: 200px; height: 200px; margin: auto; border-radius: 5px; border: 3px  #405d9b solid;" src="img/<?php echo "$s->id";?>.jpg">
				<h3 style="color:#405d9b;"><?php echo $s->nom;?></h3><br>
				<h3 style="font-size: 12px;"><?php echo $description_final;?></h3><br/>
				
				</br></br><br/><br/>
		</center>
		<?php

	}
?>
</div>
</body>
</html>