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




<div class="container" >
	<link href="form.css" rel="stylesheet">


	<?php if(isset($tableauErreurs)){
		for($i = 0; $i < count($tableauErreurs); $i++){
			echo "<p class=\"alert-danger\">".$tableauErreurs[$i];
		}
	}
	?>

	<form class="form-signin" id="formModifier" method="POST" action="./index.php">
		<input type='hidden' name='action' value='ModifierArticle'/>
		<input type='hidden' name='idArticle' value='<?php echo $idArticle ?>'/>

		<h1 class="form-signin-heading"> Modifier un article</h1>

		<div class="form-group">
			<label for="titre" >Titre de l'article : </label>
			<input type='text' class="form-control" name='titre'  value="<?php echo $titre ?>" required autofocus />
		</div>

		<div class="form-group">
			<label for="jour">Jour de parution de l'article :</label>
			<input type="text" name="jour" class="form-control"  value="<?php echo $jour ?>" required>
		</div>
		<div class="form-group">
			<label for="mois">Mois de parution de l'article :</label>
			<input type='text' name='mois' class="form-control"  value="<?php echo $mois ?>" required />
		</div>
		<div class="form-group">
			<label for="annee">Annee de parution de l'article :</label>
			<input type='text' name='annee' class="form-control"  value="<?php echo $annee ?>" required />
		</div>
		<div class="form-group">
			<label for="image">Nom de l'image de l'article</label>
			<input type='text' name='image' class="form-control"  value="<?php echo $image ?>" />
		</div>
		<div class="form-group">
			<label for="contenu">Texte de l'article </label>
			<textarea class="form-control" maxlength="499"  name="contenu" required><?php echo $contenu ?></textarea>
		</div>
		<button class="btn btn-primary " type="submit">Modifier</button>
		<a href="./index.php?action=SansAction"><input class="btn btn-primary" type="button" value="Annuler"/></a>
	</form>
</div>
