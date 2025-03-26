<?php
require_once('C:/MAMP/htdocs/php/projet_php_corentin/TP_9/model/pdo.php');

$classe_id = $_GET['id'];

$classe = $dbPDO->query("SELECT * FROM classes WHERE id = $classe_id")->fetch();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $libelle = $_POST['libelle'];
    
    $stmt = $dbPDO->prepare("UPDATE classes SET libelle = :libelle WHERE id = :id");
    
    $stmt->execute([
        ':libelle' => $libelle,
        ':id' => $classe_id
    ]);
    
    $message = "Modification réussie !";
    $classe = $dbPDO->query("SELECT * FROM classes WHERE id = $classe_id")->fetch();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Modifier classe</title>
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
    <h1>Modifier classe</h1>
    
    <?php if(isset($message)) echo "<p class='message'>$message</p>"; ?>
    
    <form method="POST">
        <input type="text" name="libelle" value="<?= $classe['libelle'] ?>" required><br>
        
        <button type="submit">Enregistrer</button>
    </form>
    
    <a href="../../admin/admin.php">Retour</a>
</body>
</html>