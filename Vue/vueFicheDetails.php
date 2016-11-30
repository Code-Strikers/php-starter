
<nav class="navbar navbar-inverse navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<a class="navbar-brand" href="./index.php?action=SansAction">Dragon Ball Z</a>
		</div>
		<div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav navbar-right">
				<?php if(isset($_SESSION['role'])){
					if(strcmp($_SESSION['role'], "admin")==0){
						echo "<li><a href=\"./index.php?action=SansAction\"> Bonjour " . $_SESSION['login'] . " (Admin) </a></li> ";
						echo "<li><a  href=\"./index.php?action=AfficherFenetreAjoutArticle\">Ajouter Article</a></li>";
						echo "<li><a  href=\"./index.php?action=AfficherFenetreAjoutPersonnage\">Ajouter Personnage</a></li>";
					} else if(strcmp($_SESSION['role'], "membre")==0){
						echo "<li id=\"bonjourLogin\"> Bonjour " . $_SESSION['login'] . " </li>";
					}
				}
				?>
				<li><a href="./index.php?action=SansAction">Accueil</a></li>
				<li><a href="./index.php?action=AfficherFenetreBiographie">Biographie</a></li>
				<?php if(isset($_SESSION['login'])){
					echo "<li><a href=\"./index.php?action=SeDeconnecter\">Déconnexion</a></li>";
					echo "<li><a href=\"./index.php?action=AfficherMonCompte\">Mon compte</a></li>";
				} else {
					echo "<li><a href=\"./index.php?action=AfficherFenetreInscription\">Inscription</a></li>";
					echo "<li><a href=\"./index.php?action=AfficherFenetreConnexion\">Connexion</a></li>";
				}
				?>
			</ul>
		</div><!--/.navbar-collapse -->
	</div>
</nav>

<div class="jumbotron">
	<div class="container">
		<h1 class="text-center">DBZ Actu</h1>
		<img src="./Vue/Image/banniere.jpeg">
	</div>
</div>

<div class="container">
	<?php if (isset($tableauErreurs)) {
		for ($i = 0; $i < count($tableauErreurs); $i++) {
			echo "<p id=\"alert-danger\">" . $tableauErreurs[$i];
		}
	}
	?>
</div>

<div class="container">
	<link href="form.css" rel="stylesheet">
		<?php if(isset($listeDetails)){
			echo "<h1 class=\"text-center\">Details de l'article </h1>";
			echo "<img class=\"center-block\" src=\"".$listeDetails['Article']->getImage()."\" alt=\"image article\" id=\"imageArticleDetails\"</img>";

			echo "<h2 class=\"text-center\">" . $listeDetails['Article']->getTitre() . "</h2>";

			echo "<p class=\"text-center\">" . $listeDetails['Article']->getContenue() . "</p>";

			echo "<p class=\"text-center\">En ligne depuis le: " . $listeDetails['Article']->getDateParution() . "</p>";

		?>
</div>
<div class="container">
	<form class="form-signin" method="POST" action="./index.php">
		<input type='hidden' name='action' value='AjouterCommentaire'/>
		<input type='hidden' name='idArticle' value='<?php echo $listeDetails['Article']->getId()?>'/>
		<h2 class="form-signin-heading"> Commentaire : </h2>
		<textarea class="form-control" maxlength="499" id="zoneCommentaire" name="commentaire"></textarea>
        <button class="btn btn-primary btn-block" type="submit"> Laisser un commentaire</button>
    </form>
		<?php
				if(isset($listeDetails['Commentaires'])){
					echo "<p id=\"dernierCommentaire\"> Derniers commentaires : </p>";
					foreach($listeDetails['Commentaires'] as $commentaire){
							echo "<br/>";
							echo "<table id=\"tableauCommentaire\">";
								echo "<tr>";
									echo "<td id=\"commentaireLogin\">". $commentaire->getLogin() ."</td>";
								echo "</tr>";
								echo "<tr>";
									echo "<td id=\"commentaireCorps\">" . $commentaire->getCorps() ."</td>";
									if(isset($_SESSION['role']) && strcmp($_SESSION['role'], "admin")==0){
										echo "<td><a onclick=\"return confirm('Voulez-vous vraiment supprimer ce commentaire ?');\" title=\"Supprimer ce commentaire\" href=\"./index.php?action=SupprimerCommentaire&idArticle=".$commentaire->getIdArticle()."&loginCommentaire=".$commentaire->getLogin()."\"><img src=\"./Vue/Image/supprimerCommentaire.png\" id=\"supprimerCommentaire\"</img></a></td>";
									}
								echo "</tr>";
							echo "</table>";			
					}
				}
		}
		?>
</div>





