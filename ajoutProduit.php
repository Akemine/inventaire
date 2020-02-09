<?php

include("header.php");
$categorie = selectAllCategorie($bdd);
$fournisseur = selectAllFournisseur($bdd);
$marque = selectAllMarque($bdd);
$dateUpdate = date('d/m/Y');

if(isset($_POST['nom'])
    && isset($_POST['prix'])
    && isset($_POST['nombre'])
    && isset($_POST['categorie'])
    && isset($_POST['DLC'])
    && isset($_POST['fournisseur'])
    && isset($_POST['marque'])
    && isset($_POST['prixAchat'])){
        ajouterProduit($bdd, $_POST['nom'], $_POST['nombre'], $_POST['DLC'], $_POST['categorie'], $_POST['marque'], $_POST['prix'], $dateUpdate);
        $maxId = foundMaxIdProduit($bdd);
        ajouterProduitFournisseur($bdd, $maxId['id_produit'], $_POST['fournisseur'], $_POST['marque'], $_POST['prixAchat']);
        // echo "nom :".$_POST['nom'];
        // echo "<br/>";
        // echo "prix vente :".$_POST['prix'];
        // echo "<br/>";
        // echo "nombre :".$_POST['nombre'];
        // echo "<br/>";
        // echo "cat : ".$_POST['categorie'];
        // echo "<br/>";
        // echo "frs :".$_POST['fournisseur'];
        // echo "<br/>";
        // echo "mar :".$_POST['marque'];
        // echo "<br/>";
        // echo "prix achat :".$_POST['prixAchat'];
        // echo "<br/>";
        // echo "max id : ".$maxId['id_produit'];
        // echo "<br/>";
        // echo "date update : ".$dateUpdate;
    }



?>
<div class="container">
<h2>Ajouter un produit</h2>
<form method='POST'>
    <div class="form-group">
        <label for="formGroupExampleInput">Nom du produit</label><input type='text' class="form-control" name='nom' placeholder="nom du produit">
    </div>
    <div class="form-group">
        <label>Prix de vente</label><input type='text' class="form-control" name='prix' placeholder="Prix de vente">
    </div>
    <div class="form-group">
        <label>Nombre de ce produit</label><input type='text' class="form-control" name='nombre' placeholder="nombre de ce produit">
    </div>
    <div class="form-group">
        <label>DLC</label><input type='text' class="form-control" name='DLC' placeholder="Date limite de consommation Ex: 25/01/2020">
    </div>
    <div class="form-group">
        <label>Catégorie</label>
        <select class="form-control form-control-sm" name='categorie'>
            <?php foreach($categorie as $cat){
                echo "<option value='".$cat['id_categorie']."'>".$cat['libelle_categorie']."</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label>Fournisseur</label>
        <select class="form-control form-control-sm" name='fournisseur'>
            <?php foreach($fournisseur as $frs){
                echo "<option value='".$frs['id_fournisseur']."'>".$frs['libelle_fournisseur']."</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label>Prix d'achat de ce fournisseur</label><input type='text' class="form-control" name='prixAchat' placeholder="Prix d'achat">
    </div>
    <div class="form-group">
        <label>Marque</label>
        <select class="form-control form-control-sm" name='marque'>
            <?php foreach($marque as $mar){
                echo "<option value='".$mar['id_marque']."'>".$mar['libelle_marque']."</option>";
            }
            ?>
        </select>
    </div>

    <button type="submit" class="btn btn-primary mb-2">Ajouter</button>
    
</form>
<a href="index.php"><button type="submit" class="btn btn-danger mb-2">Retour à l'inventaire</button></a>
</div>
</body>
</div>

