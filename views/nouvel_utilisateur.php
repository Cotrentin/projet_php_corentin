<?php
require_once('../model/pdo.php');

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (empty($email) || empty($password) || empty($confirm_password)) {
        $message = "Tous les champs sont obligatoires.";
    } elseif ($password !== $confirm_password) {
        $message = "Les mots de passe ne correspondent pas.";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        try {
            $check_email = $dbPDO->prepare("SELECT COUNT(*) FROM user WHERE email = :email");
            $check_email->execute(['email' => $email]);
            
            if ($check_email->fetchColumn() > 0) {
                $message = "Cet email est déjà utilisé.";
            } else {
                $stmt = $dbPDO->prepare("INSERT INTO user (email, pasword) VALUES (:email, :password)");
                $stmt->execute([
                    'email' => $email,
                    'password' => $hashed_password
                ]);

                $message = "Utilisateur créé avec succès !";
            }
        } catch (PDOException $e) {
            $message = "Erreur lors de la création de l'utilisateur : " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Créer un compte utilisateur</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            width: 300px;
        }
        h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 20px;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        input {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #2980b9;
        }
        .message {
            color: red;
            text-align: center;
            margin-bottom: 15px;
        }
        .success {
            color: green;
        }
        .back-link {
            text-align: center;
            margin-top: 15px;
        }
        .back-link a {
            color: #3498db;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Créer un compte</h2>
        
        <?php if (!empty($message)): ?>
            <p class="message <?= strpos($message, 'succès') !== false ? 'success' : '' ?>">
                <?= $message ?>
            </p>
        <?php endif; ?>
        
        <form method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <input type="password" name="confirm_password" placeholder="Confirmer le mot de passe" required>
            <button type="submit">Créer un compte</button>
        </form>
        
        <div class="back-link">
            <a href="../index.php">Retour à l'accueil</a>
        </div>
    </div>
</body>
</html>