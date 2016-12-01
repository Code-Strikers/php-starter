<?php
session_name("BaseSite");
session_start();
$_SESSION["siteName"] = "Base Site";
Class FrontCtrl extends Controleur{

	public function __construct(){

		try{

			$tableauActionsMembre = array("SeConnecter", "SeDeconnecter", "AjouterCommentaire", "AfficherMonCompte", "ModifierPassword");												/*Tableaux des actions réalisables par un Membre & un Admin*/
			$tableauActionsAdmin = array("AfficherFenetreAjoutArticle", "AjouterArticle", "SupprimerArticle",  /*Tableaux des actions réalisables par un Admin*/
                                        "AfficherFenetreModification", "ModifierArticle", "SupprimerCommentaire");

			if(isset($_REQUEST['action'])){		/*Si il y a une action passé au FRONT CONTROLLER*/
				$action= $_REQUEST['action'];	/*On récupère l'action*/
			} else { $action = "Accueil"; }	/*Sinon on met une action par défaut SansAction (qui va afficher la page d'accueil avec les titres)*/

			if(in_array($action, $tableauActionsAdmin)){	/*Si c'est une action Admin*/

				$ModeleAdmin = new ModeleAdmin();
				$admin = $ModeleAdmin->IsAdmin();			/*On regarde si l'Admin est connecté*/

				if($admin == null){
					/*S'il n'est pas co, on appelle la page de connection*/
					$d["tableauErreurs"] = $tableauErreurs;
					$this->set($d);
					$this->render('vueConnexion');
				} else { $CtrlAdmin = new CtrlAdmin(); }	/*S'il est co, on appelle le CONTROLLER pour qu'il effectue son action passée en param*/
			}

			else if(in_array($action, $tableauActionsMembre)){		/*Sinon si c'est une action Membre*/

				if(strcmp($action, "SeConnecter") == 0){			/* Si c'est une action pour se connecter, on appelle le CONTROLLER direct */
					$CtrlMembre = new CtrlMembre();
				} else {											/*Si c'est une action autre que seConnecter*/
					$ModeleMembre = new ModeleMembre();
					if($ModeleMembre->isMembre()){					/*On regarde si le membre est connecté*/
						$CtrlMembre = new CtrlMembre();
					} else {										/* S'il n'est pas connecté */
						$ModeleAdmin = new ModeleAdmin();
						if($ModeleAdmin->isAdmin()){				/* On regarde si l'admin est connecté car il peut faire l'action du Membre */
							$CtrlMembre = new CtrlMembre();
						} else {
							$this->render('vueConnexion');
						}		/* Si personne n'est connecté on appelle la page de connexion */
					}
				}
			}

			else{ $CtrlUser = new CtrlUser(); }														/*Si ce n'est pas une action Admin ni Membre, c'est une action User*/

		} catch (Exception $e){
				$d["tableauErreurs"] = $tableauErreurs;
				$this->set($d);
				$this->render('erreurs/vueErreur');
		}/* Attrape les erreurs des CtrlAdmin, Membre, User*/
	}
}
?>
