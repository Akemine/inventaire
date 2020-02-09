<?php
include("header.php");
if ((isset($_GET['produit']))){
    $_SESSION['produit'] = $_GET['produit'];
    $_SESSION['marque'] = $_GET['marque'];
    $_SESSION['id_produit'] = $_GET['idproduit'];
    $_SESSION['id_marque'] = $_GET['idmarque'];
}


if(isset($_POST['fournisseur']) && (isset($_POST['prixAchat']))){
    ajouterProduitFournisseur($bdd, $_SESSION['id_produit'], $_POST['fournisseur'], $_SESSION['id_marque'], $_POST['prixAchat']);
    // echo $_SESSION['id_produit'];
    // echo $_POST['fournisseur'];
    // echo $_SESSION['id_marque'];
    // echo $_POST['prixAchat'];
}

if(isset($_POST['prixPf'])){
    updatePrixFournisseur($bdd, $_POST['idproduit'], $_POST['idfournisseur'], $_POST['idmarque'],  $_POST['prixPf']);
}

$produit = selectProduit($bdd);
$fournisseur = selectAllFournisseur($bdd);
$SesFournisseur = DisplayProduitByFournisseur($bdd, $_SESSION['produit'], $_SESSION['marque'])
?>
<div class="container">
    <div class="row">
        <div class="col-md-6">
    <?php
    echo "<div><h4><span class='MoreVision'>".$_SESSION['produit']."</span> 
    de la marque <span class='MoreVision'>".$_SESSION['marque']."</span></h4></div>";
    ?>
<form method="POST">
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
        <label>Prix d'achat</label>
        <input type="text" placeholder="Prix d'achat" name="prixAchat"> 
    </div>  
<button type="submit" class="btn btn-primary mb-2">Ajouter le prix du fournisseur</button>
</form>
<a href="index.php"><button type="submit" class="btn btn-danger mb-2">Retour à l'inventaire</button></a>
</div>
<div class="col-md-6">
<table class="table">
    <tr>
            <th class="tableMoreEffet" scope="row">Fournisseur</th>
            <th class="tableMoreEffet" scope="row">Reference</th>
            <th class="tableMoreEffet" scope="row">Prix</th>
    </tr>
    <?php
    $produitByFournisseur = DisplayProduitByFournisseur($bdd, $_SESSION['produit'], $_SESSION['marque']);

    foreach($produitByFournisseur as $produit){
        $arrayDifference[] = $produit['prixvente_produit'] - $produit['prix_pf'];
    }
    $maxValue = maxValue($arrayDifference);
    $arrayDifference = array();
    
    foreach($SesFournisseur as $produit){
        ?> <tr> <?php
        if($maxValue ==  $produit['prixvente_produit'] - $produit['prix_pf'])
        {   
        ?>
            <td class="maxValue" scope="row"><?php echo $produit['libelle_fournisseur'] ?></td>
            <td class="maxValue"><?php echo $produit['reference_fournisseur'] ?></td>
            <?php echo "<td class='maxValue'><form method='POST'><input type='text' size='5' name='prixPf' placeholder='".$produit['prix_pf']."€'></td>
                <input type='hidden' name='idproduit' value=".$produit['id_produit']."></td>
                <input type='hidden' name='idfournisseur' value=".$produit['id_fournisseur']."></td>
                <input type='hidden' name='idmarque' value=".$produit['id_marque']."></form></td>";?>
        <?php
        }
        else 
        {
            ?>
            <td scope="row"><?php echo $produit['libelle_fournisseur'] ?></td>
            <td><?php echo $produit['reference_fournisseur'] ?></td>
            <?php echo "<td><form method='POST'><input type='text' size='5' name='prixPf' placeholder='".$produit['prix_pf']."€'></td>
                <input type='hidden' name='idproduit' value=".$produit['id_produit']."></td>
                <input type='hidden' name='idfournisseur' value=".$produit['id_fournisseur']."></td>
                <input type='hidden' name='idmarque' value=".$produit['id_marque']."></form></td>";?>
            <?php
        }
        ?> </tr> <?php
    }
    ?>
    
    </table>
    </div>
         </div>
</div>

