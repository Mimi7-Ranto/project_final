<?php
session_start();
include("../inc/function.php");

if (isset($_POST['nom']) && isset($_POST['date_naissance']) && isset($_POST['genre']) && isset($_POST['email']) && isset($_POST['mdp'])) {
    $nom = $_POST['nom'];
    $date_naissance = $_POST['date_naissance'];
    $genre = $_POST['genre'];
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];

   
   $result= registerUser($nom, $date_naissance, $genre, $email ,$mdp);

    if ($result) {
        header('Location:login.php');
        exit;
    }
    

}

if(isset($_POST['email']) && isset($_POST['mdp'])){
    echo 'mety';
    $mdp = $_POST['mdp'];
    $email = $_POST['email'];
    if(loginUser($email,$mdp)){
        $_SESSION['email'] = $email;
        header('Location:liste.php');
    }else{
        header('Location:login.php?error=1');
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['fichier'])) {
    $result = uploadImage($_FILES['fichier']);

    if (isset($result['error'])) {
        die($result['error']);
    } else {
        // $result['filename'] contient le nom du fichier uploadé
        $email = $_SESSION['email'];
        insert_pdp($result['filename'], $email);
        echo 'Upload réussi !';
    }
}

if(isset($_POST['obj']) && isset($_POST['cat']) && isset($_FILES['fichier'])){
    $nom = $_POST['obj'];
    $id_cat = $_POST['cat'];
    $_SESSION['id_membre'] = $id_membre;
        insert_new_object($nom,$id_membre,$id_cat);
}
?>
