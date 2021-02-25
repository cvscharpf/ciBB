
<section>
	<div class="jumbotron">
		<div class="container">
			<img src="<?php echo base_url('images/bbLogo.png'); ?>" width="200" alt="BadgerBytes" /><br /><br />
			<h1 class="display-4">Thank You for your order!</h1>
			
			<p class="lead">Please check your email for extra information. </p>
			<hr class="my-4">
			<p>An email receipt, including detail of your order has been sent to the email address provided. Please keep it for your records. <br />
			You can visit the <span class="border-button">Acount / Orders</span> page at any time to check details regarding your orders, including this one.<br />
			Or, you can click <a href="/orders/createPdf/<?php echo $order['id']; ?>">here</a> to create a pdf copy of your receipt. </p><br /><br />
			
			<p class="lead">
				<a class="btn btn-primary btn-lg" href="<?php echo base_url('menu'); ?>" role="button">Order again!</a>
			</p>
		</div>
	</div>
</section>
