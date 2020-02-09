<?php
include("header.php");
$categorie = selectAllCategorie($bdd);

if(isset($_POST['categorie'])){
    updateCategorie($bdd, $_GET['id'], $_POST['categorie']);
}


?>
<div class="container">
<h2>Changer la catégorie</h2>
<form method='POST'>
    <div class="form-group">
        <label>Catégorie</label>
        <select class="form-control form-control-sm" name='categorie'>
        <option selected disabled value=''>Votre ancienne catégorie était : <?php echo $_GET['categorie']; ?></option>
            <?php foreach($categorie as $cat){
                echo "<option value='".$cat['id_categorie']."'>".$cat['libelle_categorie']."</option>";
            }
            ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary mb-2">Modifier</button>
</form>
<a href="index.php"><button type="submit" class="btn btn-danger mb-2">Retour à l'inventaire</button></a>
</div>
</body>
</div>

