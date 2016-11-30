<?php

Class Commentaire{

	private $idArticle;
	private $login;
	private $corps;
	
	public function getIdArticle(){
		return $this->idArticle;
	}
	
	public function setIdArticle($id){
		$this->idArticle = $id;
	}
	
	public function getLogin(){
		return $this->login;
	}
	
	public function setLogin($id){
		$this->login = $id;
	}
	
	public function getCorps(){
		return $this->corps;
	}
	
	public function setCorps($corps){
		$this->corps = $corps;
	}
	
	public function __construct($id, $idm, $corps){
		$this->setIdArticle($id);
		$this->setLogin($idm);
		$this->setCorps($corps);
	}
}

?>