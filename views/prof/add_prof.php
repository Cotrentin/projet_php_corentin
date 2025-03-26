<?php
require_once('C:/MAMP/htdocs/php/projet_php_corentin/TP_9/model/pdo.php');

$matieres = $dbPDO->query("SELECT * FROM matiere")->fetchAll();
$classes = $dbPDO->query("SELECT * FROM classes")->fetchAll();

$success = false;
$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $matiere = $_POST['matiere'];
    $classe = $_POST['classe'];
    
    try {
        $sql = "INSERT INTO professeurs (prenom, nom, id_matiere, id_classe) VALUES (:prenom, :nom, :matiere, :classe)";
        $requete = $dbPDO->prepare($sql);
        $requete->bindParam(':prenom', $prenom);
        $requete->bindParam(':nom', $nom);
        $requete->bindParam(':matiere', $matiere);
        $requete->bindParam(':classe', $classe);

        $success = $requete->execute();
    } catch (PDOException $e) {
        $success = false;
        $error_message = $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ajouter un professeur</title>
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
        }

        input[type="text"], select {
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
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #3498db;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Ajouter un professeur</h1>
    
    <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
        <?php if ($success): ?>
            <p class="message success">Le professeur a été ajouté avec succès !</p>
        <?php else: ?>
            <p class="message error"><?php echo $error_message; ?></p>
        <?php endif; ?>
    <?php endif; ?>
    
    <form method="POST">
        <input type="text" name="prenom" placeholder="Prénom" required><br>
        <input type="text" name="nom" placeholder="Nom" required><br>
        
        <select name="matiere" required>
            <option value="">Sélectionnez une matière</option>
            <?php foreach($matieres as $m): ?>
                <option value="<?= $m['id'] ?>"><?= $m['lib'] ?></option>
            <?php endforeach; ?>
        </select><br>
        
        <select name="classe" required>
            <option value="">Sélectionnez une classe</option>
            <?php foreach($classes as $c): ?>
                <option value="<?= $c['id'] ?>"><?= $c['libelle'] ?></option>
            <?php endforeach; ?>
        </select><br>
        
        <button type="submit">Ajouter</button>
    </form>
    
    <a href="../../admin/admin.php">Retour</a>
</body>
</html>