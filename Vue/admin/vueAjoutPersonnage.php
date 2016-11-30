    <link href="form.css" rel="stylesheet">

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
