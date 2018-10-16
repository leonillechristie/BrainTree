<?php

require __DIR__ . '/BrainTree.php';

$brainTree = new BrainTree('6tk5p5f3sgbxbbqq', 'kcd7mmvjsy3k77s5', '1e9df5b93c4fa046a46f8acad634eeb1');

if (count($_POST) === 0) {                                // If there is nothing posted
  $customer = $brainTree->findCustomer(248324321);        // Static ID
  $cards = $customer->creditCards;                        
} else {
  $data= [                                                // FormData
    'customerId' => $_POST['customerId'],
    'number' => $_POST['cardNumber'],
    'expirationDate' => $_POST['expirationDate'],
    'cvv' => $_POST['cardCVV']
  ];

  $newCard = $brainTree->createCard($data);

  echo '<pre>';
  print_r($newCard);
  echo '</pre>';
}

?>

<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  </head>

  <body style="text-align: center; padding-top: 4%;">
    <small style="padding-bottom: 10px;">Current Customer: <?=$customer->firstName?> <?=$customer->lastName?></small>
    <h3>Add Card</h3>

    <form style="width : 500px; margin: auto;" method="POST">
      <h5>Input Card Information</h5>

      <div class="form-group">
        <input type="hidden" value="248324321" name="customerId">
        <label for="cardNumber">Card Number</label>
        <input type="text" class="form-control" name="cardNumber" id="cardNumber" placeholder="12-19 Digits">
      </div>

      <div class="form-group">
        <label for="expirationDate">Expiration Date</label>
        <input type="text" class="form-control" name="expirationDate" id="expirationDate" placeholder="MM/YYYY">
      </div>

      <div class="form-group">
        <label for="cardCVV">Card CVV</label>
        <input type="text" class="form-control" name="cardCVV" id="cardCVV" placeholder="123">
      </div>

      <button type="submit" class="btn btn-primary" style="margin-top: 20px;">Add Card</button>
    </form>
    
    <div style="padding-top: 30px; width : 500px; margin: auto;">
      <h5>Currently Listed Cards:</h5><br>

      <table class="table">
        <thead>
          <tr>
            <th scope="col">Expiration Date</th>
            <th scope="col">Credit Card Number</th>
          </tr>
        </thead>
        <tbody>
            <?php foreach($cards as $card) { ?>
          <tr>
            <td class=""><?=$card->expirationDate?></td>
            <td class="">********<?=$card->last4?></td>
          </tr>
            <?php } ?>
        </tbody>
      </table> 
    </div>

    <a href="checkout.php">Go to Checkout</a>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  </body>
</html>