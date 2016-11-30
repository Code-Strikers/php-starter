<?php
	Class ModeleMembre{
	
		public function __construct(){}
		
		/* Function qui envoit le login et le password d'une personne à la DAL afin de déterminer s'il s'agit de ceux d'un admin ou d'un membre
		   et si ceux sont bien les bons */
		public function IdentificationAuthentification($login, $password){
			
			$DAL = new DAL();
			return $DAL->IdentificationAuthentification($login, $password);
		}
				
		/* Connecte un membre en créant les variables de sessions */		
		public function SeConnecterMembre($login){
		
			$_SESSION['role'] = "membre";
			$_SESSION['login'] = $login;
		}
		
		/* Déconnecte un membre en détruisant ses variables de sessions */
		public function seDeconnecter(){
			
			unset($_SESSION['role']);
			unset($_SESSION['login']);
		}
		
		/* Permet de tester si une personne est connectée et si cette personne est un membre */
		public function isMembre(){
		
			if(isset($_SESSION['role']) && strcmp($_SESSION['role'], "membre") == 0){
				return true;
			} else { return null; }
		}
		
		/* Permet d'ajoouter le commentaire d'une personne donnée à un titre donné */
		public function AjouterCommentaire($idArticle, $login, $commentaire){
		
			$DAL = new DAL();
			$DAL->AjouterCommentaire($idArticle, $login, $commentaire);
		}
		
		/* Function qui permette de modifier le mot de passe d'un membre */
		public function ModifierPassword($login, $password){
			
			$DAL = new DAL();
			$DAL->ModifierPassword($login, $password);
		}
	}
?>