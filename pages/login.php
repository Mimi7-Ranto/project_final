
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
        <h2 class="text-center mb-4">📝 Login</h2>

        <form action="traitement.php" method="POST" enctype="multipart/form-data">
         


            <div class="mb-3">
                <label for="email" class="form-label">Adresse email</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>

    
            <div class="mb-3">
                <label for="mdp" class="form-label">Mot de passe</label>
                <input type="password" name="mdp" id="mdp" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success w-100">Se connecter</button>
        </form>
        <p class="mt-3 text-center">Pas encore de compte ? <a href="inscription.php">S'inscrire</a></p>
        <?php 
        if(isset($_GET['error']) && $_GET['error'] == 1) {
            echo '<p class="text-danger text-center">Adresse E-mail ou mot de passe invalide !</p>';
        } ?>
     

    </div>
</div>

</body>
</html>
