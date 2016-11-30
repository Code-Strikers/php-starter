<?php 

class Autoloader{

	private static $instance = null;
	
	public static function getInstance(){
		if(self::$instance == null)
				self::$instance = new self;
		return self::$instance;
	}
	
	public static function autoload($fichiers){
			
		foreach($fichiers as $fichier){
			$nomFichiers[] = $fichier.'.php';
		}
		$dir = array('./Config/','./Modele/','./Controleur/', './Metier/','./Persistance/', './Vue/');
		
		foreach($nomFichiers as $nomFichier){
			foreach($dir as $d){
				$file = $d.$nomFichier;
				if(file_exists($file)){
					require $file;
				}
			}
		}
	}
}
?>