<?php session_start();
include 'config.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>Abonnement</title>
</head>

<body class="bodi">

    <header>
        <nav>
            <div class="align">
                <ul>
                    <li><a href="../index.php">Home</a></li>
                    <li><a href="#">Services</a></li>
                    <a href="../index.php" id="logo"><img src="../img/logo.png" width="200px"></a>
                    <li><a href="subscription.php">Abonnement</a></li>

                    <?php
                    $connected = isset($_SESSION['mail']) ? true : false;
                    if($connected) { ?>
                        <li><a href="deconnection.php"><button type="button" class="btn btn-primary">Déconnexion</button></a></li>
                    <?php } else { ?>
                        <li><a href="connection.php"><button type="button" class="btn btn-primary">Client area</button></a></li>
                    <?php } ?>
                </ul>
            </div>
        </nav>
    </header>

    <main>
        <div class="container">
            <div class="row centered-form">
                <div class="col-lg-12 col-xl-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <center><h3 class="font">Abonnement</h3></center>
                            <br><br>
                            <?php
                            if(isset($_GET['error']) && $_GET['error'] == 'connected') {
                                echo '<p style="color: red;">Il faut être connecté pour s\'abonner</p>';
                            }

                            if(isset($_GET['error']) && $_GET['error'] == 'succeed' && $_GET['sub'] == 'base') {
                                echo '<p style="color: red;">Achat de l\'abonnement de ' . $_GET['sub'] . ' réussi</p>';
                            }

                            if(isset($_GET['error']) && $_GET['error'] == 'succeed' && $_GET['sub'] == 'family') {
                                echo '<p style="color: red;">Achat de l\'abonnement ' . $_GET['sub'] . ' réussi</p>';
                            }

                            if(isset($_GET['error']) && $_GET['error'] == 'succeed' && $_GET['sub'] == 'premiumm') {
                                echo '<p style="color: red;">Achat de l\'abonnement ' . $_GET['sub'] . ' réussi</p>';
                            }
                            ?>
                            <div class="card" style="width: 33%; display: inline-block;">
                                <div class="card-body">
                                    <h5 class="card-title" style="text-align: center">Abonnement de base</h5><br>
                                    <p class="card-text" style="text-align: center">Bénéficiez d'un accès privilégie en ilimité 5j/7 de 9h à 20h</p>
                                    <br>
                                    <p class="card-text" style="text-align: center">12h de services/mois</p><br>
                                    <center><a href="subscription/subscription_base.php" class="btn btn-primary">S'abonner</a></center>
                                </div>
                            </div>
                            <div class="card" style="width: 33%; display: inline-block;">
                                <div class="card-body">
                                    <h5 class="card-title" style="text-align: center">Abonnement Familial</h5><br>
                                    <p class="card-text" style="text-align: center">Bénéficiez d'un accès privilégie en ilimité 6j/7 de 9h à 20h</p>
                                    <br>
                                    <p class="card-text" style="text-align: center">25h de services/mois</p><br>
                                    <center><a href="subscription/subscription_family.php" class="btn btn-primary">S'abonner</a></center>
                                </div>
                            </div>
                            <div class="card" style="width: 33%; display: inline-block;">
                                <div class="card-body">
                                    <h5 class="card-title" style="text-align: center">Abonnement Premium</h5><br>
                                    <p class="card-text" style="text-align: center">Bénéficiez d'un accès privilégie en ilimité 7j/7 24h/24</p>
                                    <br>
                                    <p class="card-text" style="text-align: center">50h de services/mois</p><br>
                                    <center><a href="subscription/subscription_premium.php" class="btn btn-primary">S'abonner</a></center>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <br>
        <section id="bottom">
            <a href=""><img src="../img/logo.png" width="80"></a>
            <div><small> Concierge Expert - All rights reserved © </small></div>
        </section>
        <br>
    </footer>

</body>

</html>

