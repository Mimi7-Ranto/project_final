
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription - Borrow THINGS</title>
   <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
      <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background: #f2f4f8;
        }
        .form-container {
            max-width: 600px;
            margin: 50px auto;
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>

<div class="container">
    <div class="form-container">
        <h2 class="text-center mb-4">📝 Créer un compte</h2>

        <form action="traitement.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nom" class="form-label">Nom complet</label>
                <input type="text" name="nom" id="nom" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="date_naissance" class="form-label">Date de naissance</label>
                <input type="date" name="date_naissance" id="date_naissance" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Genre</label>
                <select name="genre" class="form-select" required>
                    <option value="">-- Choisissez --</option>
                    <option value="M">Homme</option>
                    <option value="F">Femme</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Adresse email</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="mdp" class="form-label">Mot de passe</label>
                <input type="password" name="mdp" id="mdp" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success w-100">S'inscrire</button>
        </form>
        <p class="mt-3 text-center">Déjà un compte ? <a href="login.php">Se connecter</a></p>
    </div>
</div>

</body>
</html>
