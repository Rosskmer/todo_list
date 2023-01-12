<?php
    $host = 'localhost';
    $user = 'root';
    $password = '';

try{
    $conn = new PDO("mysql:host=$host", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    echo 'ERREUR DE CONNEXION'.$e->getMessage();
}

/* CREATION DE LA BASE DE DONNEE 

$sql = 'CREATE DATABASE todoliste';

if($conn->exec($sql)){
    echo 'BASE DE DONNEE CREE AVEC SUCCES !';
}else{
    echo 'ECHEC CREATION DE LA BASE DE DONNE';
}

$conn->query('USE todoliste');

$stmt = $conn->prepare("CREATE TABLE COURSE(
    ID int (6) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    TITRE VARCHAR (20) NOT NULL,
    LIST VARCHAR(20) NOT NULL
)");

if($stmt->execute()){
    echo 'LA TABLE ET LES COLONNE ON ETE BIEN CREE ! ';
}else{
    echo 'ECHEC DE CREATION DE LA TABLE ET COLONNE !';
}*/



$host = "localhost";
$user = "root";
$password = "";
$dbname = "todoliste";

// Vérification des champs du formulaire
if(!empty($_POST["titre"]) && !empty($_POST["list"])) {
    try {
        // Connexion à la base de données
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Récupération des données du formulaire
        $titre = $_POST["titre"];
        $list = $_POST["list"];

        // Préparation de la requête d'insertion
        $stmt = $conn->prepare("INSERT INTO COURSE (TITRE, LIST) VALUES (:TITRE, :LIST)");
        $stmt->bindParam(':TITRE', $titre);
        $stmt->bindParam(':LIST', $list);

        // Exécution de la requête d'insertion
        $stmt->execute();

        // Affichage d'un message de succès
        echo "DONNEES INSEREES AVEC SUCCES !";
    } catch (PDOException $e) {
        // Affichage d'un message d'erreur
        echo "ECHEC D'INSERTION : " . $e->getMessage();
    }
} else {
    // Affichage d'un message d'erreur
    echo "VEUILLEZ REMPLIR TOUT LES CHAMPS !";
}


?>

