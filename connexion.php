<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./style/main.css" rel="stylesheet">
    <link rel="icon" href="./images/logo/logo_r_rasandison.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src="./js/jquery-3.6.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js" crossorigin="anonymous"></script>
    <title>Connexion</title>
</head>
<body id="body_connexion">
    <?php
        include "./components/header/header.php";

        if (isset($_SESSION["data_user"])) {
            header("Location: ./home.php");
            exit();
        }

        if (isset($_POST["email_connexion"]) && isset($_POST["password_connexion"])) {
            $notFound = false;
            try {
                $db = new PDO(
                    'mysql:host=145.14.156.192;dbname=u318358312_co_exchange;charset=utf8',
                    'u318358312_marc',
                    'R.Alan.Marc00'
                );
            }
            catch (Exception $e) {
                die("Erreur : ".$e->getMessage());
            }
            
            $sqlQuery = "SELECT * FROM users";
            $resultStatement = $db->prepare($sqlQuery);
            $resultStatement->execute();
            $list_result = $resultStatement->fetchAll();

            foreach($list_result as $user) {
                if (($user["email"] == $_POST["email_connexion"]) && ($user["password"] == $_POST["password_connexion"])) {
                    $_SESSION["data_user"] = $_POST["email_connexion"];
                    header("Location: ./home.php");
                    exit();
                }
                else {
                    $notFound = true;
                }
            }
        }
    ?>

    <section class="feuille" id="section_connexion">
        <form id="form_connexion" method="POST">
            <fieldset id="fieldset_connexion">
                <legend>Sign In</legend>
                <?php
                    if(isset($notFound)) {
                        if ($notFound == true) {
                            echo "<p style=\"color: red;\">Erreur dans l'adresse email ou le mot de passe</p>";
                        }
                    }
                ?>
                <p>
                    <input type="email" placeholder="Your_email@mail.com" name="email_connexion" id="email_connexion" required>
                </p>
                <p>
                    <input type="password" name="password_connexion" id="password_connexion" placeholder="Your_PASSWORD" required>
                </p>
                <p>
                    <input type="submit" value="Connect Me">
                </p>
            </fieldset>
        </form>
    </section>

    <section class="feuille" id="section_inscription">
        <form id="form_inscription" method="POST">
            <fieldset id="fieldset_inscription">
                <legend>Sign Up</legend>
                <p>
                    <input type="text" name="last_name" id="last_name" placeholder="Your last name">
                </p>
                <p>
                    <input type="text" name="first_name" id="first_name" placeholder="Your first name" required>
                </p>
                <p>
                    <input type="email" placeholder="Your_email@mail.com" name="email_inscription" id="mail_inscription" required>
                </p>
                <p>
                    <input type="password" name="password_inscription" id="password_inscription" placeholder="Your_PASSWORD" required>
                </p>
                <p>
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm your_PASSWORD" required>
                </p>
                <p>
                    <input type="submit" value="Register Me">
                </p>
            </fieldset>
        </form>
    </section>
</body>
</html>