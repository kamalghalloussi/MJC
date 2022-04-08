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
try {
    $db = new PDO("mysql:host=localhost;dbname=mjc;charset=UTF8", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "<p class='container alert alert-success text-center'>Vous êtes connectez à PDO MySQL</p>";
}catch (PDOException $exception){
    echo "erreur " .$exception->getMessage();
}


$sql = "DELETE FROM `utilisateur` WHERE `id_user` = ?";
//Stock et Recup de id dans l'url avec la super globale GET

$id = $_GET['id_utilisateur'];
//Requète préparée pour lutter contre les injection SQL
$delete = $db->prepare($sql);
//On lie le paramètre de la requète SQL (le ?) a l'id resup dans URL
$delete->bindParam(1, $id);
$delete->execute();
if($delete == true){
    ?>
        <div class="container">
    <?php
    echo "<p class='alert alert-success'>L'admin a bien été supprimer</p>";
    echo "<a href='admin.php' class='btn btn-warning'>Retour</a>";
    ?>
        </div>
    <?php
}else{
    echo "<div class='container'><p class='alert alert-danger'>Erreur lors de la supression de l'admin</p></div>";
    var_dump($delete);
}

}else{
    header("Location:index.php");
}

?>
</body>
</html>
