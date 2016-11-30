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
		<?php if(isset($tableauErreurs)){
				for($i = 0; $i < count($tableauErreurs); $i++){
					echo "<p class='alert-danger'>".$tableauErreurs[$i];
				}
			}
		?>
<div class="container">
	<link href="form.css" rel="stylesheet">
		<h1 class="text-center">Modifier votre mot de passe</h1>
			<form class="form-signin" method="POST" action="./index.php">
				<input type='hidden' name='action' value='ModifierPassword'/>
				<div class="form-group">
				<label for="motDePasse">Choisissez un nouveau mot de passe</label>
				<input placeholder="nouveau mot de passe" type="password" name="password" class="form-control" required autofocus/>
				</div>
				<div class="form-group">
				<label for="reMotDePasse">Retapez votre nouveau mot de passe</label>
				<input placeholder="confirmer mot de passe" type="password" name="password2" class="form-control" required/>
				</div>
				<input class="btn btn-primary" type='submit' value='Valider'/>
			</form>
</div>

