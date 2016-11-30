    <!-- Example row of columns -->
    <div class="row">

        <?php
        $listeArticles = $contentView;
        foreach ($listeArticles as $article){

          echo "<div class=\"col-md-4\">";
              echo "<h2>" . $article->getTitre() . "</h2>";
              echo "<p>".$article->getContenue()."</p>";
              echo " <a class=\"btn btn-default\" href=\"./index.php?action=AfficherDetails&idArticle=".$article->getId()."\" role=\"button\">Détails  &raquo;</a>";

                if(isset($_SESSION['role']) && strcmp($_SESSION['role'],"admin")==0){
                  echo "<a class=\"btn btn-default\" href=\"./index.php?action=AfficherFenetreModification
												&idArticle=".$article->getId()."
												&titre=".$article->getTitre()."
												&dateParution=".$article->getDateParution()."
												&contenu=".$article->getContenue()."
												&image=".$article->getImage()."\"
												title=\"Modifier l'article\">Modifier &raquo</a>";
                echo "<a class=\"btn btn-default\" href=\"./index.php?action=SupprimerArticle&idArticle=".$article->getId()."\" role=\"button\" onclick=\"return confirm('Voulez-vous vraiment supprimer cette article ?');\"> Supprimer  &raquo;</a>";

              }
              echo "</div>";
          }
            ?>


     </div>


		<?php
        $nbdepages = ceil($nbArticles/10);
		  for ($i = 1; $i <= $nbdepages; $i++){
			echo "<a class=\"text-center\" href=\"./index.php?action=SansAction&pageCourante=".$i."\">".$i."</a>";
        }
        ?>
