    <link href="form.css" rel="stylesheet">

    <form class="form-signin" id="formModifier" method="POST" action="./index.php">
        <input type='hidden' name='action' value='ModifierPersonnage'/>
        <input type='hidden' name='idPersonnage' value='<?php echo $idPersonnage ?>'/>

        <div class="form-group">
            <label for="nom">Nom du Personnage :</label>
            <input type='text' name='nom' value='<?php echo $nom ?>' class="form-control" required autofocus />
        </div>
        <div class="form-group">
            <label for="origine">Origine :</label>
            <input type='text' name='origine' value='<?php echo $origine ?>'class="form-control" required />
        </div>
        <div class="form-group">
            <label for="detail">Détails :</label>
            <input type='text' name='detail' value='<?php echo $detail ?>'class="form-control" required/>
        </div>

        <div class="form-group">
            <label for="cheminPhoto">Photo :</label>
            <input type='text' name='cheminPhoto' value='<?php echo $image ?>' class="form-control" required/>
        </div>

        <button class="btn btn-primary  " type="submit">Modifier</button>
        <a href="./index.php?action=AfficherFenetreBiographie"><input class="btn btn-primary" type="button" value="Annuler"/></a>
    </form>
