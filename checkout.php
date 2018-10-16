<?php

require __DIR__ . '/BrainTree.php';

$brainTree = new BrainTree('6tk5p5f3sgbxbbqq', 'kcd7mmvjsy3k77s5', '1e9df5b93c4fa046a46f8acad634eeb1');

if (count($_POST) === 0) {
  $customer = $brainTree->findCustomer(248324321);
  $cards = $customer->creditCards;  
} else {
  $data= [
    'customerId' => $_POST['customerId'],
    'amount' => 1000,
    'options' => [
      'storeInVaultOnSuccess' => true,
    ],
    'paymentMethodNonce' => $brainTree->createNonce($_POST['card'])
  ];

  $transaction = $brainTree->createSale($data);

  // echo '<pre>';
  // print_r($transaction);
  // echo '</pre>';
}

?>

<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  </head>

  <body style="text-align: center;padding-top: 10%;">
    <small style="padding-bottom: 10px;">Current Customer: <?=$customer->firstName?> <?=$customer->lastName?></small>
    <h3>Checkout Page</h3>
    
    <form style="width : 500px; margin: auto;" method="POST">
      <div class="form-group">
        <input type="hidden" value="248324321" name="customerId">
        <label for="totalAmount">Total</label>
        <input type="text" class="form-control" name="totalAmount" id="totalAmount" placeholder="Total">
      </div>

      <div class="form-group">
        <label for="card">Select Credit Card</label>
        <select class="form-control" id="card" name="card">
          <?php foreach($cards as $card) { ?>
            <option value="<?=$card->token?>">********<?=$card->last4?></option>
          <?php } ?>
        </select>
      </div>

      <button type="submit" class="btn btn-primary" style="margin-top: 20px; margin-bottom: 20px;">Complete Payment</button>
    </form>

    <a href="addCard.php">Add New Payment Method</a>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  </body>
</html>