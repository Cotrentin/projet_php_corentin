<?php
require_once('C:/MAMP/htdocs/php/projet_corentin_dubernet/TP_9/model/pdo.php');

$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
 
if (isset($nom) && isset($prenom)) {
    try {
        $sql = "INSERT INTO etudiants (nom, prenom, classe_id) VALUES (:nom, :prenom, 1)";
        $requete = $dbPDO->prepare($sql);
        $requete->bindParam(':nom', $nom);
        $requete->bindParam(':prenom', $prenom);

        $success = $requete->execute();
    } catch (PDOException $e) {
        $success = false;
        $error_message = $e->getMessage();
    }
} else {
    $success = false;
    $error_message = "Tous les champs doivent être remplis.";
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout d'un nouvel élève</title>
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
    <h1>Ajout d'un nouvel élève</h1>
    <form action="../etudiant/nouvel_etudiant.php" method="POST">
          <div>
              <label for="nom">Nom :</label>
              <input type="text" id="nom" name="nom" required>
          </div>
          <div>
              <label for="prenom">Prénom :</label>
              <input type="text" id="prenom" name="prenom" required>
          </div>
          <button type="submit">Valider</button>
      </form>
    
    <?php if ($success): ?>
        <p class="message success">L'élève a été ajouté avec succès !</p>
    <?php else: ?>
        <p class="message error"><?php echo $error_message; ?></p>
    <?php endif; ?>
    
    <a href="../../admin/admin.php">Retour à l'accueil</a>
</body>
</html>
