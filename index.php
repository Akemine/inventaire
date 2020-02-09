<?php
include("header.php");
?>
<div class="container">
<p><button class="btn btn-success"><a href="ajoutProduit.php">Ajouter des produits en bases</a></button>

<button class="btn btn-info"><a href="ajoutCategorie.php">Ajouter des catégories en bases</button></a>
<button class="btn btn-dark"><a href="ajoutFournisseur.php">Ajouter des fournisseurs en bases</button></a></p>
</div>
<div class="container">
<div>
<h1 align="center">Inventaire du magasin</h1>
</div>
    <div class="row">
        
            <div class="col-md-12">
<?php

if(isset($_POST['prix'])){
    updatePrixProduit($bdd, $_POST['id'], $_POST['prix']);
}

if(isset($_POST['nombre'])){
    updateNombreProduit($bdd, $_POST['id'], $_POST['nombre']);
}

if(isset($_POST['prixPf'])){
    updatePrixFournisseur($bdd, $_POST['idproduit'], $_POST['idfournisseur'], $_POST['idmarque'],  $_POST['prixPf']);
}


$categorie = selectAllCategorie($bdd);
?>

<?php
foreach($categorie as $cat){
    $data = selectProduitByCategorie($bdd, $cat['id_categorie']);
    echo "<div>";
    echo "<h2>". $cat['libelle_categorie'] ."</h2>";
    
    ?>
    <table class="table display table_id tableColor">
    <thead>
    <tr>
    <th> Produit </th>
    <th> Edit prix </th>
    <th> Edit nombre </th>
    <th> Total </th>
    <th> DLC </th>
    <th> Action </th>
    <th> FRS </th>
    <th> LAST MAJ </th>


    </tr>
    </thead>
    <tbody>
    <?php
    
    foreach($data as $item){
        ?>
        
        <?php
        echo "<tr>";
        echo "<td >". $item['libelle_produit'] ."<br/>".$item['libelle_marque'] ."</td>";;
        echo "<td ><form method='POST'><input type='text' size='5' name='prix' placeholder='".$item['prixvente_produit']."€'><input type='hidden' name='id' value=".$item['id_produit']."></form></td>";
        echo "<td ><form method='POST'><input type='text' size='5' name='nombre' placeholder='".$item['nombre_produit']."'><input type='hidden' name='id' value=".$item['id_produit']."></form></td>";
        echo "<td >". $item['nombre_produit']*$item['prixvente_produit'] ."€</td>";
        echo "<td >". $item['DLC'] ."</td>";
        echo '<td>
        <a href="updateCategorie.php?id='.$item['id_produit'].'&categorie='.$cat['libelle_categorie'].'"><i class="fa fa-edit edit"></i></a>
        <a href="deleteProduit.php?id='.$item['id_produit'].'" onclick="return ConfirmDelete();"><i class="fa fa-trash bin"></i></a> 
        <a href="ajoutPrixFournisseur.php?idproduit='.$item['id_produit'].'&marque='.$item['libelle_marque'].'&produit='.$item['libelle_produit'].'&idmarque='.$item['id_marque'].'"><i class="fa fa-truck truck"></i></a>
        </td>';
        ?>
        <td>
        <table class="table">
        <tr>
                <th scope="row" class="tableMoreEffet">Fournisseur</th>
                <th scope="row" class="tableMoreEffet">Reference</th>
                <th scope="row" class="tableMoreEffet">Edit prix</th>
                <th scope="row" class="tableMoreEffet">Difference</th>
        </tr>
        <?php
        $produitByFournisseur = DisplayProduitByFournisseur($bdd, $item['libelle_produit'], $item['libelle_marque']);
        $arrayPrice = array();
        //echo count($produitByFournisseur);

        foreach($produitByFournisseur as $produit){
            $arrayDifference[] = $produit['prixvente_produit'] - $produit['prix_pf'];
        }
        $maxValue = maxValue($arrayDifference);
        $arrayDifference = array();

        //var_dump($arrayDifference);
        //echo $maxValue;

        foreach($produitByFournisseur as $produit){
            ?>
            <tr>
            <?php 
            if($maxValue ==  $produit['prixvente_produit'] - $produit['prix_pf'])
            {
                ?> 
                <td class="maxValue"><?php echo $produit['libelle_fournisseur'] ?></td>
                <td class="maxValue"><?php echo $produit['reference_fournisseur'] ?></td>
                <?php echo "<td class='maxValue'><form method='POST'><input type='text' size='5' name='prixPf' placeholder='".$produit['prix_pf']."€'></td>
                <input type='hidden' name='idproduit' value=".$produit['id_produit']."></td>
                <input type='hidden' name='idfournisseur' value=".$produit['id_fournisseur']."></td>
                <input type='hidden' name='idmarque' value=".$produit['id_marque']."></form></td>";?>
                <td class="maxValue"><?php echo $produit['prixvente_produit'] - $produit['prix_pf'];  ?>€</td> 
                <?php
            }
            else {
                ?> 
                <td scope="row"><?php echo $produit['libelle_fournisseur'] ?></td>
                <td><?php echo $produit['reference_fournisseur'] ?></td>
                <?php echo "<td ><form method='POST'><input type='text' size='5' name='prixPf' placeholder='".$produit['prix_pf']."€'></td>
                <input type='hidden' name='idproduit' value=".$produit['id_produit']."></td>
                <input type='hidden' name='idfournisseur' value=".$produit['id_fournisseur']."></td>
                <input type='hidden' name='idmarque' value=".$produit['id_marque']."></form></td>";?>
                <td><?php echo $produit['prixvente_produit'] - $produit['prix_pf'];  ?>€</td> <?php
                }
                ?>
            </tr>
            <?php
        }
        ?>
            </table>
            </td>
      <?php
        echo "<td>". $item['lastupdate_produit'] ."</td>";
        echo "</tr>";
        
        
        
    }
    ?>
    </tbody>
    </table>
    </div>
    <?php
}
?>
</div>
</div>


<script>
function ConfirmDelete()
{
  var x = confirm("Voulez-vous supprimer cet article ?");
  if (x)
        return true;
  else
        return false;
}
</script>

</div>
</div>

<div class="footer">
Fait par système métrique pour terre en friche
</div>

</div>
</body>
</html>







