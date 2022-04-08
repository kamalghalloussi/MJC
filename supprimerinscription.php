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
        $nomBaseDonnees = "mjc";
        $hote="localhost";
        try {         
            $dbh = new PDO("mysql:host=".$hote.";dbname=".$nomBaseDonnees.";charset=UTF8", $user, $pass);           
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "<p class='container alert alert-success text-center'>Vous êtes connectez a PDO MySQL</p>";

        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }

        if($dbh){
            $sql = "SELECT * FROM membres WHERE id_jeune = ?";
            $id_jeune = $_GET['id_jeune'];
            $request = $dbh->prepare($sql);
            $request->bindParam(1, $id_jeune);
            $request->execute();          
            $details = $request->fetch(PDO::FETCH_ASSOC);

        }

        ?>
        <form method="post">
            <div class= text-center>
            <button id="btn-deconnexion" class="btn btn-danger" name="btn-deconnexion">Déconnexion</button>
            </div>
</form>

<br>

<br>
        <form method="post" id="form-delete">
            <p class="text-center text-danger">SUPPRIMER L'INSCRIPTION</p>
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
            <div class="d-flex justify-content-center">
                <button type="submit" name="btn-supprimer" class="btn btn-danger">Confimer</button>
                <a href="membres.php" class="btn btn-success">Annuler</a>
            </div>

        </form>
        <?php

        if(isset($_POST['btn-supprimer'])){
            $sql = "DELETE FROM `membres` WHERE id_jeune =  ?";
            $delete = $dbh->prepare($sql);
            $id_jeune = $_GET['id_jeune'];
            $delete->bindParam(1, $id_jeune);
            $delete->execute();
            if($delete){
                echo "<p class='container alert alert-success'>L'inscription a bien été supprimer avec succés!</p>";
                echo "<div class='container'><a href='membres.php' class='mt-3 btn btn-success'>RETOUR</a></div>";
                ?>
                    <style>
                        #form-delete{
                            display: none;
                        }
                    </style>
                <?php
            }else{
                echo "<p class='alert alert-danger'>Erreur lors de la supression de l'inscription !</p>";
                echo "<div class='container'><a href='membres.php' class='mt-3 btn btn-success'>RETOUR</a></div>";
            }

        }


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
       