<?php
    session_start();
?>

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
    <title>Document</title>
</head>
<body>
    <?php include "./components/header/header.php"; ?>

    <?php
        if (isset($_SESSION["data_user"])):
    ?>

    <section class="feuille" id="header_group">
            <p class="group_icon">
                <img src="./images/icones/icons8-foule-96.png">
            </p>
        <?php
            if (isset($_GET["id"])) {
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
                
                $sqlQuery = "SELECT id, name FROM groups WHERE id='".$_GET["id"]."'";
                $resultStatement = $db->prepare($sqlQuery);
                $resultStatement->execute();
                $list_result = $resultStatement->fetchAll();

                $a = "<h1>%s</h1>";
                echo sprintf($a, $list_result[0]["name"]);
            }
        ?>
        <p id="more"><span class="material-icons">more_vert</span></p>
    </section>
    <section class="feuille" id="displayer_expenses">
        <h2 style="width: 100%;"><span class="material-icons">shopping_bag</span> Dépenses du groupe</h2>
        <?php
            if (isset($_GET["id"])) {
                try {
                    $db1 = new PDO(
                        'mysql:host=145.14.156.192;dbname=u318358312_co_exchange;charset=utf8',
                        'u318358312_marc',
                        'R.Alan.Marc00'
                    );
                }
                catch (Exception $e) {
                    die("Erreur : ".$e->getMessage());
                }
                
                $sqlQuery = "SELECT * FROM expenses WHERE group_id='".$_GET["id"]."'";
                $resultStatement = $db1->prepare($sqlQuery);
                $resultStatement->execute();
                $list_result = $resultStatement->fetchAll();

                include "./components/expense_card.php";

                foreach ($list_result as $expense) {
                    expense_card($expense);
                }
            }
        ?>
    </section>

    <section class="feuille" id="displayer_expenses_group">
        <h1><span class="material-icons">price_check</span> Résumé des dépenses</h1>
        <canvas id="myCanvas" aria-label="chart" role="img"></canvas>
        <script type="text/javascript">
            let result = <?php echo json_encode($list_result); ?>;
        </script>
        <script src="./js/graph.js"></script>
    </section>

    <?php else: ?>

        <section class="feuille">
            <p>Veuilez-vous connecter ! 👉 <a href="./connexion.php" style="color: blue;">Cliquez-ici</a> 👈</p>
        </section>

    <?php
        endif;
        $db = null;
        $db1 = null;
    ?>
</html>