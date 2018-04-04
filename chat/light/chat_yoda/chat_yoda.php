<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=bdd_starchat;', 'root', 'root');
if (isset($_POST['message']) && !empty($_POST['message'])){
$requete = $bdd -> prepare('INSERT INTO historique_message(heure, text_message, id_utilisateur, id_chat) VALUES (now(),:text_message,:id_utilisateur,1)');
$requete -> execute(array('text_message' => $_POST['message'], 'id_utilisateur' => $_SESSION['id_utilisateur']));
}
$reponse = $bdd->query('SELECT * FROM historique_message INNER JOIN utilisateur ON historique_message.id_utilisateur = utilisateur.id_utilisateur WHERE id_chat= "1"');

if(isset($_SESSION['id_utilisateur']) AND $_SESSION['id_utilisateur'] > 0)
{
  $getid = intval($_SESSION['id_utilisateur']);
  $requser = $bdd -> prepare('SELECT * FROM utilisateur WHERE id_utilisateur = ?');
  $requser -> execute(array($getid));
  $userinfo = $requser->fetch();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Tchat/Yoda</title>
        <link rel="stylesheet" type="text/css" href="../../../public/css/chat/light/chat_yoda.css">
    </head>
    <div id="laPage">
        <style>
        form
        {
          text-align:center;
        }
        </style>
        <body>
          <div align="center">
          <header>
            <?php
            if(!empty($userinfo['avatar']))
            {
            ?>
            <img class="profilAvatar" src="../../public/content/img/avatars/<?php echo $userinfo['avatar']; ?>" height="100px" width="89px"/>
           <?php
            }
            ?>
          <div class="profilTouch">
          <b class="profil"><a href='../../../profil.php'><p><?php echo $_SESSION ['pseudo'];?></p></a></b>
          &nbsp;&nbsp;

          <b class="editProfil"><a href='../../../edit.php'><p>Editer mon profil</p></a></b>
          &nbsp;&nbsp;

          <b class="deco"><a href='../../../disconnect.php'><p>Se déconnecter</p></a></b>
          &nbsp;&nbsp;
        </div>
        <h1>Chat Yoda</h1>
          <p class="message_profil">T'entrainer je ne vais pas <?php echo $_SESSION['pseudo'];?></p>
        <hr>
      </header>
            <p align="center" class="pseudo_font">
                <form action="" method="post">
                    <fieldset>
                        <label>Texte :</label>
                        <input type="text" name="message" id="message"/>
                        <input type="submit" value="Envoyez votre message"/>
                        <hr>
                        <?php
                        while ($discussion = $reponse->fetch())
                        {
                        echo '<div align="center">';
                            echo '<div style="color: black; text-shadow: 2px 2px 2px darkgreen;">';
                              echo $discussion['pseudo'];
                            echo ' ';
                            echo $discussion["heure"];
                            echo ": ";
                            echo'</div>';
                            echo $discussion["text_message"];
                            echo "<hr>";
                        echo '</div>';
                        };
                        ?>
                    </fieldset>
                </form>
                <div align="center">
                <a class="imgReturn" href="../coruscant.php"><img src="../../../public/content/img/corBack.png" height=170px; alt= "Back" name="Return"></a>
                </div>
                <p class="fontReturn" align="center">Retourner sur Coruscant</p>
                <table class="icon_social_position_foot">
					<tr class="icon_social_foot">
						<td>
							<a href="https://github.com/DarKaweit/"><img src="../../../public/content/img/resaux_sociaux/Github.png" height="35px" width="35px"></a>
						</td>
					</tr>
					<tr class="icon_social_foot">
						<td>
							<a href="#"><img src="../../../public/content/img/resaux_sociaux/Google+.png" height="35px" width="35px"></a>
						</td>
					</tr>
					<tr class="icon_social_foot">
						<td>
							<a href="https://www.linkedin.com/in/bpujadep/"><img src="../../../public/content/img/resaux_sociaux/Linkedin.png" height="35px" width="35px"></a>
						</td>
					</tr>
					<tr class="icon_social_foot">
						<td>
							<a href="https://www.facebook.com/profile.php?id=100008341441660"><img src="../../../public/content/img/resaux_sociaux/Facebook.png" height="35px" width="35px"></a>
						</td>
					</tr>
				</table>
              </div>
          </body>
    </html>
  <?php
  }
  ?>
