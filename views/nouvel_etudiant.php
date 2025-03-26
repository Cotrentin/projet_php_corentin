<?php
require_once('C:/MAMP/htdocs/php/projet_corentin_dubernet/TP_9/model/pdo.php');

$nom = $_POST['nom'];
 $prenom = $_POST['prenom'];
 
 if (isset($nom) && isset($prenom)) {
    try {
        $sql = "INSERT INTO etudiants (nom, prenom, classe_id) VALUES (:nom, :prenom, 1)";
        $requete = $dbPDO->prepare($sql);
        $requete->bindParam(':nom', $nom);
        $requete->bindParam(':prenom', $prenom);

        if ($requete->execute()) {
            echo "</br>L'élève a été ajouté avec succès !";
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
} else {
    echo "Tous les champs doivent être remplis.";
}
 
 ?>
 <br>
 <a href="../index.php">Retour à l'accueil</a>