
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="./index.php?action=SansAction">Dragon Ball ZZZZZZ</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <?php if(isset($_SESSION['role'])){
                    if(strcmp($_SESSION['role'], "admin")==0){
                        echo "<li><a href=\"./index.php?action=SansAction\"> Bonjour " . $_SESSION['login'] . " (Admin) </a></li> ";
                        echo "<li><a  href=\"./index.php?action=AfficherFenetreAjoutArticle\">Ajouter Article</a></li>";
                        echo "<li><a  href=\"./index.php?action=AfficherFenetreAjoutPersonnage\">Ajouter Personnage</a></li>";
                    } else if(strcmp($_SESSION['role'], "membre")==0){
                        echo "<li><a href=\"./index.php?action=SansAction\"> Bonjour " . $_SESSION['login'] . " (Membre) </a></li> ";
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
   <?php echo $content_for_layout; ?>

</div> <!-- /container -->
