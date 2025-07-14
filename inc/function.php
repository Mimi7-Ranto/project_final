<?php
require('connection.php');

function registerUser($nom, $date_naissance, $genre, $email, $mdp) {
    $sql = "INSERT INTO emprunt_membre (nom, date_naissance, gender, email, mots_de_passe,img_prpfile)
         VALUES ('%s', '%s', '%s', '%s', '%s',null)";
    $sql = sprintf($sql,$nom, $date_naissance, $genre, $email, $mdp);
    $result = mysqli_query(dbconnect(), $sql);

   
}

function loginUser($email, $mdp) {
    $sql = "SELECT * FROM emprunt_membre WHERE email = '%s'AND mots_de_passe='%s'";
    $sql = sprintf($sql , $email ,  $mdp);
    $result = mysqli_query(dbconnect(), $sql);
    if ($row = mysqli_fetch_assoc($result)) {
        if ($mdp === $row['mots_de_passe']) {
            return $row;
        }
    }
    return false;
}


function get_info($email){
       $sql = "SELECT * FROM emprunt_membre WHERE email = '%s'";
    $sql = sprintf($sql , $email);
    $result = mysqli_query(dbconnect(), $sql);
    if ($row = mysqli_fetch_assoc($result)) {
        return $row;
    }
    return false;
}



function getCategories() {
    
    $sql = "SELECT * FROM emprunt_categorie_objet";
    $result = mysqli_query(dbconnect(), $sql);
    $categories = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $categories[] = $row;
    }
    return $categories;
}

function getObjets($categorie_id = null) {
    

    if ($categorie_id) {
        $sql = sprintf(
            "SELECT * FROM v_objets_emprunts WHERE id_categorie = %d",
            $categorie_id
        );
    } else {
        $sql = "SELECT * FROM v_objets_emprunts ";
    }

    $result = mysqli_query(dbconnect(), $sql);
    $objets = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $objets[] = $row;
    }
    return $objets;
}

function isEmprunte($id_objet) {
    $sql =   "SELECT * FROM emprunt_emprunt WHERE id_objet = %d AND (date_retour IS NULL OR date_retour > NOW()) LIMIT 1";
    $sql = sprintf($sql, $id_objet);
    
    $result = mysqli_query(dbconnect(), $sql);
    return mysqli_fetch_assoc($result);
}

function get_date_retour($id_objet){
    $sql =     $sql ="SELECT date_retour FROM emprunt_emprunt WHERE id_objet = %d ORDER BY date_emprunt DESC LIMIT 1";
    $sql = sprintf($sql , $id_objet);
    $result = mysqli_query(dbconnect(), $sql);
    return mysqli_fetch_assoc($result);
}

function insert_pdp($image , $email){
    $sql = "UPDATE emprunt_membre 
        SET img_prpfile = '%s' WHERE email = '%s'";
    $sql = sprintf($sql,$image,$email );
    $result = mysqli_query(dbconnect(), $sql);     
}

function get_categorie(){
    $sql = "SELECT * FROM emprunt_categorie_objet";
    $result = mysqli_query(dbconnect(), $sql);
    $cat = array();
    if($result){
        while($row = mysqli_fetch_assoc($result)){
            $cat[] = $row;
        }
        return $cat;

    }
    return $cat;
}

function insert_new_object($nom,$id_membre,$id_cat){
    $sql = "INSERT INTO emprunt_objet (nom_objet,id_membre,id_categorie)
    VALUES('%s','%s','%s')";
    $sql = sprintf($sql,$nom,$id_membre,$id_cat);
       $result = mysqli_query(dbconnect(), $sql);
}
/*function emprunterObjet($id_objet, $id_membre) {
    
    $sql = sprintf("INSERT INTO emprunt_emprunt (id_objet, id_membre, date_emprunt) VALUES (%d, %d, NOW())",
        $id_objet, $id_membre
    );
    return mysqli_query(dbconnect(), $sql);
}

function retournerObjet($id_objet) {
    
    $sql = sprintf("UPDATE emprunt_emprunt SET date_retour = NOW() WHERE id_objet = %d AND date_retour IS NULL", $id_objet);
    return mysqli_query(dbconnect(), $sql);
}


function getImagesObjet($id_objet) {
    
    $sql = sprintf("SELECT nom_image FROM emprunt_image WHERE id_objet = %d", $id_objet);
    $result = mysqli_query(dbconnect(), $sql);
    $images = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $images[] = $row['nom_image'];
    }
    return $images;
}*/


?>
