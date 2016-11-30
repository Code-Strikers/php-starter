<?php
	Class CtrlMembre{
		
		private $tableauErreurs = array();
		
		public function __construct(){
								
			if(isset($_REQUEST['action'])){
				$action = $_REQUEST['action'];
			}
			
			switch($action){
				case "SeConnecter":
									$this->SeConnecter();
									break;
				case "SeDeconnecter":
									$this->SeDeconnecter();
									break;
				case "AjouterCommentaire": 
									$this->AjouterCommentaire();
									break;
				case "AfficherMonCompte": 
									$this->AfficherMonCompte();
									break;
				case "AfficherModifierPassword":
									$this->AfficherModifierPassword();
									break;
				case "ModifierPassword":
									$this->ModifierPassword();
									break;
				default:
									require('./Vue/vueErreur.php');
									break;
			}
		}
		
		/* Function permettant de connecter un membre du site 
			1 - On test si le champ du pseudo et du login sont vides ou non
			2 - On test si le login et le mot de passe entrés sont ceux d'un membre
				2.1 - Si oui on le connecte
			3 - Sinon on test si le login et le mot de passe entrés sont ceux d'un admin
				3.1 -Si oui on le connecte
			4 - Si ce n'est toujours pas bon c'est que c'est une erreur*/
		public function SeConnecter(){
		
			if(isset($_POST['login'], $_POST['password'])){	
				if(empty(trim($_POST['login']))){ 
					$tableauErreurs[] = "Login manquant";
				}
				if(empty(trim($_POST['password']))){
					$tableauErreurs[] = "Mot de passe manquant";
				}
				if(empty($tableauErreurs)){
					$ModeleMembre = new ModeleMembre();
					if(strcmp($ModeleMembre->IdentificationAuthentification($_POST['login'], $_POST['password']), "membre")==0){
						$ModeleMembre->SeConnecterMembre($_POST['login']);
						$_REQUEST['action'] = "SansAction";
						$CtrlUser = new CtrlUser();
					} else if(strcmp($ModeleMembre->IdentificationAuthentification($_POST['login'],$_POST['password']), "admin")==0) {
						$ModeleAdmin = new ModeleAdmin();
						$ModeleAdmin->SeConnecterAdmin($_POST['login']);
						$_REQUEST['action'] = "SansAction";
						$CtrlUser = new CtrlUser();
					} else { $tableauErreurs[] = "Login ou mot de passe incorrect"; }
				}
				
				if(!empty($tableauErreurs)){ require('./Vue/vueConnexion.php'); }
			}
		}
		
		/* Function permettant de se deconnecter */
		public function SeDeconnecter(){
			
			$ModeleMembre = new ModeleMembre();
			$ModeleMembre->SeDeconnecter();
			$_REQUEST['action'] = "SansAction";
			$CtrlUser = new CtrlUser();
		}
		
		/* Function permettant d'ajouter un commentaire à un article dont l'id est passé par formulaire */
		public function AjouterCommentaire(){
			if(isset($_POST['idArticle'], $_POST['commentaire'])){
				
				Validation::ValiderIdArticle($_POST['idArticle']);
				try{
					Validation::ValiderCommentaire($_POST['commentaire']);
				} catch (Exception $e) { $tableauErreurs[] = $e->getMessage(); }
			
				if(empty($tableauErreurs)){
					$ModeleMembre = new ModeleMembre();
					$ModeleMembre->AjouterCommentaire($_POST['idArticle'], $_SESSION['login'], $_POST['commentaire']);
				} else { $_GET['tableauErreursMembre'] = $tableauErreurs; }
				
				$_REQUEST['action'] = "AfficherDetails";
				$_GET['idArticle'] = $_POST['idArticle']; // ???
				$CtrlUser = new CtrlUser();
			}
		}
		
		/* Function qui permet d'afficher la page de tout les paramètres du compte du membre du site */
		public function AfficherMonCompte(){
		
			require('./Vue/vueMonCompte.php');
		}
				
		/* Function qui permet de modifier le mot de passe de l'utilisateur */
		public function ModifierPassword(){
		
			if(isset($_POST['password'], $_POST['password2'])){
				try{
					Validation::ValiderPasswordInscriptionModification($_POST['password'], $_POST['password2']);
				} catch (Exception $e) { $tableauErreurs[] = $e->getMessage(); }
				
				if(empty($tableauErreurs)){
					$ModeleMembre = new ModeleMembre();
					$ModeleMembre->ModifierPassword($_SESSION['login'], $_POST['password']);
					$_REQUEST['action'] = "SansAction";
					$CtrlUser = new CtrlUser();
				} else { require('./Vue/vueMonCompte.php'); }
			}
		}
	}
?>