<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=bdd_starchat', 'root', 'root');
if(isset($_POST['formConnexion']))
{
	$mailconnect = htmlspecialchars($_POST['mailconnect']);
	$mdpconnect = sha1($_POST['mdpconnect']);
	if(!empty($mailconnect) AND !empty($mdpconnect))
	{
		$requser = $bdd->prepare("SELECT * FROM utilisateur WHERE mail = ? AND motdepasse = ?");
		$requser->execute(array($mailconnect, $mdpconnect));
		$userexist = $requser->rowCount();
		if($userexist == 1)
		{
			$userinfo == $requser->fetch();
			$_SESSION['id_utilisateur'] == $userinfo['id_utilisateur'];
			$_SESSION['pseudo'] == $userinfo['pseudo'];
			$_SESSION['mail'] == $userinfo['mail'];
			header("Location: profil.php?id_utilisateur=".$_SESSION['id_utilisateur']);
		}
		else
		{
			$erreur = "<b>Le vrai pouvoir ne tolère pas l'échec !</b>";
		}
	}
	else
	{
		$erreur = "<br>À la guerre, tous doivent être ciblés</b>";
	}
}
?>
<html>
	<head>
		<title>StarChat/Accueil</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="public/css/index.css">
	</head>
	<body>
		<div id="laPage">
			<h1>Accueil</h1>
				<p class="message_accueil_index"> Bienvenue sur l'accueil du STARCHAT ! </p>
			<hr>
			<div class="connexion" align="center">
				<form method="POST" action ="">
					<table align="center">
						<tr>
							<td>
								<input type="email" name="mailconnect" placeholder="Mail" /><br/>
							</td>
						</tr>
						<tr>
							<td>
								<input type="password" name="mdpconnect" placeholder="Mot de passe" /><br/>
							</td>
							<tr>
								<td>
									<input type="submit" name="formConnexion" value="Se connecter !"/>
								</td>
							</tr>
							<tr>
								<td>
									<br>
									<div class="connectInscript">
										<a href="subscribe.php"><b>Vous n'êtes pas encore inscrit ?</b></a>
									</div>
								</td>
							</tr>
						</table>
					</form>
				<?php
				if(isset($erreur))
				{
					echo '<font color="red">'.$erreur."</font>";
				}
				?>
			</div>
				<a class="intro_index" href="intro.html"><p align="center">--> Voir l'intro <--</p></a>
			<footer>
				<table class="icon_social_position_foot">
					<tr class="icon_social_foot">
						<td>
							<a href="https://github.com/DarKaweit/"><img src="public/content/img/resaux_sociaux/Github.png" height="35px" width="35px"></a>
						</td>
					</tr>
					<tr class="icon_social_foot">
						<td>
							<a href="#"><img src="public/content/img/resaux_sociaux/Google+.png" height="35px" width="35px"></a>
						</td>
					</tr>
					<tr class="icon_social_foot">
						<td>
							<a href="https://www.linkedin.com/in/bpujadep/"><img src="public/content/img/resaux_sociaux/Linkedin.png" height="35px" width="35px"></a>
						</td>
					</tr>
					<tr class="icon_social_foot">
						<td>
							<a href="https://www.facebook.com/profile.php?id=100008341441660"><img src="public/content/img/resaux_sociaux/Facebook.png" height="35px" width="35px"></a>
						</td>
					</tr>
				</table>
			</footer>
		</div>
	</body>
</html>
