		<link href="Vue/styles/form.css" rel="stylesheet">
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
