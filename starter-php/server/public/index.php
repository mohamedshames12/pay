<?php

  require './shared.php';


  // product id -> lookup id db

  $paymentIntent = $stripe->paymentIntents->create([
    'amount' => 1099,
    'currency' => 'eur',
    'automatic_payment_methods' => ['enabled' => true]
  ])
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
      <p>Accept a payment</p>

      <form id="payment-form">
        <div id="payment-element"></div>
        <button>pay</button>
        <div id="error-message"></div>
      </form>

    </main>




    <script src="https://js.stripe.com/v3/"></script>
    <script>
      const stripe = Stripe('<?= $_ENV["STRIPE_PUBLISHABLE_KEY"] ?>');
      const elements = stripe.elements({
        clientSecret: '<?= $paymentIntent->client_secret ?>'
      });

      const paymentElement = elements.create('payment');
      paymentElement.mount("#payment-element");

      const form = document.getElementById('payment-form');

      form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const {error} = await stripe.confirmPayment({
          elements,
          confirmParams: {
            return_url: window.location.href.split('?')[0] + 'complete.php'
          }
        })
        if(error) {
          const messages = document.getElementById("error-message");
          messages.innerText = error.message;
        }
      });
    </script>
  </body>
</html>
