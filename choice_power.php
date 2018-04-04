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
		<title>Choix du pouvoir/StarChat</title>
		<meta charset="utf-8">
    	<link rel="stylesheet" type="text/css" href="./public/css/choice_power.css">
	</head>
<body>
	<div id="laPage">
		<div align="center">
			<header>
				<?php
				if(!empty($userinfo['avatar']))
				{
				?>
				<img class="profilAvatar" src="./public/content/img/avatars/<?php echo $userinfo['avatar']; ?>" height="100px" width="89px"/>
				<?php
				}
				?>
			<div class="profilTouch">
				<b class="index"><a href='index.php'><p>Index</p></a></b>
      			&nbsp;&nbsp;
				<b class="profil"><a href='profil.php'><p><?php echo $_SESSION ['pseudo'];?></p></a></b>
				&nbsp;&nbsp;
				<b class="editProfil"><a href='edit.php'><p>Editer mon profil</p></a></b>
				&nbsp;&nbsp;
				<b class="deco"><a href='disconnect.php'><p>Se déconnecter</p></a></b>
				&nbsp;&nbsp;
			</div>
				<h1>STARCHAT</h1>
					<p class="message_profil">Faites votre choix !</p>
				<hr>
			</header>
			<div id="positionemment_profil">
				<h2>De quel côté de la force te dirige-tu <?php echo $_SESSION['pseudo'];?></h2>
				<br>
				<br>
        <div id="logo">
            <a id="logo_dark" href="./chat/dark/deathstar.php"><img src="./public/content/img/Empire.png" height="290"></a>
            <a id="logo_light" href="./chat/light/coruscant.php"><img src="./public/content/img/alliance.png" height="290"></a>
        </div>
      </div>
		<footer>
            <table class="icon_social_position_foot">
					<tr class="icon_social_foot">
						<td>
							<a href="https://github.com/DarKaweit/"><img src="./public/content/img/resaux_sociaux/Github.png" height="35px" width="35px"></a>
						</td>
					</tr>
					<tr class="icon_social_foot">
						<td>
							<a href="#"><img src="./public/content/img/resaux_sociaux/Google+.png" height="35px" width="35px"></a>
						</td>
					</tr>
					<tr class="icon_social_foot">
						<td>
							<a href="https://www.linkedin.com/in/bpujadep/"><img src="./public/content/img/resaux_sociaux/Linkedin.png" height="35px" width="35px"></a>
						</td>
					</tr>
					<tr class="icon_social_foot">
						<td>
							<a href="https://www.facebook.com/profile.php?id=100008341441660"><img src="./public/content/img/resaux_sociaux/Facebook.png" height="35px" width="35px"></a>
						</td>
					</tr>
				</table>
		</footer>
    <script>
    $(function(){
        $('#logo_dark').hover(function(){
            $('html').css({'background-image': 'url("./public/content/img/lightsaber_red.jpg")'});
    },function(){
            $('html').css({'background-image': 'url("./public/content/img/bg_sw3.jpg")'});
    });
    });
    $(function(){
    $('#logo_light').hover(function(){
        $('html').css({'background-image': 'url("./public/content/img/lightsaber_blue.jpg")'});
    },function(){
        $('html').css({'background-image': 'url("./public/content/img/bg_sw3.jpg")'});
    });
    });
    </script>
	</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
</body>
</html>
<?php
}
?>