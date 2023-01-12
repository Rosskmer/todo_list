<?php
// Connection a la  database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "todolist";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // gestion d'erreur
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // verifier les donnée
    if (isset($_POST['titre']) && isset($_POST['list'])) {
        $title = $_POST['titre'];
        $list = $_POST['list'];
        
        // Prepare la requete
        $stmt = $conn->prepare("INSERT INTO liste (titre, list) VALUES (:titre, :list)");
        $stmt->bindParam(':titre', $title);
        $stmt->bindParam(':list', $list);
        $stmt->execute();
    }

    // Prepare l'execution
    $stmt = $conn->prepare("SELECT titre, list FROM liste");
    $stmt->execute();

    // parcourir les liste
    $lists = $stmt->fetchAll();

} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}



// afficher lists
foreach ($lists as $list) {
    echo "TITLE : " . $list['titre'] . "<br>";
    echo "LIST : " . $list['list'] . "<br>";
}
?>

