<?php
require_once('../model/pdo.php');

$classe_id = $_GET['id'];

try {
    $stmt = $dbPDO->prepare("DELETE FROM classes WHERE id = :id");
    $stmt->execute(['id' => $classe_id]);
    $message = "Classe supprimée avec succès";
} catch (PDOException $e) {
    $message = "Erreur lors de la suppression : " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Suppression classe</title>
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
    <h1>Suppression classe</h1>
    
    echo '<p class="message">' . $message . '</p>';
    
    <a href="../admin/admin.php" class="btn">Retour</a>
</body>
</html>