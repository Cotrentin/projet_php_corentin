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
    
    <?php if(isset($message)) echo "<p class='message'>$message</p>"; ?>
    
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
    
    <a href="../admin/admin.php">Retour</a>
</body>
</html>