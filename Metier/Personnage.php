<?php

/**
 * Created by PhpStorm.
 * User: Alexis
 * Date: 02/01/2016
 * Time: 18:40
 */
class Personnage
{
    private $id;
    private $nom;
    private $origine; /* Période de la mise en ligne du titre */
    private $contenu;
    private $photo;

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getNom(){
        return $this->nom;
    }

    public function setNom($nom){
        $this->nom = $nom;
    }

    /* @brief Accesseur : obtenir la Période de la mise en ligne */
    public function getOrigine() {
        return $this -> origine;
    }

    /* @brief Setteur : pour modifier la periode de mise en ligne */
    public function setOrigine($origine) {
        $this->origine = $origine;
    }

    public function getContenue(){
        return $this->contenu;
    }

    public function setContenue($contenu){
        $this->contenu = $contenu;
    }

    public function getPhoto(){
        return $this->photo;
    }

    public function setPhoto($photo){
        $this->photo = $photo;
    }

    public function __construct($id,$titre,$origine,$contenu,$image){
        $this->setId($id);
        $this->setNom($titre);
        $this->setOrigine($origine);
        $this->setContenue($contenu);
        $this->setPhoto($image);
    }
}
