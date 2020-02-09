<?php

require('connexion.php');


try
{
	$bdd = new PDO('mysql:host=localhost;dbname=inventaire;charset=utf8', 'Vlex', 'TerreEnFr!che');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}

    function foundMaxIdProduit($bdd){
        $reponse = $bdd->query('SELECT max(id_produit) as id_produit FROM produit');
        $donnees = $reponse->fetch();
        return $donnees;
    }

    function selectAllCategorie($bdd){
        $reponse = $bdd->query('SELECT * FROM categorie');
        $donnees = $reponse->fetchAll();
        return $donnees;
    }

    function selectAllFournisseur($bdd){
        $reponse = $bdd->query('SELECT * FROM fournisseur');
        $donnees = $reponse->fetchAll();
        return $donnees;
    }

    function selectAllMarque($bdd){
        $reponse = $bdd->query('SELECT * FROM marque');
        $donnees = $reponse->fetchAll();
        return $donnees;
    }

    function selectProduitByCategorie($bdd, $categorie){
        $reponse = $bdd->query("SELECT * FROM produit RIGHT JOIN produit_fournisseur 
        ON produit.id_produit = produit_fournisseur.id_produit 
        RIGHT JOIN fournisseur 
        ON fournisseur.id_fournisseur = produit_fournisseur.id_fournisseur 
        RIGHT JOIN categorie ON produit.id_categorie = categorie.id_categorie
        RIGHT JOIN marque ON marque.id_marque = produit_fournisseur.id_marque
        WHERE produit.id_categorie = $categorie
        GROUP BY produit.libelle_produit, marque.libelle_marque");
        $donnees = $reponse->fetchAll();
        return $donnees;
    }

    function updatePrixProduit($bdd, $id, $prix){
        $bdd->exec("UPDATE produit SET prixvente_produit = $prix where id_produit = $id");
    }

    function updateNombreProduit($bdd, $id, $nombre){
        $bdd->exec("UPDATE produit SET nombre_produit = $nombre where id_produit = $id");
    }

    function updatePrixFournisseur($bdd, $idproduit, $idfournisseur, $idmarque, $prixfournisseur){
        $bdd->exec("UPDATE produit_fournisseur SET prix_pf = $prixfournisseur where id_produit = $idproduit AND id_fournisseur = $idfournisseur AND id_marque = $idmarque");
    }


    function selectProduit($bdd){
        $reponse = $bdd->query("SELECT * FROM produit");
        $donnees = $reponse->fetchAll();
        return $donnees;
    }


    function ajouterProduit($bdd, $nom, $nombre, $dlc, $categorie, $marque, $prix, $update){
        $bdd->exec("INSERT INTO produit (libelle_produit, nombre_produit, DLC, id_categorie, id_marque, prixvente_produit, lastupdate_produit) VALUES ('$nom', $nombre, '$dlc', $categorie, $marque, $prix, '$update')");
    }
    function ajouterProduitFournisseur($bdd, $idproduit, $idfournisseur, $idmarque, $prixAchat){
        $bdd->exec("INSERT INTO produit_fournisseur (id_produit, id_fournisseur, id_marque, prix_pf) VALUES ($idproduit, $idfournisseur, $idmarque, $prixAchat)");
    }

    function deleteProduit($bdd, $id){
        $bdd->exec("DELETE FROM produit WHERE id_produit = $id");
    }

    function ajouterFournisseur($bdd, $nom){
        $bdd->exec("INSERT INTO fournisseur (libelle_fournisseur) VALUES ('$nom')");
    }



    function ajouterCategorie($bdd, $nom){
        $bdd->exec("INSERT INTO categorie (libelle_categorie) VALUES ('$nom')");
    }
    function updateCategorie($bdd, $id, $id_categorie){
        $bdd->exec("UPDATE produit SET id_categorie = $id_categorie WHERE id_produit = $id");
    }

    function DisplayProduitByFournisseur($bdd, $produit, $marque){
        $reponse = $bdd->query("SELECT * FROM produit 
        INNER JOIN produit_fournisseur 
        ON produit.id_produit = produit_fournisseur.id_produit 
        INNER JOIN fournisseur 
        ON fournisseur.id_fournisseur = produit_fournisseur.id_fournisseur
        INNER JOIN marque 
        ON marque.id_marque = produit_fournisseur.id_marque
        WHERE libelle_produit = '$produit' and libelle_marque = '$marque'
        ORDER by libelle_fournisseur");
        $donnees = $reponse->fetchAll();
        return $donnees;
    }

