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


if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['fichier'])){
    echo 'mety' ;

$uploadDir = '../assets/image/';
$maxSize = 2 * 1024 * 1024 ;
$allowedMimeTypes = ['image/jpeg', 'image/png'];

 if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['fichier'])) { 
    $file = $_FILES['fichier']; 
if ($file['error'] !== UPLOAD_ERR_OK) { 
die('Erreur lors de l’upload : ' . $file['error']); 
    } 

if ($file['size'] > $maxSize) { 
die('Le fichier est trop volumineux.');
}

$finfo = finfo_open(FILEINFO_MIME_TYPE); 
    $mime = finfo_file($finfo, $file['tmp_name']); 
    finfo_close($finfo); 
if (!in_array($mime, $allowedMimeTypes)) { 
die('Type de fichier non autorisé : ' . $mime); 
    } 

    $originalName = pathinfo($file['name'], PATHINFO_FILENAME); 
$extension = pathinfo($file['name'], PATHINFO_EXTENSION); 
    $newName = $originalName . '_' . uniqid() . '.' . $extension; 
    $email =  $_SESSION['email'];
    insert_pdp($newName , $email);
header('Location:profil.php?succes=1');

 }
}

if(isset($_POST['obj']) && isset($_POST['cat']) && isset($_POST['fichier'])){
    $nom = $_POST['obj'];
    $id_cat = 
    insert_new_object();
}
?>
