<?php
require('config.php');
?>
<form action="" method="post">
	<script
		src="https://checkout.stripe.com/checkout.js" class="stripe-button"
		data-key="<?php echo $publishableKey?>"
		data-amount="50"
		data-name="khawar shahzad"
		data-description=" Desc"
		
		data-currency="usd"
		data-email="khawars282@gmail.com"
	>
	</script>

</form>