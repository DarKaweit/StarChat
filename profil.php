<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=bdd_starchat', 'root', 'root');

if(isset($_SESSION['id_utilisateur']) AND $_SESSION['id_utilisateur'] > 0)
{
	$getid = intval($_SESSION['id_utilisateur']);
	$requser = $bdd -> prepare('SELECT * FROM utilisateur WHERE id_utilisateur = ?');
	$requser -> execute(array($getid));
	$userinfo = $requser->fetch();
?>

<html>
	<head>
		<title>Profil/StarChat</title>
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
				<h2>Profil de <?php echo $userinfo['pseudo']; ?></h2>
				<br />
				<?php
				if(!empty($userinfo['avatar']))
				{
				?>
					<img src="public/content/img/avatars/<?php echo $userinfo['avatar']; ?>"/>
				<?php
				}
				?>
				<br>
				<br>
				<form>
				<table align="center">
					<tr>
						<td align="center">
							<b><p><div class="pseudo_profil">Pseudo = <?php echo $userinfo['pseudo']; ?></div></p></b>
						</td>
					</tr>
					<tr>
						<td align="center">
							<b><p><div class="mail_profil">Mail = <?php echo $userinfo['mail']; ?></div></p></b>
						</td>
					</tr>
				</table>
				<?php
				if(isset($_SESSION['id_utilisateur']) AND $userinfo['id_utilisateur'] == $_SESSION['id_utilisateur'])
				{
				?>
				<br><br>
				<b><a href='edit.php'>Editer mon profil</a></b>
				/
				<b><a href='disconnect.php'>Se déconnecter</a></b>
				<br><br><br>
				<a href="choice_power.php" class="btn btn-starwars">Tchattons !</a>
				<?php
				}
				?>
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
?>
