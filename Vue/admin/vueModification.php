	<link href="Vue/styles/form.css" rel="stylesheet">

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
		<a href="./index.php?action=Accueil"><input class="btn btn-primary" type="button" value="Annuler"/></a>
	</form>
