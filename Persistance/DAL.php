<?php
	Class DAL{

		public function __construct(){}

		/***************** USER *****************/
		/* Function qui récupère les Articles de la BDD
		 1 - On se connecte
		 2 - On prépare la requete
		 3 - On prépare la position, c'est-à-dire le seuil qui va définir à partir de quelles lignes dans la BDD on récupère les Articles
		 4 - On prépare les params pour combler les "?"
		 5 - On envoit le tout à la classe BD
		 6 - getResults permet de récupérer les lignes de la BDD sous forme d'un tableau de tableau
			   ex: Articles[0]=> tableau[0] = idArticle
							   tableau[1] = titre
		7 - Pour chaque ligne récupérée depuis la BDD on crée un nouvel objet article
		8 - On détruire la connexion à la BDD
		9 - On stock tout les objets dans un tableau qu'on return pour l'afficher plus tard */
		public function getArticles($pagecourante){

			$BD = ClassBD::getInstance();

			$req = "SELECT * FROM article LIMIT ?,10";
			$position = ($pagecourante-1)*10;
			$param = array('1' => array($position, PDO::PARAM_INT));
			$statement = $BD->query($req, $param);
			$articles = $BD->getResults($statement);

			foreach ($articles as $article){
				$tArticles[] = new Article($article[0], $article[1], $article[2], $article[3], $article[4]);
			}

			$BD::destructInstance();
			return $tArticles;
		}

		/* Récupère le nombre total d'article dans la BDD
		   On fait un getResults
		   Cela a pour conséquences de mettre le résultat dans un tableau de tableau
		   ex: tableau[0] => tableau[0] = nbTotalArticle
		   On détruit la connexion et return */
		public function getNbArticles(){

			$BD = ClassBD::getInstance();

			$req = 'SELECT COUNT(*) FROM article';
			$param = array();
			$statement = $BD->query($req, $param);
			$nbTotalArticles = $BD->getResults($statement);

			$BD::destructInstance();
			return $nbTotalArticles[0][0];
		}

		/* Function permettant de récupérer les détails d'un article dont l'id est passé en paramètre
			1 - On récupère toutes les infos de l'article
				1.1 - On récupère les infos depuis la BDD
				1.2 - On construit notre article avec les infos récupérées
				1.3 - On le stock dans le tablau $tableauDetails à la clé 'Article'
			2 - On récupère les commentaires liés à l'article
				2.1 - On construit les commentaires et les stocke dans un $tableauCommentaires
				2.2 On ajoute $tableauCommentaires dans le $tableauDetails à la clé 'Commentaires' ssi des Commentaires ont été crées sinon on ajouterait un tableau vide */
		public function GetDetails($idArticle){

			$BD = ClassBD::getInstance();

			$req = "SELECT * FROM article WHERE idArticle= ?";
			$param = array('1' => array($idArticle, PDO::PARAM_INT));
			$statement = $BD->query($req, $param);
			$articleCourant = $BD->getResults($statement);
			$tableauDetails['Article'] = new Article($articleCourant[0][0], $articleCourant[0][1], $articleCourant[0][2],
				$articleCourant[0][3], $articleCourant[0][4]);


			$req2 = 'SELECT * FROM commentaire WHERE idArticle = ?';
			$param2 = array('1' => array($idArticle, PDO::PARAM_INT));
			$statement2 = $BD->query($req2, $param2);
			$commentaires = $BD->getResults($statement2);
			if(!empty($commentaires)){
				foreach($commentaires as $commentaire){
					$tableauCommentaires[] = new Commentaire($commentaire[0], $commentaire[1], $commentaire[2]);
				}
				$tableauDetails['Commentaires'] = $tableauCommentaires;
			}

			$BD::destructInstance();
			return $tableauDetails;
		}


		/* Function permettant de tester si l'id d'un article existe afin de sécuriser les id d'un article passé par URL*/
		public function isIdArticleExistant($id){

			$BD = ClassBD::getInstance();

			$req = 'SELECT COUNT(*) FROM article WHERE idArticle = ?';
			$param = array('1' => array($id, PDO::PARAM_INT));
			$statement = $BD->query($req, $param);
			$isIdArticleExistant = $BD->getResults($statement);
			if($isIdArticleExistant[0][0] == 1){
				$BD::destructInstance();
				return true;
			} else { $BD::destructInstance(); return false; }
		}


		/* Function permettant de savoir s'il existe un pseudo égal au pseudo passé en paramètre dans la BDD
		   S'il existe un pseudo identique, le COUNT ramènera 1 sinon 0 */
		public function isLoginExistant($login){

			$BD = ClassBD::getInstance();

			$req = 'SELECT COUNT(*) FROM membre WHERE login = ?';
			$param = array('1' => array($login, PDO::PARAM_STR));

			$statement = $BD->query($req, $param);
			$nbPseudosIdentiques = $BD->getResults($statement);

			$BD::destructInstance();
			return $nbPseudosIdentiques[0][0];
		}

		/* Function permettant d'ajouter les données d'un nouveau membre du site*/
		public function ajouterMembre($login, $password, $email){

			$BD = ClassBD::getInstance();

			$password = sha1($password);

			$req = 'INSERT INTO membre(login, password, email, role) VALUES (?, ?, ?, "membre")';
			$param = array('1' => array($login, PDO::PARAM_STR),
						'2' => array($password, PDO::PARAM_STR),
						'3' => array($email, PDO::PARAM_STR));

			$statement = $BD->query($req, $param);
			$BD::destructInstance();
		}


		/***************** MEMBRE *****************/
		/* Function permettant d'identifier le role d'une personne qui essaie de se connecter et de déterminer si les identifiants sont les bons
			1 - On regarde s'il y a une personne membre qui a un login et un password identiques à ceux entrés par l'utilisateur
				1.1 - Si oui, on informe le controleur que c'est un membre qui veut se connecter en retournant "membre"
			2 - Si les identifiants ne sont pas ceux d'un membre, peut-être que se sont ceux d'un admin
				2.1 - Si oui on retourne "admin" pour informer le controleur que c'est un admin qui veut se connecter
			3 - Si les identifiants ne sont ni ceux d'un admin, ni d'un membre alors c'est une erreur, on ne retourne rien */
		public function IdentificationAuthentification($login, $password){

			$BD = ClassBD::getInstance();

			$password = sha1($password);

			$req = 'SELECT COUNT(*) FROM membre WHERE login = ? AND password = ? AND role = "membre"';
			$param = array('1' => array($login, PDO::PARAM_STR),
						   '2' => array($password, PDO::PARAM_STR));
			$statement = $BD->query($req, $param);
			$isMembre = $BD->getResults($statement);
			if($isMembre[0][0] == 1){
				$BD::destructInstance();
				return "membre";
			}

			$req2 = 'SELECT COUNT(*) FROM membre WHERE login = ? AND password = ? AND role = "admin"';
			$param2 = array('1' => array($login, PDO::PARAM_STR),
						   '2' => array($password, PDO::PARAM_STR));
			$statement2 = $BD->query($req2, $param2);
			$isAdmin = $BD->getResults($statement2);
			if($isAdmin[0][0] == 1){
				$BD::destructInstance();
				return "admin";
			}

			$BD::destructInstance();
		}

		/* Function permettant d'ajouter un commentaire à un article dont l'id est passé en paramètre
			On veut faire en sorte que le membre ne puisse ajouter qu'un commentaire par article
			Avant d'ajouter un commentaire, on supprimer le commentaire qu'il a déjà laisser sur ce article */
		public function AjouterCommentaire($idArticle, $login, $commentaire){

			$BD = ClassBD::getInstance();

			$req = "DELETE FROM commentaire WHERE idArticle = ? AND login = ?";
			$param = array('1' => array($idArticle, PDO::PARAM_INT),
							'2' => array($login, PDO::PARAM_STR));
			$statement = $BD->query($req, $param);

			$req2 = "INSERT INTO commentaire (idArticle, login, corps) VALUES (?, ?, ?)";
			$param2 = array('1' => array($idArticle, PDO::PARAM_INT),
							'2' => array($login, PDO::PARAM_STR),
							'3' => array($commentaire, PDO::PARAM_STR));
			$statement2 = $BD->query($req2, $param2);

			$BD::destructInstance();
		}

		/* Function qui permet de mettre à jour le mot de passe d'un utilisateur avec celui passé en param */
		public function ModifierPassword($login, $password){

			$BD = ClassBD::getInstance();

			$req = 'UPDATE membre SET password = ? WHERE login = ?';
			$param = array('1' => array($password, PDO::PARAM_STR),
						   '2' => array($login, PDO::PARAM_STR));
			$statement = $BD->query($req, $param);
			$BD::destructInstance();
		}

		/***************** ADMIN *****************/
        /* Function permettant d'ajouter toutes les données liées à un Article dans la BDD*/
        public function AjouterArticle($titre, $dateParution,$cheminPhoto,$contenu){

            $BD = ClassBD::getInstance();

            $req = 'INSERT INTO article(titre, cheminPhoto, dateParution, contenu) VALUES(?, ?, ?, ?)';
            $param =
                array(
                    '1' => array($titre, PDO::PARAM_STR),
                    '2' => array($cheminPhoto, PDO::PARAM_STR),
                    '3' => array($dateParution, PDO::PARAM_STR),
                    '4' => array($contenu, PDO::PARAM_STR)
                );


            $statement = $BD->query($req, $param);

            $BD::destructInstance();
        }

		/* Function qui permet de supprimer un article dont l'id est passé en paramètre
			On supprime auparavant les commentaires asscociés à cet article */
		public function SupprimerArticle($idArticle){

			$BD = ClassBD::getInstance();

			$req = 'DELETE FROM commentaire WHERE idArticle = ?';
			$param = array('1' => array($idArticle, PDO::PARAM_INT));
			$statement = $BD->query($req, $param);

			$req2 = 'DELETE FROM article WHERE idArticle = ?';
			$param2 = array('1' => array($idArticle, PDO::PARAM_INT));
			$statement2 = $BD->query($req2, $param2);

			$BD::destructInstance();
		}


		/* Function qui permet de modifier un titre dont l'id a été passé en paramètre */
		public function ModifierArticle($idArticle,$titre, $dateParution,$cheminPhoto,$contenu){

			$BD = ClassBD::getInstance();

			$req = 'UPDATE article SET titre = ?, cheminPhoto = ?, dateParution = ?, contenu = ? WHERE idArticle = ?';
			$param = array('1' => array($titre, PDO::PARAM_STR),
				           '2' => array($cheminPhoto, PDO::PARAM_STR),
							'3' => array($dateParution, PDO::PARAM_STR),
							'4' => array($contenu, PDO::PARAM_STR),
                            '5'=> array($idArticle, PDO::PARAM_INT));

			$statement = $BD->query($req, $param);
			$BD::destructInstance();
		}

		/* Function permettant de supprimer un commentaire d'une personne sur un article  */
		public function SupprimerCommentaire($idArticle, $loginCommentaire){

			$BD = ClassBD::getInstance();
			$req = 'DELETE FROM commentaire WHERE idArticle = ? AND login = ?';
			$param = array('1' => array($idArticle, PDO::PARAM_INT),
						   '2' => array($loginCommentaire, PDO::PARAM_STR));
			$statement = $BD->query($req, $param);

			$BD::destructInstance();
		}
	}
