<?php
	Class ModeleUser{
	
		public function __construct(){}
		
		/* Function permettant de récupérer tout les articles de la BDD*/
		public function GetArticles($pagecourante){
	
			$DAL = new DAL();
			return $DAL->getArticles($pagecourante);
		}
		
		/* Function permettant de récupérer le nombre total d'Articles dans la BDD*/
		public function GetNbArticles(){
	
			$DAL = new DAL();
			return $DAL->getNbArticles();
		}

		/* Function permettant de récupérer tout les Titre de la BDD*/
		public function GetPersonnage(){

			$DAL = new DAL();
			return $DAL->getPersonnage();
		}
		
		/* Function permettant de récupérer les détails d'un article  */
		public function GetDetails($idArticle){
	
			$DAL = new DAL();
			return $DAL->GetDetails($idArticle);
		}

		/* Function permettant de récupérer les détails d'un titre (Informations d'un titre + info de son album) */
		public function GetDetailsPersonnage($idTitre){

			$DAL = new DAL();
			return $DAL->getDetailsPersonnage($idTitre);
		}

		/* Function permettant de savoir s'il existe un pseudo égal à celui passé en paramètre dans la BDD */
		public function isLoginExistant($login){
		
			$DAL = new DAL();
			return $DAL->isLoginExistant($login);
		}
		
		/* Envoit les informations d'un nouvel inscrit a la DAL en vue de l'enregistrer dans la BDD */
		public function AjouterMembre($login, $password, $email){
		
			$DAL = new DAL();
			$DAL->ajouterMembre($login, $password, $email);
		}
		
		public function isIdArticleExistant($id){
			
			$DAL = new DAL();
			return $DAL->isIdArticleExistant($id);
		}

		public function isIdPersonnageExistant($id){

			$DAL = new DAL();
			return $DAL->isIdPersonnageExistant($id);
		}

	}
?>