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
                    $sql =  "SELECT * FROM `utilisateur` WHERE id_user=?";
                
                    $id_utilisateur = $_GET['id_utilisateur'];
                    
                    $request = $dbh->prepare($sql);
                    $request->bindParam(1, $id_utilisateur);
                    $request->execute();
                    $details = $request->fetch(PDO::FETCH_ASSOC);

                } 
                
                     
   ?>
   

<div class="container">
            <div class="text-center">
                <h1 class="mx-auto my-0 text-uppercase">Modifier les administrateurs</h1>                 
            </div>
                

            <form action="traitement_modifier_admin.php?id_user=<?= $details['id_user'] ?>"  id="form-update" method="post" enctype="multipart/form-data">
                               
                
                
                <div class="mb-3">
                    <label for="email" class="form-label">Email </label>
                    <input type="text" class="form-control" id="email" name="email" value="<?= $details['email'] ?>" required>
                </div>
                
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="text" class="form-control" id="password" name="password" value="<?= $details['password'] ?>"required >
                </div>

                
                <div class="d-flex justify-content-around">
                    <button type="submit" name="btn-connexion" class="btn btn-warning">Mettre à jour</button>
                    <a href="admin.php" class="btn btn-success">Annuler</a>
                </div>
            </form>

        </div>

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
       