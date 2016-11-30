
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="./index.php"><?=$_SESSION['siteName']?></a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <?php if(isset($_SESSION['role'])){
                        if(strcmp($_SESSION['role'], "admin")==0){
                            echo "<li><p class=\"navbar-text\">Bonjour " . $_SESSION['login'] . " (Admin) </p></li> ";
                            echo "<li><a  href=\"./index.php?action=AfficherFenetreAjoutArticle\">Ajouter Article</a></li>";
                        } else if(strcmp($_SESSION['role'], "membre")==0){
                            echo "<li><p class=\"navbar-text\">Bonjour " . $_SESSION['login'] . " (Membre)</p></li> ";
                        }
                    }
                    ?>
                    <li><a href="./index.php?action=Accueil">Accueil</a></li>
                    <?php if(isset($_SESSION['login'])){
                        echo "<li><a href=\"./index.php?action=AfficherMonCompte\">Mon compte</a></li>";
                        echo "<li><a href=\"./index.php?action=SeDeconnecter\">Déconnexion</a></li>";
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
            <h1>Bienvenue !</h1>
            <p>Les fonctionnalités de ce projet vont vous épater, surtout la numéro 6 !!</p>
            <p><a class="btn btn-primary btn-lg" href="#" role="button">Aller voir »</a></p>
        </div>
    </div>

    <div class="container">
       <?php echo $content_for_layout; ?>

    </div> <!-- /container -->
