<?php
session_start();
include("../inc/function.php");

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "Objet invalide.";
    exit;
}

$id_objet = (int) $_GET['id'];
$objet = getObjetById($id_objet);
$images = getImagesByObjetId($id_objet);
$historique = getHistoriqueEmprunts($id_objet);

if (!$objet) {
    echo "Objet non trouvé.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Fiche Objet</title>
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .main-image {
            max-width: 100%;
            border-radius: 10px;
            margin-bottom: 15px;
        }

        .thumb {
            width: 100px;
            height: auto;
            margin-right: 10px;
            border-radius: 8px;
            cursor: pointer;
        }

        .thumb:hover {
            border: 2px solid #007bff;
        }
    </style>
</head>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Borrow THINGS</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="liste.php">Liste des Objets</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="profil.php">Mon Profil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Se Déconnecter</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<body>

    <div class="container mt-5">
        <a href="liste.php" class="btn btn-outline-primary mb-3">Retour à la liste</a>

        <h2><?= htmlspecialchars($objet['nom_objet']) ?></h2>
        <p><strong>Catégorie :</strong> <?= htmlspecialchars($objet['nom_categorie']) ?></p>
        <p><strong>Propriétaire :</strong> <?= htmlspecialchars($objet['proprietaire']) ?></p>

        <div>
            <h4>Images</h4>
            <?php if (!empty($images)): ?>
                <img src="../uploads/<?= htmlspecialchars($images[0]['nom_image']) ?>" alt="Image principale"
                    class="main-image">
                <div class="d-flex flex-wrap">
                    <?php foreach ($images as $img): ?>
                        <img src="../uploads/<?= htmlspecialchars($img['nom_image']) ?>" alt="Image" class="thumb"
                            onclick="document.querySelector('.main-image').src=this.src;">
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p>Aucune image disponible.</p>
            <?php endif; ?>
        </div>

        <hr>

        <div>
            <h4>Historique des emprunts</h4>
            <?php if (empty($historique)): ?>
                <p>Aucun emprunt pour cet objet.</p>
            <?php else: ?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Emprunteur</th>
                            <th>Date d'emprunt</th>
                            <th>Date de retour</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($historique as $emprunt): ?>
                            <tr>
                                <td><?= htmlspecialchars($emprunt['nom']) ?></td>
                                <td><?= htmlspecialchars($emprunt['date_emprunt']) ?></td>
                                <td><?= $emprunt['date_retour'] ?? '<em>Non retourné</em>' ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>

</body>

</html>