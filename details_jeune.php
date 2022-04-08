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
    
    $user = "root";
    $pass = "";
    $hote = "localhost";
    $nomBaseDonnees = "mjc";

    try {

        $connexionDataBase = new PDO("mysql:host=".$hote.";dbname=".$nomBaseDonnees.";charset=UTF8", $user, $pass);
        $connexionDataBase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "<p class='container alert alert-success text-center'>Vous êtes connectez a PDO MySQL</p>";




    }catch (PDOException $exception){
        echo "Erreur de connexion a MySQL " .$exception->getMessage();
        die();
    }

    if($connexionDataBase == true){
        $sql = "SELECT * FROM membres WHERE id_jeune = ?";
        $id_jeune = $_GET['id_jeune'];

        $requete = $connexionDataBase->prepare($sql);

        $requete->bindParam(1, $id_jeune);
        $requete->execute();
        $details = $requete->fetch();

    }

   

    ?>
    <form method="post">
            <div class= text-center>
            <button id="btn-deconnexion" class="btn btn-danger" name="btn-deconnexion">Déconnexion</button>
            </div>
    </form>

    <br>
    <br>

    
    <div class="container col-sm-12 col-lg-4 mt-5" >
            <h4 class="text-warning text-center">FICHE INSCRIPTION</h4>

            <p class="text-center text-danger"><?= $details['nom_jeune'] ?></p>
            <p class="text-center text-danger"><?= $details['prenom_jeune'] ?></p>
            <p class="text-center text-danger"><?= $details['email'] ?></p>
            <p class="text-center text-danger"><?= $details['age'] ?></p>
            <p class="text-center text-danger"><?= $details['étude'] ?></p>
            <p class="text-center text-danger"><?= $details['téléphone'] ?></p>
            <p class="text-center text-danger"><?= $details['date_inscription'] ?></p>
            <p class="text-center text-danger">
                <img src="<?= $details['photo'] ?>" class="img-thumbnail" alt="" title="" width="200"/>
            </p>
        <div class="row">

            <br>
            <br>

</div>
<?php
}else{
    header("location:index.php");
    
}
?>
        <script> src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>

<?php
    function deconnexion(){
     session_unset();
     session_destroy();
     header("Location:index.php");}
     
 if(isset($_POST['btn-deconnexion'])){
deconnexion();}       
?>    
       