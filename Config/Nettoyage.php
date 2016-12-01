<?php

	Class Nettoyage{

		/* Function qui ajoute une majuscule au début d'une chaine caractère */
		public static function AjouterMajDebut($chaine){

			if(isset($chaine)){
				return ucfirst($chaine);
			}
		}

		/* Function retournant une date sous forme de chaine caractère en passant le jour, le mois et l'annee en paramètre */
		public static function CreateDate($jour, $mois, $annee){

			return $annee.'-'.$mois.'-'.$jour;
		}

		/* Function qui retourne une date passée sous forme de chaine caractère en un tableau afin de dissocier le jour, le mois et l'année */
		public static function SplitDate($date){

			if(isset($date)){
				return date_parse($date);
			}
		}

		/* Function qui retourne le chemin absolu d'une photo d'un article en passant son nom en paramètre */
		public static function CreateCheminPhotoArticle($nomPhoto){

			if(isset($nomPhoto) && !empty($nomPhoto)){
				return "./Vue/Image/imageArticle/".$nomPhoto;
			} else { return "./Vue/Image/imageArticle/Inconnu.jpg"; }
		}

		/* Function qui retourne le nom d'une photo en passant son chemin absolu en paramètre
			25 est le nombre de caracteres avant le nom de l'image dans le chemin absolu
		*/
		public static function ExtractNomPhotoFromPath($chaine){

			if(isset($chaine)){
				return substr($chaine, 25);
			}
		}
	}
?>
