<?php
include("header.php");

if(isset($_POST['nom'])){
    ajouterCategorie($bdd, $_POST['nom']);
}


?>
<div class="container">
<h2>Ajouter une catégorie</h2>
<form method='POST'>
    <div class="form-group">
        <label for="formGroupExampleInput">Nom de la catégorie</label><input type='text' class="form-control" name='nom' placeholder="nom de la catégorie">
    </div>
    <button type="submit" class="btn btn-primary mb-2">Ajouter</button>
    
</form>
<a href="index.php"><button type="submit" class="btn btn-danger mb-2">Retour à l'inventaire</button></a>
</div>
</body>
</div>

