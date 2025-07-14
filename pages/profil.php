<?php
session_start();
include("../inc/function.php");
$email = $_SESSION['email'];
$infos = get_info($email);
$_SESSION['id_membre'] = $infos['id_membre'];
$categories = get_categorie();
$mesObjets = getObjetsParMembreParCategorie($infos['id_membre']);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil - Borrow THINGS</title>
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <header>
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

    </header>

<body class="bg-light">

    <div class="container mt-5">
        <div class="card mx-auto shadow" style="max-width: 500px;">
            <div class="card-body text-center">
                <h2 class="card-title mb-4">Mon Profil</h2>
                <img src="../assets/image/<?php echo htmlspecialchars($infos['img_prpfile']); ?>"
                    class="rounded-circle mb-3" width="120" height="120" alt="Photo de profil">

                <ul class="list-group list-group-flush text-start">
                    <li class="list-group-item"><strong>Nom :</strong> <?php echo $infos['nom']; ?></li>
                    <li class="list-group-item"><strong>Email :</strong> <?php echo $infos['email']; ?></li>
                    <li class="list-group-item"><strong>Date de naissance :</strong>
                        <?php echo $infos['date_naissance']; ?></li>
                    <li class="list-group-item"><strong>Genre :</strong> <?php echo $infos['gender']; ?></li>
                </ul>

                <a href="logout.html" class="btn btn-danger mt-4">Se déconnecter</a>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="card mx-auto shadow" style="max-width: 500px;">
            <div class="card-body text-center">
                <h2 class="card-title mb-4">Modifier</h2>

                <form action="traitement.php" method="post" enctype="multipart/form-data">
                    <label for="fichier">Choisir un fichier :</label>
                    <br>
                    <input type="file" name="fichier" id="fichier" required>
                    <input type="submit" value="Uploader" class="btn btn-danger mt-4">
                </form>


            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="card mx-auto shadow" style="max-width: 500px;">
            <div class="card-body text-center">
                <h2 class="card-title mb-4">Ajouter un objet</h2>
                <form action="traitement.php" method="post" enctype="multipart/form-data">
                    <label for="obj" class="form-label">Nom de l'objet</label>
                    <input type="text" name="obj" id="obj" class="form-control" required>

                    <label for="cat" class="form-label mt-3">Catégorie</label>
                    <select name="cat" id="cat" class="form-select" required>
                        <option value="">-- Choisir une catégorie --</option>
                        <?php foreach ($categories as $categorie): ?>
                            <option value="<?php echo $categorie['id_categorie']; ?>">
                                <?php echo $categorie['nom_categorie'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <label for="fichier" class="form-label mt-3">Images de l'objet</label>
                    <input type="file" name="fichier" id="fichier" class="form-control" multiple accept="image/*">

                    <input type="submit" value="Uploader" class="btn btn-danger mt-4">
                </form>

            </div>
        </div>
    </div>


    <div class="container mt-5">
        <div class="card mx-auto shadow" style="max-width: 700px;">
            <div class="card-body">
                <h2 class="card-title mb-4 text-center">Mes Objets</h2>

                <?php if (empty($mesObjets)): ?>
                    <p class="text-center">Vous n'avez encore ajouté aucun objet.</p>
                <?php else: ?>
                    <?php foreach ($mesObjets as $categorie => $objets): ?>
                        <h5 class="mt-4 text-primary"><?= htmlspecialchars($categorie) ?></h5>
                        <ul class="list-group mb-3">
                            <?php foreach ($objets as $objet): ?>
                                <li class="list-group-item"><?= htmlspecialchars($objet) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endforeach; ?>
                <?php endif; ?>

            </div>
        </div>
    </div>
</body>

</html>