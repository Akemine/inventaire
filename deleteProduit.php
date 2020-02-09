<?php
require('requete_inventaire.php');
echo "id = ".$_GET['id'];
deleteProduit($bdd, $_GET['id']);
header('Location: index.php'); 