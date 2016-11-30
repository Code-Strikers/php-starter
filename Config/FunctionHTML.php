<?php
function DebutFichierHTML(){
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=$_SESSION["siteName"]?></title>

    <!-- Bootstrap core CSS -->
    <link href="./Vue/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="./Vue/styles/style.css" rel="stylesheet">
  </head>

  <body>
    <?php
}


function FinFichierHTML(){
	?>
    <hr> <!-- le petit trait -->
    <footer>
      <div class="panel-footer text-center">
        <label>Code Strikers | Nuit de l'info 2016</label>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript
        ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="./Vue/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
	<?php
}
?>
