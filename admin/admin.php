<?php
session_start();

if (!isset($_SESSION['user_logged'])) {
    header('Location: login.php');
    exit();
}

require_once('../model/pdo.php');

function e($text) {
    echo htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

$etudiants = $dbPDO->query("SELECT * FROM etudiants")->fetchAll();
$classes = $dbPDO->query("SELECT * FROM classes")->fetchAll();
$matieres = $dbPDO->query("SELECT * FROM matiere")->fetchAll();
$professeurs = $dbPDO->query("SELECT * FROM professeurs")->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        h1 {
            color: #2c3e50;
            margin: 0;
        }
        .logout-btn {
            background-color: #e74c3c;
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 4px;
        }
        .sections {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }
        .section {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        table th {
            background-color: #3498db;
            color: white;
        }
        .actions {
            display: flex;
            gap: 10px;
        }
        .btn {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 4px;
            text-decoration: none;
        }
        .btn-edit {
            background-color: #2ecc71;
            color: white;
        }
        .btn-delete {
            background-color: #e74c3c;
            color: white;
        }
        .add-btn {
            background-color: #3498db;
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 4px;
            display: inline-block;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="admin-header">
        <h1>Panneau d'Administration</h1>
        <a href="logout.php" class="logout-btn">Déconnexion</a>
    </div>

    <div class="sections">
        <div class="section">
            <h2>Gestion des Étudiants 
                <a href="../views/etudiant/nouvel_etudiant.php" class="add-btn">+ Ajouter</a>
            </h2>
            <table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Classe</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($etudiants as $etudiant): ?>
                    <tr>
                        <td><?php e($etudiant['nom']); ?></td>
                        <td><?php e($etudiant['prenom']); ?></td>
                        <td>
                            <?php 
                            $classe = $dbPDO->query("SELECT libelle FROM classes WHERE id = {$etudiant['classe_id']}")->fetch();
                            e($classe['libelle']); 
                            ?>
                        </td>
                        <td class="actions">
                            <a href="../views/etudiant/modif_etudiant.php?id=<?= $etudiant['id'] ?>" class="btn btn-edit">Modifier</a>
                            <a href="../views/etudiant/suppression_etudiant.php?id=<?= $etudiant['id'] ?>" class="btn btn-delete" onclick="return confirm('Voulez-vous vraiment supprimer cet étudiant ?')">Supprimer</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="section">
            <h2>Gestion des Matières 
                <a href="../views/matiere/nouvelle_matiere.php" class="add-btn">+ Ajouter</a>
            </h2>
            <table>
                <thead>
                    <tr>
                        <th>Libellé</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($matieres as $matiere): ?>
                    <tr>
                        <td><?php e($matiere['lib']); ?></td>
                        <td class="actions">
                            <a href="../views/matiere/modif_matiere.php?id=<?= $matiere['id'] ?>" class="btn btn-edit">Modifier</a>
                            <a href="../views/matiere/sup_matiere.php?id=<?= $matiere['id'] ?>" class="btn btn-delete" onclick="return confirm('Voulez-vous vraiment supprimer cette matière ?')">Supprimer</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="section">
            <h2>Gestion des Classes 
                <a href="../views/classe/add_classe.php" class="add-btn">+ Ajouter</a>
            </h2>
            <table>
                <thead>
                    <tr>
                        <th>Libellé</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($classes as $classe): ?>
                    <tr>
                        <td><?php e($classe['libelle']); ?></td>
                        <td class="actions">
                            <a href="../views/classe/modif_classe.php?id=<?= $classe['id'] ?>" class="btn btn-edit">Modifier</a>
                            <a href="../views/classe/sup_classe.php?id=<?= $classe['id'] ?>" class="btn btn-delete" onclick="return confirm('Voulez-vous vraiment supprimer cette classe ?')">Supprimer</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="section">
            <h2>Gestion des Professeurs 
                <a href="../views/professeur/add_prof.php" class="add-btn">+ Ajouter</a>
            </h2>
            <table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Matière</th>
                        <th>Classe</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($professeurs as $professeur): ?>
                    <tr>
                        <td><?php e($professeur['nom']); ?></td>
                        <td><?php e($professeur['prenom']); ?></td>
                        <td>
                            <?php 
                            $matiere = $dbPDO->query("SELECT lib FROM matiere WHERE id = {$professeur['id_matiere']}")->fetch();
                            e($matiere['lib']); 
                            ?>
                        </td>
                        <td>
                            <?php 
                            $classe = $dbPDO->query("SELECT libelle FROM classes WHERE id = {$professeur['id_classe']}")->fetch();
                            e($classe['libelle']); 
                            ?>
                        </td>
                        <td class="actions">
                            <a href="../views/professeur/modif_prof.php?id=<?= $professeur['id'] ?>" class="btn btn-edit">Modifier</a>
                            <a href="../views/professeur/sup_prof.php?id=<?= $professeur['id'] ?>" class="btn btn-delete" onclick="return confirm('Voulez-vous vraiment supprimer ce professeur ?')">Supprimer</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>