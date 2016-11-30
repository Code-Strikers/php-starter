<?php

/**
 * Created by PhpStorm.
 * User: Alexis
 * Date: 04/12/2015
 * Time: 14:57
 */
class Article
{


    private $id;
    private $titre;
    private $image;
    private $dateParution; /* date de mise en ligne de l'article */
    private $contenu;

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getTitre(){
        return $this->titre;
    }

    public function setTitre($titre){
        $this->titre = $titre;
    }

    public function getImage(){
        return $this->image;
    }

    public function setImage($image){
        $this->image = $image;
    }

    /* @brief Accesseur : obtenir la Période de la mise en ligne */
    public function getDateParution() {
        return $this -> dateParution;
    }

    /* @brief Setteur : pour modifier la periode de mise en ligne */
    public function setDateParution($dateParution) {
        $this->dateParution = $dateParution;
    }

    public function getContenue(){
        return $this->contenu;
    }

    public function setContenue($contenu){
        $this->contenu = $contenu;
    }

    public function __construct($id,$titre,$image,$dateParution,$contenu){
        $this->setId($id);
        $this->setTitre($titre);
        $this->setImage($image);
        $this->setDateParution($dateParution);
        $this->setContenue($contenu);
    }



}
