<?php
	Class CtrlUser extends Controleur{

		private $tableauErreurs = array();

		public function __construct(){

			if(isset($_REQUEST['action'])){
				$action = $_REQUEST['action'];
			} else { $action = "SansAction"; }

			switch($action){
				case "SansAction":
									$this->SansAction();
									break;
				case "AfficherFenetreConnexion":
									$this->AfficherFenetreConnexion();
									break;
				case "AfficherDetails":
									$this->AfficherDetails();
									break;
				case "AfficherDetailsPersonnage":
									$this->AfficherDetailsPersonnage();
									break;
				case "AfficherFenetreInscription":
									$this->AfficherFenetreInscription();
									break;
				case "AfficherFenetreBiographie":
									$this->AfficherFenetreBiographie();
									break;
				case "Inscription":
									$this->Inscription();
									break;
				case "AfficherCommentaire":
									$this->AfficherCommentaire();
									break;
				default:
									require('./Vue/vueErreur.php');
									break;
			}
		}


		/* Function qui va chercher les Articles via le ModeleUser
			1 - Controle si le numero de page est bien un nombre au cas ou un utilisateur le modifierait dans l'URL. Soulève une erreur catcher dans le FRONT
			2 - Controle si le nombre d'article dans la BDD est différent de 0 ou non */
		public function SansAction(){

			$ModeleUser = new ModeleUser();
			$nbArticles = $ModeleUser->GetNbArticles();

			if(isset($_GET['pageCourante'])){
				$pageMax = ceil($nbArticles/4); // arrondi au nombre supérieur
				$pageCourante = Validation::ValiderIdPage($_GET['pageCourante'], $pageMax);
			} else { $pageCourante = 1; }

			if($nbArticles != 0){
				$listeArticles = $ModeleUser->GetArticles($pageCourante);
			}
			/***
			* Mettre cette structure sous la forme d'une classe controleur héritage de toute classe de Controleur
			***/
			/*ob_start();
			require('./Vue/vueAccueil2.php');
			$content_for_layout = ob_get_clean();
			require('./Vue/vueLayout.php'); */
			$this->set($listeArticles);
			$this->render('./Vue/vueAccueil2.php');
			//require('./Vue/vueAccueil.php');
		}

		/* Function qui affiche le formulaire de connexion lorsque l'utilisateur le demande */
		public function AfficherFenetreConnexion(){

			require('./Vue/vueConnexion.php');
		}

		/* 1 - Controle si l'id de l'Article passé par URL est un nombre au cas ou un utilisateur le modifierait. Soulève une erreur catcher dans le FRONT */
		public function AfficherDetails(){

			if(isset($_GET['idArticle'])){
				if(isset($_GET['tableauErreursMembre'])){
					$tableauErreurs = $_GET['tableauErreursMembre'];
				}
				$idArticle = Validation::ValiderIdArticle($_GET['idArticle']);
				$ModeleUser = new ModeleUser();
				$listeDetails = $ModeleUser->GetDetails($_GET['idArticle']);

				require('./Vue/vueFicheDetails.php');
			}
		}

		public function AfficherDetailsPersonnage(){

			if(isset($_GET['idPersonnage'])){
				if(isset($_GET['tableauErreursMembre'])){
					$tableauErreurs = $_GET['tableauErreursMembre'];
				}
				$idPersonnage = Validation::ValiderIdPersonnage($_GET['idPersonnage']);
				$ModeleUser = new ModeleUser();
				$listeDetailPersonnage = $ModeleUser-> GetDetailsPersonnage($_GET['idPersonnage']);
				require('./Vue/vueDetailPersonnage.php');
			}
		}

		/* Appelle la vue affichant la page d'inscription */
		public function AfficherFenetreInscription(){

			require('./Vue/vueInscription.php');
		}

		/* Controle les valeurs entrées par l'utilisateur lors de son inscription
			1 - Son login
			2 - Check si ses 2 mots de passe sont identiques
			3 - Check si son email est valide
			4 - Si tout est bon, on envoit les informations dans la BDD
			5 - Sinon on rappelle le formulaire d'inscription en affichant les bons messages d'erreurs */
		public function Inscription(){
			if(isset($_POST['login'], $_POST['password'], $_POST['password2'], $_POST['email'])){
				try{
					Validation::ValiderLoginInscription($_POST['login']);
				} catch (Exception $e) { $tableauErreurs[] = $e->getMessage();}

				try{
					Validation::ValiderPasswordInscriptionModification($_POST['password'], $_POST['password2']);
				} catch (Exception $e) { $tableauErreurs[] = $e->getMessage(); }

				try{
					Validation::ValiderEmail($_POST['email']);
				} catch (Exception $e) { $tableauErreurs[] = $e->getMessage(); }

				if(empty($tableauErreurs)){
					$ModeleUser = new ModeleUser();
					$ModeleUser->AjouterMembre($_POST['login'], $_POST['password'], $_POST['email']);
					$_REQUEST['action'] = "SansAction";
					$CtrlUser = new CtrlUser();
				} else { require('./Vue/vueInscription.php'); }
			}
		}


		public function AfficherFenetreBiographie(){
			$ModeleUser = new ModeleUser();
			$listePersonnage = $ModeleUser->GetPersonnage();
			require('./Vue/vueBiographie.php');
		}

	}
?>