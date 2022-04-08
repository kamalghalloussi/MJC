<?php
session_start();
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
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="#page-top">MJC KIFF TA VIE</a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation">
                
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#about"> A PROPOS</a></li>
                    <li class="nav-item"><a class="nav-link" href="#projects"> NOS PROJETS </a></li>
                    <li class="nav-item"><a class="nav-link" href="#signup">CONTACTS</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <header class="masthead">
        <div class="container px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center">
            <div class="d-flex justify-content-center">
        
         <div class="container-fluid">
            <form  id="formulaire-connexion" method="post">
                <div class="mb-3">
                    <label for="email" class="form-label">Votre Email</label>
                    <input type="email" class="form-control" name="email" id="email"  required/>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Votre mot de passe</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" required>
                </div>
                <button type="submit" name="btn-connexion" class="btn btn-primary">Connexion</button>
            </form>
        </div>        
            </div>
        </div>
        
        <?php
            
            function connexion(){


    
                $utilisateur_phpadmin = "root";
                $mot_passe_phpadmin = "";
                $dbname = "mjc";
                $host = "localhost";


                try { 

                    //Connexion avec l’interface PDO (PHP DATA OBJECT), sert à interroger une base de donnée via des requêtes SQL.

                    $db = new PDO("mysql:host=".$host.";dbname=".$dbname.";charset=UTF8", $utilisateur_phpadmin, $mot_passe_phpadmin);
                    //debug de la connexion SQL
                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    //bloc erreur si la connexion à la bdd ne focntionne pas

                }catch (PDOException $exception){
                    echo "Erreur de connexion a PDO MySQL " . $exception->getMessage();
                    var_dump($db);
                    die();
                }


                //Conditionnement des champs
                if(isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['password']) && !empty($_POST['password'])){

                    //lutte contre les faille XSS (injection de code malveillant interpreté  ble par le navigateur)
                    
                    $emailUtilisateur = trim(htmlspecialchars($_POST['email']));
                    $passwordUtilisateur = trim(htmlspecialchars($_POST['password']));

                    $sql = "SELECT * FROM utilisateur WHERE email = ? AND password = ?";

                    $connexion = $db->prepare($sql);

                    //liaison des parametre du formulaire à la requete SQL

                    $connexion->bindParam(1, $emailUtilisateur);
                    $connexion->bindParam(2, $passwordUtilisateur);

                    $connexion->execute();

                    ////Si on a au moins 1 utilisateur dans table (index du tableau commence par 0)


                    if($connexion->rowCount() >= 0){

                        //fetch écupère la ligne suivante de la fonction ligne
                        
                        $ligne = $connexion->fetch();
                        if($ligne){
                            $email = $ligne['email'];
                            $password = $ligne['password'];

                            //Condition de connexion, si entrée utilisateur = valeurs dans la table pour email et mot de passe
                            if($emailUtilisateur === $email && $passwordUtilisateur === $password){
                                //On stock la connexion dans une variable de session et on redirige ves la page d'accueil

                                $_SESSION['email'] = $emailUtilisateur;
                                header("Location: membres.php");
                            }else{ 
                                
                                //Erreur de mail et mot de passe

                                echo "<div class='mt-3 container'>
                            <p class='alert alert-danger p-3'>Erreur de connexion: merci de verifié votre email et mot de passe</p>
                            </div>";
                            }
                        }else{

                            echo "<div class='mt-3 container'>
                            <p class='alert alert-danger p-3'>Aucun utilisateur dans votre table</p>
                            </div>";
                        }

                    }else{
                        
                        echo "Votre table est vide";
                    }


                }else{
                    echo "Merci de remplir tous les champs";
                }

            }     //Le clic sur le bouton on appel la fonction de  connexion

                if(isset($_POST['btn-connexion'])){
                connexion();}
         ?>

    </header>


         

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
