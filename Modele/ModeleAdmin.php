<?php
	Class ModeleAdmin{
	
		public function __construct(){}
		
		/* Function permettant de se connecter en tant qu'admin */
		public function SeConnecterAdmin($login){
		
			$_SESSION['role'] = "admin";
			$_SESSION['login'] = $login;
		}
			
		/* Function permettant de savoir si la personne connectée est un admin */
		public function IsAdmin(){
		
			if(isset($_SESSION['role'])){
				if(strcmp($_SESSION['role'], "admin") == 0){
					return true;
				}
			} else return null;
		}
		
		/* Function qui envoit les informations d'un article à la DAL en vue de l'ajouter dans la BDD */
		public function AjouterArticle($titre,$dateParution,$cheminPhoto,$contenu){
		
			$DAL = new DAL();
			$DAL->AjouterArticle($titre,$dateParution,$cheminPhoto,$contenu);
		}

		/* Function qui envoit à la DAL l'id d'un article en vue de le supprimer */
		public function SupprimerArticle($idArticle){
		
			$DAL = new DAL();
			$DAL->SupprimerArticle($idArticle);
		}

		/* Function envoit à la DAL les informations d'un article dont l'id est passé en paramètre en vue de le modifier */
		public function ModifierArticle($idArticle,$titre,$dateParution,$photo,$contenu){
		
			$DAL = new DAL();
			$DAL->ModifierArticle($idArticle,$titre,$dateParution,$photo,$contenu);
		}

		/* Function qui envoit à la DAL un id d'un article et un login, en vue de supprimer un commentaire d'une personne sur un article */
		public function SupprimerCommentaire($idArticle, $loginCommentaire){
		
			$DAL = new DAL();
			$DAL->SupprimerCommentaire($idArticle, $loginCommentaire);
		}
		public function SupprimerPersonnage($idArticle){

			$DAL = new DAL();
			$DAL->supprimerPersonnage($idArticle);
		}

		/* Function qui envoit les informations d'un titre à la DAL en vue de l'ajouter dans la BDD */
		public function AjouterPersonnage($nom, $origine,$detail,$photo){

			$DAL = new DAL();
			$DAL->ajouterPersonnage($nom, $origine,$detail,$photo);
		}

		public function ModifierPersonnage($idArticle,$nom, $origine,$detail,$photo){

			$DAL = new DAL();
			$DAL->modifierPersonnage($idArticle,$nom, $origine,$detail,$photo);
		}
		

	}
?>