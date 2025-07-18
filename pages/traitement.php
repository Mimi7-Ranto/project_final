<?php
session_start();
include("../inc/function.php");

if (isset($_POST['nom']) && isset($_POST['date_naissance']) && isset($_POST['genre']) && isset($_POST['email']) && isset($_POST['mdp'])) {
    $nom = $_POST['nom'];
    $date_naissance = $_POST['date_naissance'];
    $genre = $_POST['genre'];
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];

    registerUser($nom, $date_naissance, $genre, $email, $mdp);
    if ($result) {
        header('Location:login.php');
        exit;
    }
}

if (isset($_POST['email']) && isset($_POST['mdp']) && !isset($_POST['action'])) {
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];
    if (loginUser($email, $mdp)) {
        $_SESSION['email'] = $email;
        header('Location:liste.php');
    } else {
        header('Location:login.php?error=1');
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['fichier'])) {

    $uploadDir = '../assets/image/';
    $maxSize = 2 * 1024 * 1024;
    $allowedMimeTypes = ['image/jpeg', 'image/png'];

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

    move_uploaded_file($file['tmp_name'], $uploadDir . $newName);
    $email = $_SESSION['email'];
    insert_pdp($newName, $email);
    header('Location:profil.php?succes=1');
    exit;
}

if (isset($_POST['action']) && $_POST['action'] === 'emprunter' && isset($_POST['id_objet'], $_POST['date_retour'])) {
    $id_objet = (int) $_POST['id_objet'];
    $date_retour = $_POST['date_retour'];

    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email'];
        $infos = get_info($email);
        $id_membre = $infos['id_membre'];

        if (!isEmprunte($id_objet)) {
            if (emprunterObjet($id_objet, $id_membre, $date_retour)) {
                header('Location:liste.php?succes=1');
            } else {
                header('Location:liste.php?succes=0');
            }
        } else {
            header('Location:liste.php?succes=0');
        }
        exit;
    } else {
        header("Location:login.php");
        exit;
    }
}

if (isset($_POST['obj']) && isset($_POST['cat']) && isset($_FILES['fichier'])) {
    $nom = $_POST['obj'];
    $id_cat = $_POST['cat'];
  
    $result = uploadImage($_FILES['fichier']);

    if (isset($result['error'])) {
        die($result['error']);
    } else {
        
        $email = $_SESSION['email'];
        insert_pdp($result['filename'], $email);
        echo 'Upload réussi !';
    }
}

if (isset($_POST['obj'])&& isset($_POST['cat']) && isset($_FILES['sary'])) {
    $nom = $_POST['obj'];
    $id_cat = $_POST['cat'];
    $id_membre = $_SESSION['id_membre'];
  $id_objet = insert_new_object($nom, $id_membre, $id_cat);
  var_dump($id_objet);
if ($id_objet && isset($_FILES['sary'])) {
    if (is_array($_FILES['sary']['tmp_name'])) {
        
        foreach ($_FILES['sary']['tmp_name'] as $index => $tmpPath) {
            if ($_FILES['sary']['error'][$index] === UPLOAD_ERR_OK) {
            
            }
        }
    } else {
        
        $tmpPath = $_FILES['sary']['tmp_name'];
        if ($_FILES['sary']['error'] === UPLOAD_ERR_OK) {
            $originalName = pathinfo($_FILES['sary']['name'], PATHINFO_FILENAME);
            $extension = pathinfo($_FILES['sary']['name'], PATHINFO_EXTENSION);
            $newName = $originalName . '_' . uniqid() . '.' . $extension;
            $destination = '../assets/image/' . $newName;

            if (move_uploaded_file($tmpPath, $destination)) {
                insert_img($newName, $id_objet);
            } else {
                echo "Erreur move_uploaded_file()";
            }
        }
    }
}

header('Location: liste.php');
}
?>
