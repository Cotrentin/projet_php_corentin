<?php
require_once('C:/MAMP/htdocs/php/projet_php_corentin/TP_9/model/pdo.php');

$etudiant_id = $_GET['id'];

$etudiant = $dbPDO->query("SELECT * FROM etudiants WHERE id = $etudiant_id")->fetch();

$classes = $dbPDO->query("SELECT * FROM classes")->fetchAll();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $classe = $_POST['classe'];
    
    $dbPDO->exec("UPDATE etudiants SET 
        prenom = '$prenom',
        nom = '$nom',
        classe_id = $classe 
        WHERE id = $etudiant_id
    ");
    
    $message = "Modification réussie !";
    $etudiant = $dbPDO->query("SELECT * FROM etudiants WHERE id = $etudiant_id")->fetch();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Modifier étudiant</title>
</head>
<body>
    <h1>Modifier étudiant</h1>
    
    <?php if(isset($message)) echo "<p>$message</p>"; ?>
    
    <form method="POST">
        <input type="text" name="prenom" value="<?= $etudiant['prenom'] ?>" required><br>
        <input type="text" name="nom" value="<?= $etudiant['nom'] ?>" required><br>
        
        <select name="classe" required>
            <?php foreach($classes as $c): ?>
                <option value="<?= $c['id'] ?>" <?= ($c['id'] == $etudiant['classe_id']) ? 'selected' : '' ?>>
                    <?= $c['libelle'] ?>
                </option>
            <?php endforeach; ?>
        </select><br>
        
        <button>Enregistrer</button>
    </form>
    
    <a href="../index.php">Retour</a>
</body>
</html>