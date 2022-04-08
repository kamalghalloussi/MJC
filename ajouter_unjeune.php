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


<form method="post">
            <div class= text-center>
            <button id="btn-deconnexion" class="btn btn-danger" name="btn-deconnexion">Déconnexion</button>
            </div>
</form>

<br>

<br>

<form action="traitement_ajouter_jeune.php"  id="form-login" method="post" enctype="multipart/form-data">

            
<div class=container>

                <div class="text-center">
                    <h2> AJOUTER UNE INSCRIPTION</h2>
               </div>
                <div class="mb-3">
                    <label for="prenom_jeune" class="form-label">Prénom</label>
                    <input type="text" class="form-control" id="prenom_jeune" name="prenom_jeune" placeholder="Prénom" required>
                </div>

                <div class="mb-3">
                    <label for="nom_jeune" class="form-label">Nom </label>
                    <input type="text" class="form-control" id="nom_jeune" name="nom_jeune" placeholder="Nom" required>
                </div>

                <div class="mb-3">
                    <label for="téléphone" class="form-label">Téléphone </label>
                    <input type="text" class="form-control" id="téléphone" name="téléphone" placeholder="Téléphone" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email </label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="Email" required>
                </div>

                <div class="mb-3">
                    <label for="age" class="form-label">Age </label>
                    <input type="text" class="form-control" id="age" name="age" placeholder="age" required>
                </div>

                <div class="mb-3">
                    <label for="étude" class="form-label">Etude </label>
                    <input type="text" class="form-control" id="étude" name="étude" placeholder="étude" required>
                </div>
            

                <div class="mb-3">
                    <label for="date_inscription" class="form-label">Date d'inscription</label>
                    <input type="date" class="form-control" id="date_inscription" name="date_inscription" placeholder="date d'inscription" required>
                </div>
          

                <div class="mb-3">
                    <label for="photo" class="form-label">Image du produit</label>
                    <input type="file" class="form-control" id="image" name="photo" required>
                </div>

                <div class="d-flex justify-content-around">
                    <button type="submit" name="btn-connexion" class="btn btn-warning">Ajouter</button>
                    <a href="membres.php" class="btn btn-success">Annuler</a>
                </div>
            </form>
        </div>
        

        </div>
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