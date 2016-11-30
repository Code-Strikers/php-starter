<div class="container">
    <link href="form.css" rel="stylesheet">
        <?php
        if(isset($listeDetailPersonnage)) {
            echo "<img class=\"center-block\" src=\"" . $listeDetailPersonnage['Personnage']->getPhoto() . "\" alt=\"image personnage\"> </img>";
           echo "<div class=\"template\">";
                echo "<h1>" . $listeDetailPersonnage['Personnage']->getNom() . "</h1>";
                echo "<p class=\"lead\">Origine :  " . $listeDetailPersonnage['Personnage']->getOrigine() ."</p>";
                echo "<p class=\"lead\" >Détails :  " . $listeDetailPersonnage['Personnage']->getContenue() . "</p>";
            echo "</div>";

        }
            ?>
</div>
