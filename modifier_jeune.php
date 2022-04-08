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
                        echo "<p class='container alert alert-success text-center'>Vous êtes connectez a PDO MySQL</p>";
                    
                            } catch (PDOException $e) {
                        print "Erreur !: " . $e->getMessage() . "<br/>";
                        die();
                    }
   
                    if($dbh){
                        $sql = "SELECT * FROM membres WHERE id_jeune = ?";
                    
                        $id_membres = $_GET['id_jeune'];
                        
                        $request = $dbh->prepare($sql);
                        $request->bindParam(1, $id_membres);
                        $request->execute();
                        $details = $request->fetch(PDO::FETCH_ASSOC);
   
                    }            
       ?>

        <div class="container">
            <div class="text-center">
                <h1 class="mx-auto my-0 text-uppercase">Modifier l'inscription</h1>                 
            </div>
                

            <form action="traitement_modifier_jeune.php?id_jeune=<?= $details['id_jeune'] ?>"  id="form-update" method="post" enctype="multipart/form-data">
                               
                
                <div class="mb-3">
                    <label for="prenom_jeune" class="form-label">prenom </label>
                    <input type="text" class="form-control" id="prenom_jeune" name="prenom_jeune" value="<?= $details['prenom_jeune'] ?>" required>
                </div>
                
                <div class="mb-3">
                    <label for="nom_jeune" class="form-label">Nom </label>
                    <input type="text" class="form-control" id="nom_jeune" name="nom_jeune" value="<?= $details['nom_jeune'] ?>" required>
                </div>

               

                <div class="mb-3">
                    <label for="téléphone" class="form-label">téléphone </label>
                    <input type="text" class="form-control" id="téléphone" name="téléphone" value="<?= $details['téléphone'] ?>" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">email </label>
                    <input type="text" class="form-control" id="email" name="email" value="<?= $details['email'] ?>" required>
                </div>
                
                <div class="mb-3">
                    <label for="age" class="form-label">Age</label>
                    <input type="text" class="form-control" id="age" name="age" value="<?= $details['age'] ?>"required >
                </div>

                <div class="mb-3">
                    <label for="étude" class="form-label">Etude </label>
                    <input type="text" class="form-control" id="étude" name="étude" value="<?= $details['étude'] ?>" required>
                </div>


                <div class="mb-3">
                    <label for="date_inscription" class="form-label">Date d'inscription</label>
                    <input type="date" class="form-control" id="date_inscription" name="date_inscription" value="<?= $details['date_inscription'] ?>"required >
                </div>


                <div class="mb-3">
                    <label for="photo" class="form-label">photo du jeune</label>
                    <input type="file" class="form-control" id="photo" name="photo"  value="<?= $details['photo'] ?>" required>
                </div>



                <div class="d-flex justify-content-around">
                    <button type="submit" name="btn-connexion" class="btn btn-warning">Mettre à jour</button>
                    <a href="membres.php" class="btn btn-success">Annuler</a>
                </div>
            </form>

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