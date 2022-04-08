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


                $sql = "SELECT * FROM membres";
             //liste tous les element d'un tableau 
                $statement = $dbh->query($sql);
            }
        ?>

        <form method="post" >
            <div class= text-center>
                <button id="btn-deconnexion" class="btn btn-danger" name="btn-deconnexion">Déconnexion</button>
        </div>
        </form>
            <br>
            <div class= text-center>
                <a href="admin.php" class="mt-3 btn btn-outline-secondary">Tous les administrateurs</a>
            </div>
            <div class=text-center>
                 <a href="ajouter_admin.php" class="mt-3 btn btn-outline-secondary">Ajouter un administrateur</a>
            </div>
        <div class="container">
                <div class="text-center">
                 <a href="ajouter_unjeune.php" class="mt-3 btn btn-outline-secondary">ajouter une inscription</a>
                <h2 class="mt-3  text-success">Bienvenue <?= $_SESSION['email'] ?></h2>

                 <h2 class="mt-3  text-warning">  Les inscriptions 2021/2022</h2>
        
        </div>
              

                <div class="row">
                    <?php

                    //La structure de langage foreach permet de parcourir la table membre
                        foreach ($statement as $membres){
                            $date_inscription = new DateTime($membres['date_inscription']);
                        ?>
                            <div class="col-sm-12 col-lg-4 mt-5">
                                <div class="card">
                                    <div class="text-center">
                                        <h4 class="card-title text-info"><?= $membres['prenom_jeune'] ?></h4>
                                        <h4 class="card-title text-info"><?= $membres['nom_jeune'] ?></h4>
                                        <img src="<?= $membres['photo'] ?>" class="card-img-top img-fluid" alt="<?= $membres['prenom_jeune'] ?>" title="<?= $membres['nom_jeune'] ?>">
                                    </div>

                                
                                    <div class="card-body">

                                        <p class="card-text"><?= $membres['téléphone'] ?></p>
                                        <p class="card-text"><?= $membres['email'] ?></p>
                                        <p class="card-text"><?= $membres['étude'] ?></p>


                                        <p class="card-text text-success fw-bold">Age : <?= $membres['age'] ?> </p>
                                        <em class="card-text">Date d'inscription : <?= $date_inscription->format('d-m-Y') ?></em>
                                        <br />
                                        <div class="container-fluid d-flex justify-content-center">

                                           <a href="details_jeune.php?id_jeune=<?= $membres['id_jeune'] ?>" class="mt-2 btn btn-success">Détails </a>
                                           <a href="modifier_jeune.php?id_jeune=<?= $membres['id_jeune'] ?>" class="mt-2 btn btn-warning">Modifier </a>
                                           <a href="supprimerinscription.php?id_jeune=<?= $membres['id_jeune'] ?>" class="mt-2 btn btn-danger">Supprimer </a>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    ?>

                </div>
            </div>
        </div>
  
        <?php    

?>
        <script> src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>

<?php
    function deconnexion(){
        var_dump("hello");
        echo "elloo";
        session_unset();
        session_destroy();
        header('Location: index.php');
    }

    if(isset($_POST['btn-deconnexion'])){
        deconnexion();
    }

   }
   
   else{
    echo "<a href='' class='btn btn-warning'>S'inscrire</a>";
    header('Location: index.php');
}
?>
       