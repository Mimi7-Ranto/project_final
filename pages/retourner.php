<?php
session_start();
include("../inc/function.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_emprunt'], $_POST['etat']) && isset($_GET['id'])) {
    $id_emprunt = (int)$_POST['id_emprunt'];
    $etat = ($_POST['etat'] === 'abime') ? 'abime' : 'ok';
    $id_objet = (int)$_GET['id'];

 
    $sql = "UPDATE emprunt_emprunt 
            SET date_retour = NOW()
            WHERE id_emprunt = $id_emprunt AND date_retour IS NULL";
    if (!mysqli_query(dbconnect(), $sql)) {
        echo "Erreur SQL emprunt : " . mysqli_error(dbconnect());
        exit;
    }

    if ($etat === 'abime') {
        $sql_objet = "UPDATE emprunt_objet 
                      SET etat = 'abime' 
                      WHERE id_objet = $id_objet";
        if (!mysqli_query(dbconnect(), $sql_objet)) {
            echo "Erreur SQL objet : " . mysqli_error(dbconnect());
            exit;
        }
    }

    header('Location: fiche_objet.php?id=' . $id_objet);
    exit;
} else {
    echo "Requête invalide ou données manquantes.";
}
