<?php
session_start();
if(isset($_SESSION["email"])){
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>MJC KIFF TA VIE</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.jpg" />
    <script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" crossorigin="anonymous"></script>

    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
</head>

<body id="page-top">

<?php

//Upload de fichier
//Existance de ma superglobale $_FILES
//<input de type file + attribut name="">

        if(isset($_FILES['photo'])){
                //le chemin vers l'image

    $repertoireDestination = "assets/img";
 
    $photo_membres = $repertoireDestination . basename($_FILES['photo']['name']);
    //Recup de l'image uploader
    //On assigne l'image uploader au repertoire de destination + la photo + son nom
    $_POST['photo'] = $photo_membres;

    if(move_uploaded_file($_FILES['photo']['tmp_name'], $photo_membres)){
        echo "<p class='container alert alert-success'>Le fichier est valide et téléchargé avec succès !</p>";
    }else{
        echo "<p class='container alert alert-danger'>Erreur lors du téléchargement de votre fichier !</p>";
    }
}else{
    echo "<p class='container alert alert-danger'>Le fichier est invalide seul les format .png, .jpg, .bmp, .svg, .webp sont autorisé !</p>";
}


//Connexion a la base de donnée MJC via PDO
//Les variable de phpmyadmin
$user = "root";
$pass = "";
try {
   
    $dbh = new PDO('mysql:host=localhost;dbname=mjc', $user, $pass);
    
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "<p class='container alert alert-success text-center'>Vous êtes connectez a PDO MySQL</p>";

} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}

if($dbh){
        //Requète SQL de selection des produits avec UPDATE

    $sql = "UPDATE `membres` SET `nom_jeune`= ?,`prenom_jeune`= ?,`photo`= ?,`date_inscription`= ?,`téléphone`= ?,`email`= ? ,`age`= ?,`étude`= ? WHERE id_jeune = ?";
     //Requète préparée = connexion + methode prepare + requete sql
    //Les requètes préparée lutte contre les injections SQL
    //PDO::prepare — Prépare une requête à l'exécution et retourne un objet
    $update = $dbh->prepare($sql);
    //executer la requète préparée
    //PDOStatement::execute — Exécute une requête préparée
    //Elle execute la reqète passé dans un tableau de valeur
    $update->execute(array(
        
        $_POST['nom_jeune'],
        $_POST['prenom_jeune'],
        $_POST['photo'],
        $_POST['date_inscription'],
        $_POST['téléphone'],
        $_POST['email'],
        $_POST['age'],
        $_POST['étude'],
        $_GET['id_jeune']
    ));

    if($update){
        echo "<p class='container alert alert-success'>Votre inscription a été mis a jour avec succès !</p>";
        echo "<div class='text-center'><a href='membres.php' class='container btn btn-success'>Voir mon inscription</a></div> ";
    }else{
        echo "<p class='alert alert-danger'>Erreur lors de l'ajout de l'inscription</p>";
    }
}
}else{
    echo "<a href='' class='btn btn-warning'>S'inscrire</a>";
}
?>