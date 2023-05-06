<?php

    require './shared.php';

    $paymentIntent = $stripe->paymentIntents->retrieve($_GET["payment_intent"]);

    

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Stripe Sample</title>

    <link rel="stylesheet" href="/css/base.css" />
  </head>
  <body>
 

    <main>
      <p>Complete</p>

      <pre> <?= json_encode($paymentIntent, JSON_PRETTY_PRINT) ?> </pre>
    </main>

  </body>
</html>