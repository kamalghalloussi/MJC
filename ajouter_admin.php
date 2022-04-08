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
}catch (PDOException $exception){
    echo "erreur " .$exception->getMessage();
}

?>    


<form method="post">
            <div class= text-center>
            <button id="btn-deconnexion" class="btn btn-danger" name="btn-deconnexion">Déconnexion</button>
            </div>
</form>

<br>

<br>

<div class="container">
    <form method="post" id="form-register">
        <h4 class="text-center text-info">AJOUTER UN ADMINISTRATEUR</h4>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email"  placeholder="machin@bidule.fr" required>

        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="NXSQN39NCEZN293NC2" required>
        </div>

        <div class="mb-3">
            <label for="password_repeat" class="form-label">Répeter le mot de passe</label>
            <input type="password" class="form-control" id="password_repeat" name="password_repeat"  required>
        </div>

        <input type="hidden" value="ADMIN" name="role">
        
        <div class="d-flex justify-content-center">

         <button type="submit" name="btn-ajouter-admin" class="mt-3 btn btn-info">AJOUTER ADMINISTRATEUR</button>
         <br>
        <a href="membres.php" class="mt-3 btn btn-success">Annuler l'opération</a>
        </div>

    </form>
</div>


<?php


//Desinfecter les champs avec la fonction specialchars
//lutter contre faille XSS 
//htmlspecialchar = transforme les caractère speciaux (ex: <script>) en chaine de caractère
$emailAdmin = trim(htmlspecialchars($_POST['email']));
$passwordAdmin = trim(htmlspecialchars($_POST['password']));
$password_repeat_admin = trim(htmlspecialchars($_POST['password_repeat']));

if(isset($emailAdmin) && !empty($emailAdmin) && isset($passwordAdmin) && !empty($passwordAdmin)){
    if($passwordAdmin === $password_repeat_admin){
        $sql = "INSERT INTO `utilisateur`(`email`,`password`) VALUES (?,?)";
        $insertUser = $db->prepare($sql);

        $insertUser->bindParam(1, $emailAdmin);
        $insertUser->bindParam(2, $passwordAdmin);

        $insertUser->execute(array(
            $emailAdmin,
            $passwordAdmin
        ));

        if($insertUser){
            ?>
            <div class="container">
            <?php
            echo "<p class='alert alert-success p-3 mt-3'>Vous etes inscrits</p>";
            echo "<a class='btn btn-success mt-3' href='index.php'>Se connecter</a>";
            ?>
            </div>
          
            <style>
                #form-register{
                    display: none;
                }
            </style>
            <?php
        }else{
            echo "<div class='container'>
                <p class='alert alert-danger'>Merci de remplir tous les champs !</p></div>";
        }

    }else{
        echo "<div class='container'>
            <p class='alert alert-danger'>Les 2 mots de passe ne sont pas identiques</p></div>";
    }
}

?>


</body>

</html>


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
       
