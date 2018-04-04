<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=bdd_starchat', 'root','root');
if(isset($_POST['inscription']))
{
	$pseudo = htmlspecialchars($_POST['pseudo']);
	$mail = htmlspecialchars($_POST['mail']);
	$mail2 = htmlspecialchars($_POST['mail2']);
	$mdp = sha1($_POST['mdp']);
	$mdp2 = sha1($_POST['mdp2']);
	if(!empty($_POST['pseudo']) AND !empty($_POST['mail']) AND !empty($_POST['mail2']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2']))
	{

	}
	else
	{
		$erreur = "Tous les champs doivent être complétés !";
	}

		$pseudolength = strlen($pseudo);
		if($pseudolength <= 255)
		{

		}
		else
		{
			$erreur = "Votre pseudo ne doit pas dépasser 255 caractères ! ";
		}
			if($mail == $mail2)
			{

			}
			else
			{
				$erreur = "Vos adresse mail ne correspondent pas !";
			}

				if(filter_var($mail, FILTER_VALIDATE_EMAIL))
				{

				}
				else
				{
					$erreur = "<center>Votre adresse mail n'est pas valide !</center>";
				}
					$reqmail = $bdd->prepare("SELECT * FROM utilisateur WHERE mail = ?");
					$reqmail->execute(array($mail));
					$mailexist = $reqmail->rowCount();

						if($mailexist == 0)
						{

						}
						else
						{
							$erreur = "<center><b>L'adresse mail est déjà utilisée !</b></center>";
						}

							if($mdp == $mdp2)
							{
								$insertmbr = $bdd->prepare("INSERT INTO utilisateur (pseudo, mail, motdepasse) VALUES(?, ?, ?)");
								$insertmbr ->execute(array($pseudo, $mail, $mdp));
								$goodconnect = "<center><b>Vous êtes désormais apte à rejoindre un coté de la force !</b></p><br><a href=\"index.php\"><b><p class='endInscriptconnexion'>Me connecter</p></b></a></center>";
							}
							else
							{
								$erreur = "Vos mots de passes ne sont pas identiques !";
							}
}
?>
<html>
	<head>
		<title>Inscription/StarChat</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="public/css/subscribe.css">
	</head>
	<body>
		<div id="laPage">
			<h1>Inscription</h1>
			<form method="POST" action ="">
				<table class="formInscription" align="center">
					<tr>
						<td align="right">
							<label for="pseudo"><img src="public/content/img/user-silhouette.png" width="20px" height="20px"></label>
						</td>
						<td>
							<input type="text" placeholder="Votre pseudo" id="pseudo" name="pseudo" value="<?php if(isset($pseudo)) { echo $pseudo; }?>"/>
						</td>
					</tr>
					<tr>
						<td align="right">
							<label for="mail"><img src="public/content/img/email-messages.png" width="20px" height="20px"></label>
						</td>
						<td>
							<input type="email" placeholder="Votre mail" id="mail" name="mail" value="<?php if(isset($mail)) { echo $mail; }?>"/>
						</td>
					</tr>
					<tr>
						<td align="right">
							<label for="mail2"><img src="public/content/img/email-open-envelope-in-a-rounded-square.png" width="20px" height="20px"></label>
						</td>
						<td>
							<input type="email" placeholder="Confirmer votre mail" id="mail2" name="mail2" value="<?php if(isset($mail2)) { echo $mail2; }?>"/>
						</td>
					</tr>
					<tr>
						<td align="right">
							<label for="mdp"><img src="public/content/img/lock-and-key-icon-silhouette.png" width="20px" height="20px"></label>
						</td>
						<td>
							<input type="password" placeholder="Votre mot de passe" id="mdp" name="mdp"/>
						</td>
					</tr>
					<tr>
						<td align="right">
							<label for="mdp2"><img src="public/content/img/padlock.png" width="20px" height="20px"></label>
						</td>
						<td>
							<input type="password" placeholder="Confirmez votre mdp" id="mdp2" name="mdp2"/>
						</td>
					</tr>
					<tr>
						<td></td>
						<td align="center">
							<br />
							<input type="submit" name="inscription" value="Je m'inscris"/>
						</td>
					</tr>
				</table>
			</form>
		</div>
		<?php
		if(isset($erreur))
		{
			echo '<font color="red">'.$erreur."</font>";
		}
		if(isset($goodconnect))
		{
			echo ''.$goodconnect."";
		}
		?>
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
			</footer>
		</body>
	</html>
