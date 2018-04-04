<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=bdd_starchat', 'root', 'root');

if(isset($_SESSION['id_utilisateur']))
{
	$requser = $bdd->prepare("SELECT * FROM utilisateur WHERE id_utilisateur =?");
	$requser->execute(array($_SESSION['id_utilisateur']));
	$user = $requser->fetch();

	if(isset($_POST['newpseudo']) AND !empty($_POST['newpseudo'] != $user['pseudo']))
	{
		$newpseudo = htmlspecialchars($_POST['newpseudo']);
		$insertpseudo = $bdd->prepare("UPDATE utilisateur SET pseudo = ? WHERE id_utilisateur = ?");
		$insertpseudo->execute(array($newpseudo, $_SESSION['id_utilisateur']));
		header('Location: profil.php?id_utilisateur='.$_SESSION['id_utilisateur']);
	}

		if(isset($_POST['newmail']) AND !empty($_POST['newmail'] != $user['mail']))
		{
			$newmail = htmlspecialchars($_POST['newmail']);
			$insertmail = $bdd->prepare("UPDATE utilisateur SET mail = ? WHERE id_utilisateur = ?");
			$insertmail->execute(array($newmail, $_SESSION['id_utilisateur']));
			header('Location: profil.php?id_utilisateur='.$_SESSION['id_utilisateur']);
		}

		if(isset($_POST['newmdp1']) AND !empty($_POST['newmdp1']) AND isset($_POST['newmdp2']) AND !empty($_POST['newmdp2']))
		{
			$mdp1 = sha1($_POST['newmdp1']);
			$mdp2 = sha1($_POST['newmdp2']);

			if($mdp1 == $mdp2)
			{
				$insertmdp = $bdd->prepare("UPDATE utilisateur SET motdepasse = ? WHERE id_utilisateur = ?");
				$insertmdp->execute(array($mdp1, $_SESSION['id_utilisateur']));
				header('Location: profil.php?id_utilisateur='.$_SESSION['id_utilisateur']);
			}
			else
			{
				$msg = "Vos mots de passe ne correspondent pas !";
			}
		}

		if(isset($_FILES['avatar']) AND !empty($_FILES['avatar']['name']))
		{
			$tailleMax = 2097152;
			$extensionsValides = array('jpg', 'jpeg', 'gif', 'png');
			if($_FILES['avatar']['size'] <= $tailleMax)
			{
				$extensionUpload = strtolower(substr(strrchr($_FILES['avatar']['name'],'.'), 1));
				if(in_array($extensionUpload, $extensionsValides))
				{
					$chemin = "content/img/avatars/".$_SESSION['id_utilisateur'].".".$extensionUpload;
					$resulat = move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin);
					if($resulat)
					{
						$updateavatar = $bdd->prepare('UPDATE utilisateur SET avatar = :avatar WHERE id_utilisateur = :id_utilisateur');
						$updateavatar->execute(array(
							'avatar' => $_SESSION['id_utilisateur'].".".$extensionUpload,
							'id_utilisateur' => $_SESSION['id_utilisateur']
							));
						header('Location: profil.php?id_utilisateur='.$_SESSION['id_utilisateur']);
					}
					else
					{
						$msg = "Erreur durant l'importation du fichier.";
					}
				}
				else
				{
						$msg = "Votre photo de profil doit être au format jpg, jpeg, gif ou png.";
				}
			}
			else
			{
				$msg = "Votre photo de profil ne doit pas dépasser 2Mo";
			}
		}

?>
<html>
	<head>
		<title>Edition profil/StarChat</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="public/css/profil.css">
	</head>
<body>
 <div id="laPage">
	<div align="center">
		<header>
			<h1>Votre profil</h1>
				<p class="message_profil">Editer ou chatter !</p>
			<hr>
		</header>
			<div id="positionemment_profil">
				<h2>Edition de mon profil</h2>
					<form method="POST" action="" enctype="multipart/form-data">
						<table align="center">
							<tr>
								<td align="right">
									<label class="pseudo_profil"><b>Pseudo:</b></label>
									<input type="text" name="newpseudo" placeholder="Pseudo" value="<?php echo $user['pseudo']; ?>"/><br>
								</td>
							</tr>
							<tr>
								<td align="right">
									<label class="pseudo_profil"><b>Mail:</b></label>
									<input type="email" name="newmail" placeholder="Mail" value="<?php echo $user['mail']; ?>"/><br>
								</td>
							</tr>
							<tr>
								<td align="right">
									<label class="pseudo_profil"><b>MDP:</b></label>
									<input type="password" name="newmdp1" placeholder="Mot de passe"/><br>
								</td>
							</tr>
							<tr>
								<td align="right">
									<label class="pseudo_profil"><b>Confirmation du MDP:</b></label>
									<input type="password" name="newmdp2" placeholder="Confirmation du MDP"/><br>
								</td>
							</tr>
							<tr>
								<td class="positionAvatarTxt">
									<label class="pseudo_profil"><b>Avatar :</b></label>
									<input type="file" name="avatar"/>
								</td>
							</tr>
							<tr>
								<td align="right">
									<input type="submit" value="Mettre à jour mon profil !"/>
								</td>
							</tr>
						</table>
					</form>
				<?php if(isset($msg)) { echo $msg; }?>
			</div>
		</div>
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
<?php
}
else
{
	header("Location: index.php");
}

?>
