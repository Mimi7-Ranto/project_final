<?php
session_start();
include("../inc/function.php");
$email = $_SESSION['email'];
$infos = get_info($email);

$categories = getCategories();
if (isset($_GET['categorie'])) {
    $categorie_id = (int)$_GET['categorie'];
} else {
    $categorie_id = null;
}

$objets = getObjets($categorie_id);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Objets</title>
 <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
      <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background: #f7f7f7;
        }
        .card {
            margin-bottom: 20px;
            border-radius: 15px;
        }
        .status-dispo {
            color: green;
            font-weight: bold;
        }
        .status-indispo {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
  <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">Borrow THINGS</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
<body>
  
<div class="container mt-5">
    <h1 class="mb-4 text-center">📦 Liste des objets à emprunter</h1>

    <form method="GET" class="row g-3 mb-4">
        <div class="col-md-6">
            <select name="categorie" class="form-select">
                <option value="">-- Toutes les catégories --</option>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= $cat['id_categorie'] ?>" <?= ($categorie_id == $cat['id_categorie']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($cat['nom_categorie']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary">Filtrer</button>
        </div>
       
    </form>

  
    <div class="row">
        <?php if (empty($objets)): ?>
            <div class="col-12">
                <div class="alert alert-warning text-center">Aucun objet trouvé.</div>
            </div>
        <?php else: ?>
            <?php foreach ($objets as $obj): ?>
                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($obj['nom_objet']) ?></h5>
                            <p class="card-text">
                                <strong>Catégorie :</strong> <?= htmlspecialchars($obj['nom_categorie']) ?><br>
                                <strong>Propriétaire :</strong> <?= htmlspecialchars($obj['proprietaire']) ?><br>
                                <strong>Statut :</strong>
                                <?php if (isEmprunte($obj['id_objet'])): ?>
                                    <span class="status-indispo">Emprunté</span><br>
                                    
                                    <?php $date_retour = get_date_retour($obj['id_objet']);?>
                                    <strong>Date de retour : </strong><?php echo $date_retour['date_retour']; ?>
                                    <?php else: ?>
                                        <span class="status-dispo">Disponible</span>
                                        <?php endif; ?>

                                        
                                    </p>
                          
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
