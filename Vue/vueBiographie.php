
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="./index.php?action=SansAction">Dragon Ball Z</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <?php if(isset($_SESSION['role'])){
                    if(strcmp($_SESSION['role'], "admin")==0){
                        echo "<li><a href=\"./index.php?action=SansAction\"> Bonjour " . $_SESSION['login'] . " (Admin) </a></li> ";
                        echo "<li><a  href=\"./index.php?action=AfficherFenetreAjoutArticle\">Ajouter Article</a></li>";
                        echo "<li><a  href=\"./index.php?action=AfficherFenetreAjoutPersonnage\">Ajouter Personnage</a></li>";
                    } else if(strcmp($_SESSION['role'], "membre")==0){
                        echo "<li id=\"bonjourLogin\"> Bonjour " . $_SESSION['login'] . " </li>";
                    }
                }
                ?>
                <li><a href="./index.php?action=SansAction">Accueil</a></li>
                <li><a href="./index.php?action=AfficherFenetreBiographie">Biographie</a></li>
                <?php if(isset($_SESSION['login'])){
                    echo "<li><a href=\"./index.php?action=SeDeconnecter\">Déconnexion</a></li>";
                    echo "<li><a href=\"./index.php?action=AfficherMonCompte\">Mon compte</a></li>";
                } else {
                    echo "<li><a href=\"./index.php?action=AfficherFenetreInscription\">Inscription</a></li>";
                    echo "<li><a href=\"./index.php?action=AfficherFenetreConnexion\">Connexion</a></li>";
                }
                ?>
            </ul>
        </div><!--/.navbar-collapse -->
    </div>
</nav>

<div class="jumbotron">
    <div class="container">
        <h1 class="text-center">DBZ Actu</h1>
        <img src="./Vue/Image/banniere.jpeg">
    </div>
</div>

<div class="container">
    <h1 class="text-center"> Biographie </h1>
    <br/>
    <br/>

    <h2 class="text-center"> L'histoire : </h2>
    <br/>
    <br/>

    <div class="container">
      <p class="text-center">Dragon Ball Z (ドラゴンボールZ(ゼット) dit Doragon Bōru Zetto) est une série télévisée d'animation japonaise adaptée de la
        franchise Dragon Ball d'Akira Toriyama et produite par Toei Animation. Cette série fait suite à l'anime Dragon
        Ball et adapte les vingt-six derniers volumes du manga, publiés de 1989 à 1995.

        La série a été initialement diffusée le 26 avril 1989 sur Fuji Television, au Japon. Elle a remplacé l'heure de
        diffusion de son prédécesseur et a été diffusée en 291 épisodes de 25 minutes jusqu'à la dernière diffusion le
        31 janvier 1996. Une version remastérisée et remontée en 159 épisodes, intitulée Dragon Ball Z Kai, a été
        diffusée du 5 avril 2009 au 28 juin 2015.

        Une suite, intitulée Dragon Ball GT, a été diffusée du 7 février 1996 au 19 novembre 1997. Une suite directe au
        manga, intitulée Dragon Ball Super, est diffusée depuis le 5 juillet 2015 sur Fuji TV.
      </p>

        <br/>

      <p class="text-center"> La série japonaise est la suite de la série Dragon Ball. Toujours adapté du manga du dessinateur Akira Toriyama.
        Cette partie de l'histoire de Sangoku est beaucoup plus longue : 25 tomes et une adaptation en 291 épisodes.
        Cette adaptation comporte beaucoup d'écarts par rapport à l'histoire originale ainsi que de nombreux
        ralentissements dans l'aventure qui casse le rythme par rapport au manga. L'histoire se découpe en trois parties
        bien distinctes :

        Le combat sur la planète Namek contre Freezer
        La partie avec les cyborgs et Cell
        La dernière partie contre Boo

        La première diffusion en france a lieu sur la chaîne TF1 à partir du 24 décembre 1990 dans l'émission le club
        Dorothée. La série est malheureusement censuré à cause de la violence de certains combats alors que l'émission
        s'adresse principalement à un jeune public. Depuis Dragon Ball a été rediffusé sur de nombreuses chaînes du
        satellite et du cable notamment sur les chaînes Mangas, AB1, MCM, RTL9 et NT1.
      </p>

      <br/>
      <br/>
    </div>
    <div class="container">
        <h1 class="text-center">Les Personnages </h1>
      <div class="row">
    <?php

    if(isset($listePersonnage)) {
        foreach ($listePersonnage as $personnage) {
          echo "<div class=\"col-md-4\">";
            echo "<p><a href=\"./index.php?action=AfficherDetailsPersonnage&idPersonnage=" . $personnage->getId() . "\" title=\"Details du personnage\">";
            echo "<img src=\"" . $personnage->getPhoto() . "\" alt=\"image Personnage\" </img>";
            echo "</p></a>";


            if (isset($_SESSION['role']) && strcmp($_SESSION['role'], "admin") == 0) {

                echo "<a class=\"btn btn-default\" href=\"./index.php?action=SupprimerPersonnage&idPersonnage=" . $personnage->getId() . "\" onclick=\"return confirm('Voulez-vous vraiment supprimer ce personnage ?');\" title=\"Supprimer le personnage\"> Supprimer</a>";
                echo "<a class=\"btn btn-default\" href=\"./index.php?action=AfficherFenetreModificationPersonnage
												&idPersonnage=" . $personnage->getId() . "
												&nom=" . $personnage->getNom() . "
												&origine=" . $personnage->getOrigine() . "
												&detail=" . $personnage->getContenue() . "
												&cheminPhoto=" . $personnage->getPhoto() . "\"
												title=\"Modifier le titre\">Modifier</a>";

            }
            echo "</div>";
        }
    }
    ?>
      </div>
    </div>




