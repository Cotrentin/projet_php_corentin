<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$include_path = 'C:/MAMP/htdocs/php/projet_php_corentin/TP_9/model/pdo.php';
if (!file_exists($include_path)) {
    die("Database connection file not found at: " . $include_path);
}

require_once($include_path);

if (!isset($_GET['id'])) {
    die("j'avais une erreur id prof manquante donc c pour vérifier");
}

$professeur_id = $_GET['id'];

try {
    $professeur = $dbPDO->query("SELECT * FROM professeurs WHERE id = $professeur_id")->fetch();
    
    if (!$professeur) {
        die("Aucun professeur trouvé avec l'ID : " . $professeur_id);
    }
} catch (PDOException $e) {
    die("Erreur de base de données : " . $e->getMessage());
}

try {
    $matieres = $dbPDO->query("SELECT * FROM matiere")->fetchAll();
    $classes = $dbPDO->query("SELECT * FROM classes")->fetchAll();
} catch (PDOException $e) {
    die("Erreur lors de la récupération des données : " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $prenom = $_POST['prenom'];
        $nom = $_POST['nom'];
        $matiere = $_POST['matiere'];
        $classe = $_POST['classe'];
        
        $stmt = $dbPDO->prepare("UPDATE professeurs SET 
            prenom = :prenom,
            nom = :nom,
            id_matiere = :matiere,
            id_classe = :classe 
            WHERE id = :id");
        
        $stmt->execute([
            ':prenom' => $prenom,
            ':nom' => $nom,
            ':matiere' => $matiere,
            ':classe' => $classe,
            ':id' => $professeur_id
        ]);
        
        $message = "Modification réussie !";
        $professeur = $dbPDO->query("SELECT * FROM professeurs WHERE id = $professeur_id")->fetch();
    } catch (PDOException $e) {
        $message = "Erreur de modification : " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Modifier professeur</title>
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

        .error-message {
            background-color: #f2dede;
            color: #a94442;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            text-align: center;
        }

        h1 {
            color: #2c3e50;
            margin-bottom: 20px;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
            text-align: center;
        }

        .message {
            background-color: #dff0d8;
            color: #3c763d;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            text-align: center;
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
    <h1>Modifier professeur</h1>
    
    <?php 
    if(isset($message)) {
        $messageClass = strpos($message, 'Erreur') !== false ? 'error-message' : 'message';
        echo "<p class='$messageClass'>$message</p>"; 
    }
    ?>
    
    <form method="POST">
        <input type="text" name="prenom" value="<?= $professeur['prenom'] ?>" required><br>
        <input type="text" name="nom" value="<?= $professeur['nom'] ?>" required><br>
        
        <select name="matiere" required>
            <?php foreach($matieres as $m): ?>
                <option value="<?= $m['id'] ?>" <?= ($m['id'] == $professeur['id_matiere']) ? 'selected' : '' ?>>
                    <?= $m['lib'] ?>
                </option>
            <?php endforeach; ?>
        </select><br>
        
        <select name="classe" required>
            <?php foreach($classes as $c): ?>
                <option value="<?= $c['id'] ?>" <?= ($c['id'] == $professeur['id_classe']) ? 'selected' : '' ?>>
                    <?= $c['libelle'] ?>
                </option>
            <?php endforeach; ?>
        </select><br>
        
        <button type="submit">Enregistrer</button>
    </form>
    
    <a href="../../admin/admin.php">Retour</a>
</body>
</html>