<?php 
require_once('../TP_9/model/pdo.php');


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de l'école</title>
</head>
<body>
<h2>Ajout de matiere</h2>
     <form action="Views/nouvelle_matiere.php" method="POST">
         <div>
             <label for="libelle">Libellé:</label>
             <input type="text" id="libelle" name="libelle" required>
         </div>
             <button type="submit">Valider</button>
         </div>
     </form>
     <h2>Ajout d'un nouvel élève</h2>
     <form action="Views/nouvel_etudiant.php" method="POST">
         <div>
             <label for="nom">Nom :</label>
             <input type="text" id="nom" name="nom" required>
         </div>
         <div>
             <label for="prenom">Prénom :</label>
             <input type="text" id="prenom" name="prenom" required>
         </div>
         <button type="submit">Valider</button>
     </form>
 </div>
 <div class="section">
 <h1>Affichage de l'école</h1>
    <h2>Liste des étudiants</h2>
    <table>
        <thead>
            <tr>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($dbPDO->query("SELECT id, prenom, nom FROM etudiants ORDER BY nom, prenom") as $row) {
                echo "<tr>
                        <td>{$row['prenom']}</td>
                        <td>{$row['nom']}</td>
                        <td><a href='Views/modif_etudiant.php?id={$row['id']}'>Modifier</a></td>
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