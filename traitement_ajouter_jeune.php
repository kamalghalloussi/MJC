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
        <?php


//Upload de fichier
//Existance de ma superglobale $_FILES
//<input de type file + attribut name="">
if(isset($_FILES['photo'])){
    $repertoireDestination = "assets/img/";
 //La photo uploader
    //basename — Retourne le nom de la composante finale d'un chemin
    //dans tableau multi dimmension 1 = image 2 = son nom
    $photo_membres = $repertoireDestination . basename($_FILES['photo']['name']);
   //Recup de l'image uploader
    //On assigne l'image uploader au repertoire de destination + la photo + son nom
    $_POST['photo'] = $photo_membres;
    //Les conditions de resussite
    //move_uploaded_file — Déplace un fichier téléchargé
    //On assigne a la photo un nom temporaire random en cas d'echec d'upload
    if(move_uploaded_file($_FILES['photo']['tmp_name'], $photo_membres)){
        echo "<p class='container alert alert-success'>Le fichier est valide et téléchargé avec succès !</p>";
    }else{
        echo "<p class='container alert alert-danger'>Erreur lors du téléchargement de votre fichier !</p>";
    }
}else{
    echo "<p class='container alert alert-danger'>Le fichier est invalide seul les format .png, .jpg, .bmp, .svg, .webp sont autorisé !</p>";
}


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
        //Requète SQL de selection des jeunes de ma bdd

    $sql = "INSERT INTO `membres` (`id_jeune`,`nom_jeune`,`prenom_jeune`,`photo`,`date_inscription`,`téléphone`,`email`,`age`,`étude`) VALUES (?,?,?,?,?,?,?,?,?)";

    $insert = $dbh->prepare($sql);
    //Bindé les paramètre
    //Liés les paramètre du formulaire a la table phpmyadmin
    //PDOStatement::bindParam — Lie un paramètre à un nom de variable spécifique
    $insert->bindParam(1, $_POST['id_jeune']);
    $insert->bindParam(2, $_POST['nom_jeune']);
    $insert->bindParam(3, $_POST['prenom_jeune']);
    $insert->bindParam(4, $_POST['photo']);
    $insert->bindParam(5, $_POST['date_inscription']);
    $insert->bindParam(6, $_POST['téléphone']);
    $insert->bindParam(7, $_POST['email']);
    $insert->bindParam(8, $_POST['age']);
    $insert->bindParam(9, $_POST['étude']);


//executer la requète préparée
    //PDOStatement::execute — Exécute une requête préparée
    //Elle execute la reqète passé dans un tableau de valeur

    $insert->execute(array(
        $_POST['id_jeune'],
        $_POST['nom_jeune'],
        $_POST['prenom_jeune'],
        $_POST['photo'],
        $_POST['date_inscription'],
        $_POST['téléphone'],
        $_POST['email'],
        $_POST['age'],
        $_POST['étude']
    ));

    if($insert){
        echo "<p class='container alert alert-success'>Votre inscription a été ajouté avec succès !</p>";
        echo "<a href='membres.php' class='container btn btn-success'>Voir l'inscription</a>";
    }else{
        echo "<p class='alert alert-danger'>Erreur lors de l'inscription</p>";
    }
}
}else{
    echo "<a href='' class='btn btn-warning'>S'inscrire</a>";
}
?>


