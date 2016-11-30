<?php
	class ClassBD{
	
		private static $sdbh = null;
		private static $instance = null;
		
		private function __construct(){
			
			require('./Config/config.php');
			$db_name = 'mysql:host=localhost;dbname='.$base.'';
			$db_user = $login;
			$db_password = $mdp;
			
			self::$sdbh = new PDO($db_name, $db_user, $db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
		}
		
		public static function getInstance(){
	
			if(self::$instance == null)
				self::$instance = new self;
			return self::$instance;
		}
		
		public static function destructInstance(){
		
			if(self::$instance != null){
				unset($sdbh);
				unset($instance);
			}
		}
		
		public function query($requete, $param){
		
			$statement = self::$sdbh->prepare($requete); //Prépare une requête à l'exécution et retourne un objet 
			if($statement == false)
				return false;
		
			if(isset($param))
			{
				for($i = 1; $i <= count($param); $i++)
				{
					$statement->bindParam($i,$param[$i][0],$param[$i][1]);	// bindParam Lie un paramètre à un nom de variable spécifique 
				}		
				$statement->execute(); // Exécute une requête préparée 
				return $statement;
			}
		}
		
		public function getResults($statement){
		
			return $statement->fetchAll(); // Retourne un tableau contenant toutes les lignes du jeu d'enregistrements
		}
}

?>