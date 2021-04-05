<?php

session_start();

require_once("PayPalClient.php");
require_once("../../../models/Payments/ProductDatabase.php");

use PayPalCheckoutSdk\Orders\OrdersCreateRequest;

class CreateOrder {

	private $_CURRENCY = "EUR";
	private $_producto;
	private $_cuentaDestino;

	public function __construct($email, $nombreProducto, $precioProducto) {
		$this->_producto['nombre'] = $nombreProducto;
		$this->_producto['precio'] = $precioProducto;
		$this->_cuentaDestino = $email;
	}
	
	public function getRespose()
	{
		$request = new OrdersCreateRequest();
		$request->prefer('return=minimal');
		$request->body = self::buildRequestBody();

		try {
			// 3. Call PayPal to set up a transaction
			$client = PayPalClient::client();
			$response = $client->execute($request);

			// 4. Return a successful response to the client.
			return json_encode($response);

		} catch (HttpException $ex) {
			echo $ex->statusCode;
			print_r($ex->getMessage());
		}
	}

	/**
	 * Setting up the JSON request body for creating the order with minimum request body. The intent in the
	 * request body should be "AUTHORIZE" for authorize intent flow.
	 */
	private function buildRequestBody() {

		return array(
			'intent' => 'CAPTURE',
			'application_context' =>
				array(
					'brand_name' => 'Winter Argentum Online',
					'locale' => 'es-ES',
					// 'return_url' => 'https://example.com/return',
					// 'cancel_url' => 'https://example.com/cancel'
				),
			'purchase_units' =>
				array(
					0 =>
						array(
							'custom_id' => $_GET['productID'],
							'reference_id' => $this->_cuentaDestino,
							'description' => $this->_producto['nombre'],
							'amount' =>
								array(
									'currency_code' => $this->_CURRENCY,
									'value' => $this->_producto['precio'],
								)
						)
				)
		);
	}
}


/**
 * Acá es donde se crea un objeto `CreateOrder` con la info. de la respuesta de la API de Paypal
 * La obtenemos y devolvemos llamando a `getResponse()`
 */
if (!count(debug_backtrace())) 
{
	if (isset($_GET['productID'])) {
		$idProducto = $_GET['productID'];
	} else {
		die("Faltan parámetros: productID");
	}

	// Si existe el producto en el array...
	if (array_key_exists($idProducto, $productos))
	{
		if (isset($_SESSION['email']) === false) {
			die("Debes iniciar sesión para hacer una compra!");
		}

		$nombre = $productos[$idProducto]['nombre'];
		$precio = $productos[$idProducto]['precio'];

		// Creamos la orden y mostramos el resultado.
		$order = new CreateOrder($_SESSION['email'], $nombre, $precio);
		echo($order->getRespose());
	
	} 
	else 
	{
		die("El producto que deseas comprar NO EXISTE");
	}
}

?>