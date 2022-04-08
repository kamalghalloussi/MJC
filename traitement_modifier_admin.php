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
       



$user = "root";
$pass = "";
try {
   
    $dbh = new PDO('mysql:host=localhost;dbname=mjc', $user, $pass);
    
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "<p class='container alert alert-success text-center'>Vous êtes connectez à PDO MySQL</p>";

} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}

if($dbh){
        //Requète SQL de selection des des jeunes des bdd

    $sql = "UPDATE `utilisateur` SET `email`= ?,`password`= ? WHERE `id_user` = ?";
       //Requète préparée = connexion + methode prepare + requete sql
    //Les requètes préparée lutte contre les injections SQL
    //PDO::prepare — Prépare une requête à l'exécution et retourne un objet
    $update = $dbh->prepare($sql);
        //executer la requète préparée
    //PDOStatement::execute — Exécute une requête préparée
    //Elle execute la reqète passé dans un tableau de valeur
    $update->execute(array(
        
        $_POST['email'],
        $_POST['password'],
        $_GET['id_user']
    ));

    if($update){
        echo "<p class='container alert alert-success'>Votre compte administrateur a été mis a jour avec succès !</p>";
        echo "<div class='text-center'><a href='admin.php' class='container btn btn-success'>Voir mes modifications</a></div> ";
    }else{
        echo "<p class='alert alert-danger'>Erreur lors de la modification de l'administrateur</p>";
    }
}
}else{
    echo "<a href='' class='btn btn-warning'>S'inscrire</a>";
}
?>