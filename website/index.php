<?php include 'html/config.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Concierge Expert</title>
</head>
<body>
<header>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-11 col-xs-12">
                <nav>
                    <div class="align">
                        <ul>
                            <li><a href="#">Accueil</a></li>
                            <li><a href="#">Services</a></li>
                            <a href="index.php" id="logo"><img src="img/logo.png" width="200px"></a>
                            <li><a href="#">Contact</a></li>
                            <li><a href="#">
                                    <button type="button" class="btn btn-primary" id="area">Espace client</button>
                                </a></li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>

<main>
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="img/background.jpg" class="d-block w-100" class="background">
            </div>
        </div>

    </div>

    </br>
    <center><h1 class="font">Nos services les plus demandés</h1></center>

    <?php
    $req2 = $bdd->prepare("SELECT * FROM SERVICE WHERE add_index = 'yes'");
    $req2->execute();
    ?>

    <div class="container">
        <div class="row">
            <?php if ($req2->rowCount() > 0) { ?>
                <?php while ($row = $req2->fetch(PDO::FETCH_ASSOC)) { ?>
                    <!-- Ajout d'un service sur l'écran d'accueil -->

                    <div class="col-lg-4 col-sm-6 col-xs-12">
                        <div class="card text-center box" style="width: 20rem;">
                            <center><img class="size" width="300px" height="300px"
                                         src="<?= 'html/back_office/' . $row['image']; ?>"></center>
                            <div class="card-body">
                                <h5 class="card-title"><?= '<h3><b>' . $row['name'] . '</b></h3>'; ?></h5>
                                <a href="html/reservation.php?name=<?= $row['name']; ?>" class="btn btn-primary">Reservation</a>
                            </div>
                        </div>
                    </div>

                <?php } ?>
            <?php } ?>
        </div>
    </div>

    <br>
    <center><a href="html/back_office/add_service.php">
            <button type="button" class="btn btn-primary">Ajouter un service</button>
        </a></center>
    <br>
    <center><a href="html/back_office/delete_service.php">
            <button type="button" class="btn btn-danger">Supprimer un service</button>
        </a></center>
    </br>

    <section class="presentation">
        <div class="container">
            <div class="row" id="grey_box">
                <div class="col-md-6">
                    <div class="md-form">
                        <img src="img/description.jpg" width="400px" class="costumer" class="col-lg-4 col-md-12">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="md-form">
                        <h2 id="bio">L'excellence avant tout !</h2></br>
                        <p id="description">Depuis plus de 40 ans, notre société tend à se perfectionner pour
                            vous proposer les meilleurs services d'une qualité toujours exemplaire.</p></br>
                        <center><a href="html/devis.php">
                                <button type="button" class="btn btn-success">Demandez votre devis</button>
                            </a></center>
                        </br>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="md-form">
                        <center><h2 id="title">Pourquoi choisir <b>Concierge Expert</b> ?</h2></br></center>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="md-form">
                        <center><img src="img/character.png" width="150px"><br>
                            <p id="text">Des expert(e)s confirmé(e)s </br>& certifié(e)s</p></center>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="md-form">
                        <center><img src="img/euros.png" width="190px"><br>
                            <p id="text">Des prix défiants </br>toute concurrence</p></center>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="md-form">
                        <center><img src="img/client.png" width="160px"><br>
                            <p id="text">Un service client </br>des plus réactifs</p></center>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
</main>

</body>

<footer>
    <br>
    <img src="img/logo.png" width="80">
    <section id="bottom">
        <!--<p class="font">Conçu par : </br>JAUCH Anthony </br> BURIOT Vincent </br>JEAN-FRANCOIS Teddy</p>-->
    </section>
    <div><small> Concierge Expert - All rights reserved © </small></div>
    <br>
</footer>
</html>
