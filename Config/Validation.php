<?php
    Class Validation {

/*** INSCRIPTION ***/
		/* Function permettant de valider un login à l'inscription
			=> Celui-ci doit contenir 4 à 30 caractères
			=> On test si le login n'est pas déjà présent dans la BDD
			3 Exceptions:
				1 - Si le login n'est pas disponible (si le code de retour de TestDisponibiliteLogin n'est pas égal à 0)
				2 - Si le login ne respecte pas l'expression
				3 - Si le login est manquant */
		public static function ValiderLoginInscription($pseudo){

      if(isset($pseudo) && !empty(trim($pseudo))){ // trim supprime les espaces en debut et fin de chaine
				if(preg_match(" /^[[:alnum:]ÀàÔôÈÉÊèéêÇçÎÏîïÛû\-_\[\]]{4,30}$/ ", $pseudo)){ // preg match : expression rationnel -> analyse pseudo pour trouver
																							 //  l'expression qui convient à [:alnum:] (expression alphanumérique)
					$ModeleUser = new ModeleUser();
					if($ModeleUser->isLoginExistant($pseudo) == 0){
						return true;
					} else { throw new Exception('Login non disponible'); }
				} else { throw new Exception('Login invalide'); }
			} else { throw new Exception('Login manquant'); }
		}

		/* Function permettant de valider un mot de passe à l'inscription
			=> On demande à l'utilisateur de taper 2 fois son mot de passe pour le confirmer
			=> Les deux doivent avoir 5 à 50 caractères, ne pas être vide et être identiques
			3 Exceptions:
				1 - Si les mots de passes ne sont pas identiques
				2 - Si un des mots de passe est manquant
				3 - Si un des mots de passe ne correspond pas à l'expression */
		public static function ValiderPasswordInscriptionModification($psw, $psw2){

      if(isset($psw, $psw2) && !empty(trim($psw)) && !empty(trim($psw2))){
				$expression = " /^[[:alnum:][:space:]ÀàÔôÈÉÊèéêÇçÎÏîïÛû\-_\[\](){}\"#'|`\^\@\+\=~\$%*?\,.;\/:!§£¤]{5,50}$/ ";
				if(preg_match($expression, $psw) && preg_match($expression, $psw2)){
					if(strcmp($psw, $psw2) == 0){
						return true;
					} else { throw new Exception('Mots de passe différents'); }
				} else { throw new Exception('Mot de passe invalide'); }
			} else { throw new Exception('Mot de passe manquant'); }
		}

	   /* Function qui valide un email
		2 Exceptions:
			1 - Si l'email est manquant
			2 - Si l'email ne correspond pas au filtre */
		public static function ValiderEmail($email){

			if(isset($email) && !empty(trim($email))){
				if(filter_var($email, FILTER_VALIDATE_EMAIL)){
					return true;
				} else { throw new Exception('Email invalide'); }
			} else { throw new Exception('Email manquant'); }
		}

    /*** Article ***/
		/* Function validant le titre d'un Article
		=> Celui-ci doit contenir au moins 2 caractères jusqu'à 30 maximum
		2 Exceptions:
			1 - Si la chaine passée en paramètre ne correspond pas à l'expression
			2 - Si la chaine est vide */
		public static function ValiderTitre($chaine){

      if(isset($chaine) && !empty(trim($chaine))){
				if(preg_match(" /^[[:alnum:][:space:]ÀàÔôÈÉÊèéêÇçÎÏîïÛû\-.'()?]{1,40}$/ ", $chaine)){
					return true;
				} else { throw new Exception('Titre invalide'); }
			} else { throw new Exception('Titre manquant'); }
		}

		public static function ValiderContenu($contenu){
			if(isset($contenu)){
				if (filter_var($contenu,FILTER_SANITIZE_STRING)){
					return true;
				}
				else {
					throw new Exception("Contenu Invalide");
				}
			}
			else {
				throw new Exception("Contenu Manquant");
			}
		}

		/* Function validant une date
			=> Test si tout les champs sont bien remplis
			=> Test si l'utilisateur a bien entré des nombres
			=> Test avec checkdate si 1 <= jour <= 31, 1 <= mois <= 12
			=> Comme check ne verifie pas si l'annee est inferieur à l'année actuelle, on doit le faire nous même
			=> On récupère l'année actuelle grace à intval, puis on test
			4 Exceptions:
				1 - Si l'année est superieur à l'année actuelle
				2 - Si un des champs est invalide (ex: mois = 13)
				3 - Si l'utilisateur a entré un mot
				4 - Si un des champs est manquant
		*/
		 public static function ValiderDateParution($jour, $mois, $annee){

			if(isset($annee, $mois, $annee) && !empty(trim($annee)) && !empty(trim($mois)) && !empty(trim($jour))){
				if (is_numeric($jour) && is_numeric($mois) && is_numeric($annee)){
					if(checkdate($mois, $jour, $annee)){
						$intannee = intval(date("Y"));
						if($annee <= $intannee){
							return true;
						} else { throw new Exception('Annee supérieure à l\'année actuelle'); }
					} else { throw new Exception('Jour, mois ou année invalide'); }
				} else { throw new Exception('Veuillez entrer un nombre: jj/mm/aaaa'); }
			} else { throw new Exception('Jour, mois ou année manquant'); }
		}

		/* Function que le nom de l'image passé en paramètre existe dans le dossier d'images */
		public static function ValiderNomImageArticle($nomImageArticle){

			if(isset($nomImageArticle)){
				$cheminImageArticle = Nettoyage::CreateCheminPhotoArticle($nomImageArticle);
				if(file_exists($cheminImageArticle)){
					return $cheminImageArticle;
				} else { throw new Exception('Image inexistante');}
			} else { throw new Exception; }
		}

		/* Function que le nom de l'image passé en paramètre existe dans le dossier d'images */
		public static function ValiderNomImagePersonnage($nomImagePersonnage){

			if(isset($nomImagePersonnage)){
				$nomImagePersonnage = Nettoyage::CreateCheminPhotoPersonnage($nomImagePersonnage);
				if(file_exists($nomImagePersonnage)){
					return $nomImagePersonnage;
				} else { throw new Exception('Image inexistante');}
			} else { throw new Exception; }
		}

		/* Function qui vérifie l'id d'un Article
			l'id d'un Article est toujours passé par URL ou par formulaire
			Mais il est possible de le modifier dans l'url par exemple
			On vérifie donc que c'est un nombre et qu'il n'est pas = à rien
			2 Exception:
				1 - Si l'id n'existe pas dans la BDD
				2 - Si le nombre est vide ou n'est pas un chiffre
			On ne lève pas un message d'erreur avec l'exception car si cette exception est levé, on appelle directement la page d'erreur */
		public static function ValiderIdArticle($nombre){

			if(isset($nombre) && !empty(trim($nombre)) && is_numeric($nombre)){
				$ModeleUser = new ModeleUser();
				if($ModeleUser->isIdArticleExistant($nombre)){
					return true;
				} else { throw new Exception; }
			} else { throw new Exception; }
		}


		public static function ValiderIdPersonnage($nombre){

			if(isset($nombre) && !empty(trim($nombre)) && is_numeric($nombre)){
				$ModeleUser = new ModeleUser();
				if($ModeleUser->isIdPersonnageExistant($nombre)){
					return true;
				} else { throw new Exception; }
			} else { throw new Exception; }
		}


		/* Function permettant de valider un commentaire */
		public static function ValiderCommentaire($commentaire){

			if(isset($commentaire) && !empty(trim($commentaire))){
				$tableauMotsFiltres = array('zut','connard','con','salop','batard','pissenlit');
				foreach($tableauMotsFiltres as $mot){
					if(!preg_match('#'.$mot.'#', strtolower($commentaire))){
						return true;
					} else { throw new Exception('Pas de commentaires insultants !'); }
				}
			} else { throw new Exception('Commentaire vide'); }
		}


		/* Function validant le nom d'un personnage
		=> Celui-ci doit contenir au moins 2 caractères jusqu'à 60 maximum
		2 Exceptions:
			1 - Si la chaine passée en paramètre ne correspond pas à l'expression
			2 - Si la chaine est vide */
		public static function ValiderNomPersonnage($chaine){

			if(isset($chaine) && !empty(trim($chaine))){
				if(preg_match(" /^[[:alnum:][:space:]ÀàÔôÈÉÊèéêÇçÎÏîïÛû\-.'()?]{1,60}$/ ", $chaine)){
					return true;
				} else { throw new Exception('nom de personnage invalide'); }
			} else { throw new Exception('nom de personnage  manquant'); }
		}

		/* Function validant le titre de l'article
		=> Celui-ci doit contenir au moins 2 caractères jusqu'à 550 maximum
		2 Exceptions:
			1 - Si la chaine passée en paramètre ne correspond pas à l'expression
			2 - Si la chaine est vide */
		public static function ValiderDetail($chaine){

			if(isset($chaine) && !empty(trim($chaine))){
				if(preg_match(" /^[[:alnum:][:space:]ÀàÔôÈÉÊèéêÇçÎÏîïÛû\-.'()?]{1,550}$/ ", $chaine)){
					return true;
				} else { throw new Exception('contenu invalide'); }
			} else { throw new Exception('contenu  manquant'); }
		}

/*** AUTRE ***/
		/* Function permettant de valider le format d'un login passé par URL utilisé lors de la suppression d'un commentaire*/
		public static function ValiderLogin($login){

			if(isset($login) && !empty(trim($login))){
				$ModeleUser = new ModeleUser();
				if($ModeleUser->isLoginExistant($login)){
					return true;
				} else { throw new Exception; }
			} else { throw new Exception; }
		}

		/* Function qui vérifie l'id d'une page */
		public static function ValiderIdPage($nombre, $pagemax){

			if(isset($nombre) && !empty(trim($nombre)) && is_numeric($nombre) && $nombre <= $pagemax && $nombre > 0){
				return $nombre;
			} else { throw new Exception; }
		}


	}
?>
