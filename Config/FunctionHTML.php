<?php
function DebutFichierHTML(){
    ?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Notre site</title>

    <!-- Bootstrap core CSS -->
    <link href="./Vue/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  </head>

  <body>
    <?php
}


function FinFichierHTML(){
	?>
	  </body>
      <hr> <!-- le petit trait -->
      <footer >
      <div class="panel-footer text-center">
        <label> &copy Alexis Cardot & Quentin Laplanche</label>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript
        ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="./Vue/bootstrap/js/bootstrap.min.js"></script>

</html>
	<?php
}


?>
