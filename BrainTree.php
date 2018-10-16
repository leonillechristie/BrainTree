<?php

require __DIR__ . '/libraries/braintree/lib/autoload.php';

class BrainTree
{
	/**
	 * @var Braintree_Gateway
	 */
	protected $gateway;

	/**
	 * BrainTree constructor.
	 *
	 * @param string $merchantId
	 * @param string $publicKey
	 * @param string $privateKey
	 */
	public function __construct($merchantId, $publicKey, $privateKey)
	{
		$this->gateway = new Braintree_Gateway([
		    'environment' => 'sandbox',
		    'merchantId' => $merchantId,
		    'publicKey' => $publicKey,
		    'privateKey' => $privateKey
		]);
	}

	public function createCustomer($formData) {
		$result = $this->gateway->customer()->create($formData);

		return $result->customer;
	}

	public function createCard($cardInfo) {
		$result = $this->gateway->creditCard()->create($cardInfo);

		return $result;
	}

	public function createSale($data) {
		$result = $this->gateway->transaction()->sale($data);

		return $result;
	}

	public function createNonce($cardToken) {
		$result = $this->gateway->paymentMethodNonce()->create($cardToken);

		return $result->paymentMethodNonce->nonce;
	}

	public function findCustomer($id) {
		return $this->gateway->customer()->find($id);
	}
}