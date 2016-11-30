

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
