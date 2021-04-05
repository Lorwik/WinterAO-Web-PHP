<?php

session_start();

require_once("PayPalClient.php");
require_once("../../../models/Payments/PaymentProcess.php");
require_once("../../../models/Payments/ProductDatabase.php");

// 1. Import the PayPal SDK client that was created in `Set up Server-Side SDK`.
use PayPalCheckoutSdk\Orders\OrdersGetRequest;

// 2. Set up your server to receive a call from the client
/**
  * You can use this function to retrieve an order by passing order ID as an argument.
  */
function getOrderDetails($orderID){
  
  	// Here, OrdersCaptureRequest() creates a POST request to /v2/checkout/orders
  	// $response->result->id gives the orderId of the order created above
  	$client = PayPalClient::client();
  	$request = new OrdersGetRequest($orderID);
  
  	try {
    	// Call API with your client and get a response for your call
    	$response = $client->execute($request);
      
    	// If call returns body in response, you can get the deserialized version from the result attribute of the response
		return json_encode($response);
		
  	} catch (HttpException $ex) {
      	echo $ex->statusCode;
      	print_r($ex->getMessage());
  	}

}

/**
 * This driver function invokes the getOrderDetails function to retrieve the order details of the given ID.
 */
if (!count(debug_backtrace())) {
  
  	// Response from PayPal API
  	$orderResponse = getOrderDetails($_GET['orderID']);
  
  	// We get the response from PayPal API and decode it into an array.
  	$orderData = json_decode($orderResponse);

  	// If the transaction was successful, we update the gem quantity.
  	/*
    	The order status. The possible values are:
      		CREATED. The order was created with the specified context.
      		SAVED. The order was saved and persisted. The order status continues to be in progress until a capture is made with final_capture = true for all purchase units within the order.
     		APPROVED. The customer approved the payment through the PayPal wallet or another form of guest or unbranded payment. For example, a card, bank account, or so on.
      		VOIDED. All purchase units in the order are voided.
      		COMPLETED. The payment was authorized or the authorized payment was captured for the order.
  	*/
	if ($orderData->result->status == 'APPROVED') {

		$email = $orderData->result->purchase_units[0]->reference_id;
        $producto_id = $orderData->result->purchase_units[0]->custom_id;
        
        $producto_precio = $productos[$producto_id]['precio'];
        $producto_cantidad = $productos[$producto_id]['cantidad'];

    	// Acreditamos las gemas en la cuenta del usuario y egistro la compra en el historial.
        if (acreditarGemas($email, $producto_cantidad, $orderData) === true) {

          registrarCompra($_SESSION['id'], 'gemas', $producto_cantidad, $producto_precio, $orderData);

        }

	}

    // Output the order data.
    echo $orderResponse;

}

?>