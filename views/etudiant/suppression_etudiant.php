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

        h1 {
            color: #2c3e50;
            margin-bottom: 20px;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
        }

        .message {
            background-color: #dff0d8;
            color: #3c763d;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .btn {
            display: inline-block;
            padding: 10px 15px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            margin-top: 10px;
        }

        .btn:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <h1>Suppression étudiant</h1>
    
    <p class="message"><?= $message ?></p>
    
    <a href="../index.php" class="btn">Retour</a>
</body>
</html>