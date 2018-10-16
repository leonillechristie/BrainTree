<?php

require __DIR__ . '/BrainTree.php';

// $customerFormData = [
//     'firstName' => 'John',
//     'lastName' => 'Doe',
//     'company' => 'Jones Co.',
//     'email' => 'mike.jones@example.com',
//     'phone' => '281.330.8004',
//     'fax' => '419.555.1235',
//     'website' => 'http://example.com'
// ];

$formData = [
	'customer' => [
		'firstName' => 'Jane',
	    'lastName' => 'Doey',
	    'company' => 'Jones Co.',
	    'email' => 'mike.jones@example.com',
	    'phone' => '281.330.8004',
	    'fax' => '419.555.1235',
	    'website' => 'http://example.com'
	],
	'card' => [
	    'number' => '4111111111111111',
	    'expirationDate' => '06/22',
	    'cvv' => '100'
	],
	'transaction' => [
		'amount' => 1000,
		'options' => [
			'storeInVaultOnSuccess' => true,
		]
	]
];

$transaction = buySomething($formData);

pretify($transaction);


function buySomething($data) {
	$brainTree = new BrainTree('6tk5p5f3sgbxbbqq', 'kcd7mmvjsy3k77s5', '1e9df5b93c4fa046a46f8acad634eeb1');

	$customer = $brainTree->createCustomer($data['customer']);

	pretify($customer);

	$data['card']['customerId'] = $customer->id;
	$data['transaction']['customerId'] = $customer->id;

	$card = $brainTree->createCard($data['card']);

	pretify($card);

	$nonce = $brainTree->createNonce($card->creditCard->token);
	$data['transaction']['paymentMethodNonce'] = $nonce;

	pretify($nonce);

	return $brainTree->createSale($data['transaction']);
}


function pretify($object) {
	echo "<pre>";
	print_r($object);
	echo "</pre><br/>";
}