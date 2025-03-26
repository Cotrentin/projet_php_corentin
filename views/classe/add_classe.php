<?php
require_once('C:/MAMP/htdocs/php/projet_php_corentin/TP_9/model/pdo.php');

$nom = $_POST['libelle'] ?? null;
 
if (isset($nom)) {
    try {
        $sql = "INSERT INTO classes (libelle) VALUES (:libelle)";
        $requete = $dbPDO->prepare($sql);
        $requete->bindParam(':libelle', $nom);

        $success = $requete->execute();
    } catch (PDOException $e) {
        $success = false;
        $error_message = $e->getMessage();
    }
} else {
    $success = false;
    $error_message = "Le libellé de la classe doit être rempli.";
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout d'une nouvelle classe</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
        }

        .message {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .success {
            background-color: #dff0d8;
            color: #3c763d;
            border: 1px solid #d6e9c6;
        }

        .error {
            background-color: #f2dede;
            color: #a94442;
            border: 1px solid #ebccd1;
        }

        form {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #2980b9;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }

        a:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <h1>Ajout d'une nouvelle classe</h1>
    
    <form action="add_classe.php" method="POST">
        <div>
            <label for="libelle">Libellé de la classe :</label>
            <input type="text" id="libelle" name="libelle" required>
        </div>
        <button type="submit">Valider</button>
    </form>
    
    <?php if ($success): ?>
        <p class="message success">La classe a été ajoutée avec succès !</p>
    <?php else: ?>
        <?php if (isset($error_message)): ?>
            <p class="message error"><?php echo $error_message; ?></p>
        <?php endif; ?>
    <?php endif; ?>
    
    <a href="../../admin/admin.php">Retour à l'accueil</a>
</body>
</html>