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
        <meta charset="utf-8" />
        <title>Coruscant</title>
        <link rel="stylesheet" type="text/css" href="../../public/css/chat/light/coruscant.css">
    </head>
<body>
	<div id="laPage">
	<?php
          if(!empty($userinfo['avatar']))
          {
          ?>
          <img class="profilAvatar" src="../public/content/img/avatars/<?php echo $userinfo['avatar']; ?>" height="100px" width="89px"/>
          <?php
          }
          ?>
        <div class="profilTouch">
          <b class="index"><a href='../index.php'><p>Index</p></a></b>
              &nbsp;&nbsp;

          <b class="profil"><a href='../profil.php'><p><?php echo $_SESSION ['pseudo'];?></p></a></b>
          &nbsp;&nbsp;

          <b class="editProfil"><a href='../edit.php'><p>Editer mon profil</p></a></b>
          &nbsp;&nbsp;

          <b class="deco"><a href='../disconnect.php'><p>Se déconnecter</p></a></b>
          &nbsp;&nbsp;
        </div>
        <h1>StarChat</h1>
        <p class="message_profil">Range toi parmit nous <?php echo $_SESSION ['pseudo'];?></p>
        <hr>
      </header>
      <div id="positionemment_profil">
	<h2>Choisissez votre salon.</h2>
	<br>
		<ul>
			<li class="choice_heros"><a href="chat_c3po/chat_c3po.php"><img src="../../public/content/img/c3po.png" width="220px" height="220px"></a></li>
			<li class="choice_heros"><a href="chat_luke_skywalker/chat_luke_skywalker.php"><img src="../../public/content/img/luke.png" width="220px" height="220px"></a></li>
			<li class="choice_heros"><a href="chat_yoda/chat_yoda.php"><img src="../../public/content/img/yoda.png" width="220px" height="220px"></a></li>
		</ul>
	<br>
  <div id="positionemment_footer">
	<footer>
		<hr>
			<p align="center" style="color:black;text-shadow: 3px 3px 3px darkturquoise;"><b>La peur est le chemin vers le côté obscur : la peur mène à la colère, la colère mène à la haine, la haine ... mène à la souffrance.</b></p>
		<hr>
        <table class="icon_social_position_foot">
					<tr class="icon_social_foot">
						<td>
							<a href="https://github.com/DarKaweit/"><img src="../../public/content/img/resaux_sociaux/Github.png" height="35px" width="35px"></a>
						</td>
					</tr>
					<tr class="icon_social_foot">
						<td>
							<a href="#"><img src="../../public/content/img/resaux_sociaux/Google+.png" height="35px" width="35px"></a>
						</td>
					</tr>
					<tr class="icon_social_foot">
						<td>
							<a href="https://www.linkedin.com/in/bpujadep/"><img src="../../public/content/img/resaux_sociaux/Linkedin.png" height="35px" width="35px"></a>
						</td>
					</tr>
					<tr class="icon_social_foot">
						<td>
							<a href="https://www.facebook.com/profile.php?id=100008341441660"><img src="../../public/content/img/resaux_sociaux/Facebook.png" height="35px" width="35px"></a>
						</td>
					</tr>
				</table>
	</footer>
</div>
</div>
</div>
</body>
</html>
<?php
}
?>

