<?php 
require_once('model/pdo.php');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de l'école</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            background-color:rgb(249, 247, 247);
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        h1, h2 {
            color: #2c3e50;
            margin-bottom: 20px;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
        }

        .section {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        form {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        form div {
            margin-bottom: 10px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color:rgb(52, 73, 94);
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        button {
            background-color:rgb(45, 192, 106);
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color:rgb(39, 173, 95);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: white;
            box-shadow: 0 2px 3px rgba(0, 0, 0, 0.1);
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        table th {
            background-color:rgb(53, 149, 213);
            color: white;
        }

        table tr:nth-child(even) {
            background-color:rgb(240, 238, 238);
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        ul li {
            background-color: white;
            margin-bottom: 5px;
            padding: 10px;
            border-radius: 4px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        a {
            color:rgb(50, 148, 213);
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .admin-login {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #3498db;
            color: white;
            padding: 10px 15px;
            border-radius: 4px;
            text-decoration: none;
            transition: background-color 0.3s ease;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .admin-login:hover {
            background-color: #2980b9;
        }
        .user-actions {
            position: fixed;
            top: 20px;
            right: 20px;
            display: flex;
            gap: 10px;
        }
        .user-actions a {
            background-color: #3498db;
            color: white;
            padding: 10px 15px;
            border-radius: 4px;
            text-decoration: none;
            transition: background-color 0.3s ease;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }
        .user-actions a:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
<div class="user-actions">
        <a href="admin/login.php">Connexion</a>
        <a href="views/nouvel_utilisateur.php">Créer un compte</a>
    </div>
 </div>
 <div class="section">
 <h1>Affichage de l'école</h1>
    <h2>Liste des étudiants</h2>
    <table>
        <thead>
            <tr>
                <th>Prénom</th>
                <th>Nom</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($dbPDO->query("SELECT id, prenom, nom FROM etudiants ORDER BY nom, prenom") as $row) {
                echo "<tr>
                <td>{$row['prenom']}</td>
                <td>{$row['nom']}</td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
</div>
    <div class="section">
        <h2>Liste des classes</h2>
        <ul>
            <?php
            foreach ($dbPDO->query("SELECT libelle FROM classes ORDER BY libelle") as $row) {
                echo "<li>{$row['libelle']}</li>";
            }
            ?>
        </ul>
    </div>
    
    <div class="section">
        <h2>Liste des professeurs</h2>
        <ul>
            <?php
            foreach ($dbPDO->query("SELECT prenom, nom FROM professeurs ORDER BY nom, prenom") as $row) {
                echo "<li>{$row['prenom']} {$row['nom']}</li>";
            }
            ?>
        </ul>
    </div>
    
    <div class="section">
        <h2>Détails des professeurs (matière et classe)</h2> 
        <table>  
            <thead>
                <tr><th>Nom</th><th>Prénom</th><th>Matière</th><th>Classe</th></tr>
            </thead>
            <tbody>
                <?php
                foreach ($dbPDO->query("SELECT p.prenom, p.nom, m.lib AS matiere, c.libelle AS classe FROM professeurs p JOIN matiere m ON p.id_matiere = m.id JOIN classes c ON p.id_classe = c.id ORDER BY p.nom, p.prenom") as $row) {
                    echo "<tr><td>{$row['nom']}</td><td>{$row['prenom']}</td><td>{$row['matiere']}</td><td>{$row['classe']}</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>