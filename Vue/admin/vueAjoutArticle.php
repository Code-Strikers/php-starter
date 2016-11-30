	<link href="form.css" rel="stylesheet">
	
	<form class="form-signin" id="formConnexion" method="POST" action="./index.php">
		<input type='hidden' name='action' value='AjouterArticle'/>
		<h1 class="form-signin-heading"> Ajouter un article</h1>
        <div class="form-group">
          <label for="titre" >Titre de l'article : </label>
		  <input type='text' class="form-control" name='titre' placeholder="Titre " required autofocus />
        </div>

        <div class="form-group">
          <label for="jour">Jour de parution de l'article :</label>
          <input type="text" name="jour" class="form-control" placeholder="Jour de parution de l'article " required>
        </div>
        <div class="form-group">
			<label for="mois">Mois de parution de l'article :</label>
			<input type='text' name='mois' class="form-control" placeholder="Mois de parution de l'article " required />
        </div>
        <div class="form-group">
			<label for="annee">Annee de parution de l'article :</label>
			<input type='text' name='annee' class="form-control" placeholder="Année de parution de l'article " required />
        </div>
        <div class="form-group">
			<label for="image">Nom de l'image de l'article</label>
			<input type='text' name='image' class="form-control" placeholder="Image (laissez vide pour avoir une image par défault) " />
        </div>
        <div class="form-group">
			<label for="contenu">Texte de l'article </label>
			<textarea class="form-control" maxlength="499"  placeholder="Tapez ici votre superbe article Admin" name="contenu"></textarea>
        </div>
        <button class="btn btn-primary  " type="submit">Ajouter</button>
        <a href="./index.php?action=SansAction"><input class="btn btn-primary" type="button" value="Annuler"/></a>
    </form>
