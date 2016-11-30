<link href="form.css" rel="stylesheet">

<?php if(isset($tableauErreurs)){
				for($i = 0; $i < count($tableauErreurs); $i++){
					echo "<p class=\"alert-danger\">".$tableauErreurs[$i];
				}
			}
?>
        <form class="form-signin" id="formConnexion" method="POST" action="./index.php">
            <input type='hidden' name='action' value='SeConnecter'/>
            <h2 class="form-signin-heading text-center">Authentification</h2>
            <label for="identifiant" class="sr-only">Email address</label>
            <input type="text" name="login" id="identifiant" class="form-control" placeholder="Identifiant" required autofocus>
            <label for="motDePasse" class="sr-only">Password</label>
            <input type="password" name="password" id="motDePasseCompte" class="form-control" placeholder="Mot de passe " required>

            <button class="btn btn-lg btn-primary btn-block" type="submit">Se Connecter</button>
        </form>
