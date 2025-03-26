<?php
require_once('C:/MAMP/htdocs/php/projet_php_corentin/TP_9/model/pdo.php');

if (!empty($_POST['libelle'])) {
    $libelle = $_POST['libelle']; 
    $query = "INSERT INTO matiere (lib) VALUES ('$libelle')"; 
    $success = $dbPDO->query($query);

    $message = $success ? "La matière \"$libelle\" a été ajoutée avec succès!" : "Erreur lors de l'ajout.";
} else {
    $message = "Veuillez remplir tous les champs.";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout d'une matière</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            color: #2c3e50;
            margin-bottom: 20px;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
            text-align: center;
        }

        .message {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            text-align: center;
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

        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #3498db;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Ajout d'une matière</h1>
    <form action="../matiere/nouvelle_matiere.php" method="POST">
          <div>
              <label for="libelle">Libellé:</label>
              <input type="text" id="libelle" name="libelle" required>
          </div>
              <button type="submit">Valider</button>
          </div>
      </form>
    <p><?php echo $message; ?></p>
</body>
</html>
<a href="../../admin/admin.php">Retour à l'accueil</a>
