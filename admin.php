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

$sql = "SELECT * FROM `utilisateur`";
$utilisateurs = $db->query($sql);

?>

<div class= text-center>
                <a href="membres.php" class="mt-3 btn btn-outline-secondary">Aller à la page d'acceuil</a>
 </div>
<div class="container">
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#ID</th>
            <th scope="col">Email</th>
            <th scope="col">Mot de passe</th>
            <th scope="col">EDITER</th>
            <th scope="col">SUPPRIMER</th>
        </tr>
        </thead>
        <tbody>
        <?php

        //fonction foreach parcours le tableau de ma table utlisateur
            foreach ($utilisateurs as $utilisateur){
                ?>
                <tr>
                    <th scope="row"><?= $utilisateur['id_user'] ?></th>
                    <td><?= $utilisateur['email'] ?></td>
                    <td><?= $utilisateur['password'] ?></td>

                    <td>
                        <a href="modifier_admin.php?id_utilisateur=<?= $utilisateur['id_user'] ?>" class="btn btn-success">EDITER</a>
                    </td>
                    
                    <td>
                        <a href="supprimer_admin.php?id_utilisateur=<?= $utilisateur['id_user'] ?>" class="btn btn-danger">SUPPRIMER</a>
                    </td>
                </tr>
        <?php
            }

        ?>


        </tbody>
    </table>
</div>
<?php
}else{
    header("Location: ../index.php");
}
?>
</body>
</html>
