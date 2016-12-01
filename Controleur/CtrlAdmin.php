<?php
	Class CtrlAdmin extends Controleur{

		private $tableauErreurs = array();

		public function __construct(){

			if(isset($_REQUEST['action'])){
				$action = $_REQUEST['action'];
			}

			switch($action){
				case "AfficherFenetreAjoutArticle":
									$this->AfficherFenetreAjoutArticle();
									break;
				case "AjouterArticle":
									$this->AjouterArticle();
									break;
				case "SupprimerArticle":
									$this->SupprimerArticle();
									break;
				case "AfficherFenetreModification":
									$this->AfficherFenetreModification();
									break;
				case "ModifierArticle":
									$this->ModifierArticle();
									break;
				case "SupprimerCommentaire":
									$this->SupprimerCommentaire();
									break;
				default:
									$this->render('erreurs/vueErreur');
									break;
			}
		}

		/* Function affichant la fenêtre d'ajout d'un article */
		public function AfficherFenetreAjoutArticle(){
			$this->render('admin/vueAjoutArticle');
		}

		/* Function qui ajoute un article dans la BDD
			1 - Valide le nom de l'article
			2 - Valide la date de parution, puis la transforme en chaine de caractère via Nettoyage
			4 - Si l'admin n'a pas renseigné d'image, on en met une par défaut
			5 - Si non, à partir du nom de l'image entrée on crée le chemin absolu

		Il faut valider le contenu, minimum 5 caracteres, maximum 500
		*/
		public function AjouterArticle(){

			if(isset($_POST['titre'], $_POST['jour'], $_POST['mois'], $_POST['annee'],  $_POST['image'],$_POST['contenu'])){

				try{
					Validation::ValiderTitre($_POST['titre']);
					$_POST['titre'] = Nettoyage::AjouterMajDebut($_POST['titre']);
				} catch (Exception $e) { $tableauErreurs[] = $e->getMessage(); }

				try{
					Validation::ValiderContenu($_POST['contenu']);
				} catch (Exception $e) { $tableauErreurs[] = $e->getMessage(); }

				try{
					Validation::ValiderDateParution($_POST['jour'], $_POST['mois'], $_POST['annee']);
					$dateParution = Nettoyage::CreateDate($_POST['jour'], $_POST['mois'], $_POST['annee']);
				} catch (Exception $e) { $tableauErreurs[] = $e->getMessage(); }


				if(!empty(trim($_POST['image']))){
					try{
						$_POST['image'] = Validation::ValiderNomImageArticle($_POST['image']);
					} catch (Exception $e) { $tableauErreurs[] = $e->getMessage(); }
				} else { $_POST['image'] = Nettoyage::CreateCheminPhotoArticle($_POST['image']); }


				if(empty($tableauErreurs)){
					$ModeleAdmin = new ModeleAdmin();
					$ModeleAdmin->AjouterArticle($_POST['titre'],$dateParution,$_POST['image'],$_POST['contenu']);
					$_REQUEST['action'] = "Accueil";
					$CtrlUser = new CtrlUser();
				} else {
					$d["tableauErreurs"] = $tableauErreurs;

					$this->set($d);
					$this->render('admin/vueAjoutArticle');
				}
			}
		}

		/* Function permettant de supprimer un Article et tout ce qui lui est associé en passant son id en paramètre */
		public function SupprimerArticle(){

			if(isset($_GET['idArticle'])){
				Validation::ValiderIdArticle($_GET['idArticle']);
				$ModeleAdmin = new ModeleAdmin();
				$ModeleAdmin->SupprimerArticle($_GET['idArticle']);
				$_REQUEST['action'] = "Accueil";
				$CtrlUser = new CtrlUser();
			}
		}

		/* Function qui affiche la fenetre de modification d'un article
			1 - Les informations du titre sont toutes passées par URL
			2 - Car on veut afficher ces informations par défaut dans le formulaire
				2.1 Il est necessaire de mettre chaque variable passé par URL dans une variable intermédiaire pour l'afficher dans le formulaire
				2.2 En effet s'il y a une erreur dans le formulaire, on rappelle celui-ci, or en le rappelant, on a plus accès à tout les $_GET => on ne peut pas afficher les $_GET directement*/
		public function AfficherFenetreModification(){

			if(isset($_GET['idArticle'],$_GET['titre'], $_GET['dateParution'],  $_GET['image'], $_GET['contenu'])){

				Validation::ValiderIdArticle($_GET['idArticle']);
				$idArticle = $_GET['idArticle'];
				Validation::ValiderTitre($_GET['titre']);


				$dateParution = Nettoyage::SplitDate($_GET['dateParution']);
				$jour = $dateParution['day'];
				$mois = $dateParution['month'];
				$annee = $dateParution['year'];
				Validation::ValiderDateParution($jour, $mois, $annee);
				$image = Nettoyage::ExtractNomPhotoFromPath($_GET['image']);

				/**
				* A recheck pour optimisation
				**/
				$d["idArticle"] = $idArticle;
				$d["titre"] = $_GET['titre'];
				$d["contenu"] = $_GET['contenu'];
				$d["jour"] = $jour;
				$d["mois"] = $mois;
				$d["annee"] = $annee;
				$d["image"] = $image;
				$d["tableauErreurs"] = $tableauErreurs;

				$this->set($d);
				$this->render('admin/vueModification');
			}
		}

		/*
		        Pensez à revalider le contenu !!
		Function permettant de modifier un article
			1 - On revalide tout ce qui a été entré par l'admin
			2 - Si une erreur est relevée on rappelle le formulaire de modification
				2.1 - On veut que le formulaire soit initaliser avec les informations de l'article à modifier
				2.2 - Il faut donc redéfinir quelles sont ces informations avant de rappeler le formulaire */
		public function ModifierArticle(){

			if(isset($_POST['idArticle'],$_POST['titre'], $_POST['jour'], $_POST['mois'], $_POST['annee'],  $_POST['image'],$_POST['contenu'])){

				Validation::ValiderIdArticle($_POST['idArticle']);
                if(isset($_POST['titre'], $_POST['jour'], $_POST['mois'], $_POST['annee'],  $_POST['image'],$_POST['contenu'])) {

                    try {
                        Validation::ValiderTitre($_POST['titre']);
                        $_POST['titre'] = Nettoyage::AjouterMajDebut($_POST['titre']);
                    } catch (Exception $e) {
                        $tableauErreurs[] = $e->getMessage();
                    }

                    try {
                        Validation::ValiderDateParution($_POST['jour'], $_POST['mois'], $_POST['annee']);
                        $dateParution = Nettoyage::CreateDate($_POST['jour'], $_POST['mois'], $_POST['annee']);
                    } catch (Exception $e) {
                        $tableauErreurs[] = $e->getMessage();
                    }


                    if (!empty(trim($_POST['image']))) {
                        try {
                            $_POST['image'] = Validation::ValiderNomImageArticle($_POST['image']);
                        } catch (Exception $e) {
                            $tableauErreurs[] = $e->getMessage();
                        }
                    } else {
                        $_POST['image'] = Nettoyage::CreateCheminPhotoArticle($_POST['image']);
                    }
                }

				if(empty($tableauErreurs)){
					$ModeleAdmin = new ModeleAdmin();
					$ModeleAdmin->ModifierArticle($_POST['idArticle'],$_POST['titre'],$dateParution, $_POST['image'],$_POST['contenu']);
					$_REQUEST['action'] = "Accueil";
					$CtrlUser = new CtrlUser();
				} else {
					extract($_POST);

					$d["idArticle"] = $idArticle;
					$d["titre"] = $_GET['titre'];
					$d["contenu"] = $_GET['contenu'];
					$d["jour"] = $jour;
					$d["mois"] = $mois;
					$d["annee"] = $annee;
					$d["image"] = $image;
					$d["tableauErreurs"] = $tableauErreurs;

					$this->set($d);
					$this->render('admin/vueModification');
				}
			}
		}

		/* Function permettant de supprimer un commentaire associé à un article et à une personne dont les id sont passé par URL */
		public function SupprimerCommentaire(){

			if(isset($_GET['idArticle'], $_GET['loginCommentaire'])){
				Validation::ValiderIdArticle($_GET['idArticle']);
				Validation::ValiderLogin($_GET['loginCommentaire']);
				$ModeleAdmin = new ModeleAdmin();
				$ModeleAdmin->SupprimerCommentaire($_GET['idArticle'], $_GET['loginCommentaire']);
				$_REQUEST['action'] = "AfficherDetails";
				$CtrlUser = new CtrlUser();
			}
		}

	}
?>
