<?php
    
// Déclaration des variables de connexion à la base de données
$host = "localhost";
$user = "root";
$password = "";
$dbname = "todoliste";

try {
    // Connexion à la base de données
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Requête de sélection des données
    $stmt = $conn->prepare("SELECT * FROM COURSE");
    $stmt->execute();

    // Récupération des données sous forme de tableau associatif
    $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Affichage des données sous forme de liste de tâches
    echo "<h1>ToDo List</h1>";
    echo "<ul>";
    foreach($courses as $course) {
        echo "<li>" . $course["TITRE"] . ": " . $course["LIST"] . "</li>";
    }
    echo "</ul>";

} catch (PDOException $e) {
    // Affichage d'un message d'erreur
    echo "ECHEC DE LA RECUPERATION DES DONNEES : " . $e->getMessage();
}

?>

