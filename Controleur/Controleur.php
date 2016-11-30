<?php
/**
* Controller
**/
class Controleur{
	public $request;  				// Objet Request
	private $vars     = array();	// Variables à passer à la vue
	public $layout    = 'default';  // Layout à utiliser pour rendre la vue
	private $rendered = false;		// Si le rendu a été fait ou pas ?

	/**
	* Constructeur
	* @param $request Objet request de notre application
	**/
	function __construct($request){
		$this->request = $request; 	// On stock la request dans l'instance
	}


	/**
	* Permet de rendre une vue
	* @param $view Fichier à rendre (chemin depuis view ou nom de la vue)
	**/
	public function render($view){
		if($this->rendered){ return false; }
		extract($this->vars);

		$contentView = $this->vars;
		/*if(strpos($view,'/')===0){
			$view = ROOT.DS.'view'.$view.'.php';
		}else{
			$view = ROOT.DS.'view'.DS.$this->request->controller.DS.$view.'.php';
		}*/
		ob_start();
		require_once('./Vue/vueAccueil2.php');
		$content_for_layout = ob_get_clean();
		require('./Vue/vueLayout.php');
		$this->rendered = true;
	}


	/**
	* Permet de passer une ou plusieurs variable à la vue
	* @param $key nom de la variable OU tableau de variables
	* @param $value Valeur de la variable
	**/
	public function set($key,$value=null){
		if(is_array($key)){
			$this->vars += $key;
		}else{
			$this->vars[$key] = $value;
		}
	}
	/**
	* Permet de charger un model
	**/
	/*function loadModel($name){
		if(!isset($this->$name)){
			$file = ROOT.DS.'model'.DS.$name.'.php';
			require_once($file);
			$this->$name = new $name();

		}

	}
*/
	/**
	* Permet de gérer les erreurs 404
	**/
	/*function e404($message){
		header("HTTP/1.0 404 Not Found");
		$this->set('message',$message);
		$this->render('/errors/404');
		die();
	}
*/

}
?>
