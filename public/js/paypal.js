function renderPaypalContainer(container, productID) {
	// Render the PayPal button into #paypal-button-container
	paypal.Buttons({

		style: {
			color:  'blue',
			shape:  'pill',
			label:  'pay',
			height: 40,
		},

		// Call your server to set up the transaction
		createOrder: function(data, actions) {
			return fetch('/controllers/payments/paypal/createOrder.php?productID=' + productID, {
				method: 'post',
			}).then(function(res) {
				return res.json();
			}).then(function(orderData) {
				return orderData.result.id;
			});
		},

		// Call your server to finalize the transaction
		onApprove: function(data, actions) {
			return fetch('/controllers/payments/paypal/processOrder.php?orderID=' + data.orderID, {
				method: 'post'
			}).then(function(res) {
				return res.json();
			}).then(function(orderData) {
				// Three cases to handle:
				//   (1) Recoverable INSTRUMENT_DECLINED -> call actions.restart()
				//   (2) Other non-recoverable errors -> Show a failure message
				//   (3) Successful transaction -> Show a success / thank you message

				// Your server defines the structure of 'orderData', which may differ
				var errorDetail = Array.isArray(orderData.details) && orderData.details[0];

				if (errorDetail && errorDetail.issue === 'INSTRUMENT_DECLINED') {
					// Recoverable state, see: "Handle Funding Failures"
					// https://developer.paypal.com/docs/checkout/integration-features/funding-failure/
					return actions.restart();
				}

				if (errorDetail) {
					var msg = 'La transacción no se pudo procesar. \n\nContáctese con un administrador y disculpe las molestias.';
					if (errorDetail.description) msg += '\n\n' + errorDetail.description;
					if (orderData.debug_id) msg += ' (' + orderData.debug_id + ')';
					// Show a failure message
					return alert(msg);
				}

				console.debug(orderData);
				location.reload();
			});
		}

	}).render(container);
}

renderPaypalContainer("#gemas25", "gemas25");
renderPaypalContainer("#gemas50", "gemas50");
renderPaypalContainer("#gemas75", "gemas75");
renderPaypalContainer("#gemas100", "gemas100");