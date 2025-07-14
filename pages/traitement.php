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
        
        $email = $_SESSION['email'];
        insert_pdp($result['filename'], $email);
        echo 'Upload réussi !';
    }
}

if (isset($_POST['obj'], $_POST['cat'], $_FILES['fichier'])) {
    $nom = $_POST['obj'];
    $id_cat = $_POST['cat'];
    $id_membre = $_SESSION['id_membre'];


    $id_objet = insert_new_object($nom, $id_membre, $id_cat);

    if ($id_objet) {
    
        foreach ($_FILES['fichier']['tmp_name'] as $index => $tmp_name) {
            $file = [
                'name'     => $_FILES['fichier']['name'][$index],
                'type'     => $_FILES['fichier']['type'][$index],
                'tmp_name' => $tmp_name,
                'error'    => $_FILES['fichier']['error'][$index],
                'size'     => $_FILES['fichier']['size'][$index],
            ];

            $upload = uploadImage($file);

            if (isset($upload['success'])) {
                $nom_image = $upload['filename'];
               insert_img($nom_image,$id_objet);
            } else {
                echo "<p class='text-danger'>Erreur image : {$upload['error']}</p>";
            }
        }
        header('Location: liste.php');
        exit;
    }
}

?>
