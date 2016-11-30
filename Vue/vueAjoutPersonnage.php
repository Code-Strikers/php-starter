
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




<div class="container" >
    <link href="form.css" rel="stylesheet">


    <?php if(isset($tableauErreurs)){
        for($i = 0; $i < count($tableauErreurs); $i++){
            echo "<p class=\"alert-danger\">".$tableauErreurs[$i];
        }
    }
    ?>

    <form id="formAjouterPersonnage" class="form-signin" method="POST" action="./index.php">
            <input type='hidden' name='action' value='AjouterPersonnage'/>
            <h1 class="form-signin-heading"> Ajouter un personnage</h1>

            <div class="form-group"
                <label for="nom">Nom du personnage</label>
                <input type='text' name='nom' class="form-control" placeholder="Nom :  " required autofocus />
            </div>

            <div class="form-group"
                <label for="origine">Origine</label>
                <input type='text' name='origine' class="form-control" placeholder="Origine : " required/>
            </div>

            <div class="form-group"
                <label for="details">Details</label>
                <input type='text' name='details' class="form-control" placeholder="Détails : "  />
            </div>
            <div class="form-group"
                <label for="photo">Photo du personnage</label>
                <input type='text' name='photo'class="form-control"  placeholder="Photo (vide -> image par défault)" />
            </div>

            <input class="btn btn-primary" type='submit' value='Ajouter'/>
            <a href="./index.php?action=AfficherFenetreBiographie"><input class="btn btn-primary" type="button" value="Annuler"/></a>
        </form>
    </article>

</div>


