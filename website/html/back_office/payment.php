<?php
session_start();
function debug($variable)
{
    echo '<pre>' . print_r($variable, true) . '</pre>';
}
include '../config.php';
if (isset($_POST['token'])){
    require_once 'stripe/init.php';
    \Stripe\Stripe::setApiKey('sk_test_feqSYFv1Ln99D1PmBxpM4BZO00V6nPwdcS');

    $customer = \Stripe\Customer::create(array(
        'email' =>  $_POST['email_address'],
        'source' => $_POST['token'],
        'name' => $_POST['customer_name'],
        'address' => array(
            'line1'         => $_POST['customer_address'],
            'postal_code'   => $_POST['customer_pin'],
            'city'          => $_POST['customer_city'],
            'state'         => $_POST['customer_state'],
            'country'       => $_POST['customer_country']
        )
    ));

        $order_number = rand(100000,999999);

        $charge = \Stripe\Charge::create(array(
            'customer' => $customer->id,
            'amount' => $_POST['total_amount'] *100,
            'currency' => $_POST['currency'],
            'description' => $_POST['item_details'],
            'metadata' => array(
                    'order_id' => $order_number
            )
        ));

        $response = $charge->jsonSerialize();
        if ($response['amount_refunded'] == 0 && empty($response['failure_code']) && $response['paid'] == 1 && $response['captured'] == 1 && $response['status'] == 'succeeded')
        {
            $amount = $response['amount'];

            $order_data = array(
                ':order_number' => $order_number,
                ':order_total_amount' => $amount/100,
                ':transaction_id' => $response['balance_transaction'],
                ':card_cvc' => $_POST['card_cvc'],
                ':card_expiry_month' => $_POST['card_expiry_month'],
                ':card_expiry_year' => $_POST['card_expiry_year'],
                ':order_status' => $response['status'],
                ':card_holder_number' => $_POST['card_holder_number'],
                ':email_address' => $_POST['email_address'],
                ':customer_name' => $_POST['customer_name'],
                ':customer_address' => $_POST['customer_address'],
                ':customer_city' => $_POST['customer_city'],
                ':customer_pin' => $_POST['customer_pin'],
                ':customer_state' => $_POST['customer_state'],
                ':customer_country' => $_POST['customer_country']
            );

            $req = $bdd->prepare("INSERT INTO order_table
        (order_number, order_total_amount, transaction_id,
            card_cvc, card_expiry_month, card_expiry_year,
            order_status, card_holder_number, email_address,
            customer_name, customer_address, customer_city,
            customer_pin, customer_state, customer_country,idUser,serviceName) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

            debug($order_data);
            $req->execute([$order_data[':order_number'],$order_data[':order_total_amount'],$order_data[':transaction_id'],
                $order_data[':card_cvc'],$order_data[':card_expiry_month'],$order_data[':card_expiry_year'],$order_data[':order_status'],
                $order_data[':card_holder_number'],$order_data[':email_address'],$order_data[':customer_name'],$order_data[':customer_address'],$order_data[':customer_city']
                ,$order_data[':customer_pin'],$order_data[':customer_state'],$order_data[':customer_country'],$_SESSION['id'],$_POST['item_details']]);

            $order_id = $bdd->lastInsertId();



            /*    debug($_POST);
                debug($_SESSION);
                debug($req);*/


               $req2=$bdd->prepare("UPDATE " . $_POST['item_details'] . " SET order_id = " . $order_id . " WHERE id =" .$_POST['last_id']);
               $req2->execute();


            $req3=$bdd->prepare("UPDATE subscription SET order_id = " . $order_id . " WHERE id =" .$_POST['last_id']);

            $req3->execute();



        }
}
header("location:account.php");
exit;?>

<html>
<head>
    <meta charset="utf-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="js/jquery.creditCardValidator.js"></script>
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/style.css">



    <title>Terminal Paiement</title>
</head>
<body>

<header>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-11 col-xs-12">
                <nav>
                    <div class="align">
                        <ul>
                            <li><a href="../../index.php">Accueil</a></li>
                            <li><a href="../service.php">Services</a></li>
                            <a href="../../index.php" id="logo"><img src="../../img/logo.png" width="150px" alt="logo"></a>
                            <li><a href="#">Contact</a></li>
                            <?php
                            $connected = isset($_SESSION['mail']) ? true : false;
                            if ($connected) { ?>
                                <li><a href="html/deconnection.php">
                                        <button type="button" class="btn btn-primary">Déconnexion</button>
                                    </a>
                                </li>
                            <?php } else { ?>
                                <li><a href="html/connection.php">
                                        <button type="button" class="btn btn-primary">Espace Client</button>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>



</body>

<footer>
    <br>
    <img src="../..//img/logo.png" width="80">
    <section id="bottom">
        <!--<p class="font">Conçu par : </br>JAUCH Anthony </br> BURIOT Vincent </br>JEAN-FRANCOIS Teddy</p>-->
    </section>
    <div><small> Concierge Expert - All rights reserved © </small></div>
    <br>
</footer>
</html>
