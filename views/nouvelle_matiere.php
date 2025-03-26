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
</head>
<body>
    <h1>Ajout d'une matière</h1>
    <p><?php echo $message; ?></p>
</body>
</html>
<a href="../index.php">Retour à l'accueil</a>
