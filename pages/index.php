<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Borrow THINGS</title>
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
      <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../assets/css/index.css">
    <style>
        body {
            background: linear-gradient(to right, #74ebd5, #ACB6E5);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
        }

        .container {
            background: white;
            padding: 50px;
            border-radius: 20px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            text-align: center;
        }

        h1 {
            margin-bottom: 30px;
            font-size: 2.5rem;
        }

        h1 span {
            color: #007bff;
            font-weight: bold;
        }

        a {
            display: inline-block;
            margin: 10px;
            padding: 12px 25px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
        }

        a:first-of-type {
            background-color: #28a745;
            color: white;
        }

        a:last-of-type {
            background-color: #007bff;
            color: white;
        }

        a:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Bienvenue sur <span>Borrow THINGS</span> !</h1>
        <a href="inscription.php">Je n'ai pas de compte</a>
        <a href="login.php">J'ai déjà un compte</a>
    </div>
</body>
</html>
