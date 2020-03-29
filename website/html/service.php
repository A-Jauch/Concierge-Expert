<?php include 'config.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
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
                            <li><a href="../index.php">Accueil</a></li>
                            <li><a href="#">Services</a></li>
                            <a href="../index.php" id="logo"><img src="../img/logo.png" width="200px"></a>
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

  <center><form class="form-inline">
    <input class="form-control" id="search-service" type="text" placeholder="Find your movies" aria-label="Search">
    <button class="btn btn-warning" type="submit">Search</button>
  </form><br></center>

</body>

<footer>
    <br>
    <img src="../img/logo.png" width="80">
    <section id="bottom">
        <!--<p class="font">Conçu par : </br>JAUCH Anthony </br> BURIOT Vincent </br>JEAN-FRANCOIS Teddy</p>-->
    </section>
    <div><small> Concierge Expert - All rights reserved © </small></div>
    <br>
</footer>
</html>
