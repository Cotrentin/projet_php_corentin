<?php
require_once('C:/MAMP/htdocs/php/projet_php_corentin/TP_9/model/pdo.php');

$etudiant_id = $_GET['id'];

$dbPDO->exec("DELETE FROM etudiants WHERE id = $etudiant_id");
$message = "Étudiant supprimé";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Suppression étudiant</title>
</head>
<body>
    <h1>Suppression étudiant</h1>
    
    <p><?= $message ?></p>
    
    <a href="../index.php" class="btn">Retour</a>
</body>
</html>