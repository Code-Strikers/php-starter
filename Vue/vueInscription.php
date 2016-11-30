
		<link href="Vue/styles/form.css" rel="stylesheet">

		<form class="form-signin" id="formInscription" method="POST" action="./index.php">
				<input type='hidden' name='action' value='Inscription'/>
				<h2 class="form-signin-heading text-center">Inscription</h2>

				<label for="identifiant">Choisissez un login* (4 à 30 caractères)</label>
				<input type="text" name="login" class="form-control" placeholder="login :" required autofocus/>

				<label for="motDePasse">Choisissez un mot de passe*</label>
				<input type="password" name="password" class="form-control" placeholder="Mot de passe : " required/>

				<label for="reMotDePasse">Retapez votre mot de passe*</label>
				<input type="password" name="password2" class="form-control" placeholder="Confirmation du mot de passe" required/>

				<label for="email">Saisissez une adresse email*</label>
				<input type="email" name="email" class="form-control" placeholder="Adresse e-mail : " required/>
				</br>
				<button class="btn btn-primary  " type="submit">S'inscrire</button>
				<a href="./index.php?action=Accueil"><input class="btn btn-primary" type="button" value="Annuler"/></a>
		</form>
