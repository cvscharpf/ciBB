
<!-- view orders -->
<section>
	<div class="container">
		<h1>Your Orders</h1>
		<hr />
		
		<?php if(empty($orders)): ?>
		<div>You don't have any orders yet. Cheout out our fabulous <a href="/menu">menu</a>!</div>
		
		<?php else: ?>
		<h5>These are your orders: </h5>
			
			<?php foreach($orders as $order): ?>
			<div class="shadow p-3 mb-3 bg-white rounded">
				<div>Order #:<?php echo $order['info']['id'] ?></div>
				<div>Date: <?php echo $order['info']['created'] ?></div>
				<div><?php echo (($order['info']['deliveryType'] == 'pickup') ? ('Pickup Time: ') : ('Delivery Time: ')) . $order['info']['timePref'] ?></div>
				<div><?php echo ($order['info']['deliveryType'] == 'pickup') ? ('Car Description: ' . $order['info']['car_description']) : ('Delivery Address: ' . $order['info']['delivery_address']); ?></div>
				<div>Total Paid: $<?php echo number_format($order['info']['total'], 2); ?></div>
				<div>
					<ul class="list-inline">
					<?php foreach($order['food'] as $item): ?>
						<li class="list-inline-item">
							<div>
								<img src="../images/<?php echo $item['image']; ?>" width="60" /><br />
							</div>
							<div>
								<?php echo $item['name']; ?>
							</div>
							<div>
								$<?php echo number_format($item['price'], 2); ?> x <?php echo $item['qty']; ?>
							</div>
						</li>
					<?php endforeach; ?>
					</ul>
				</div>
			</div>
			<?php endforeach; ?>
			
		<?php endif; ?>
	</div>
</section>
