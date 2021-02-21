
<section>
	<div class="container">
		<h1>Shopping Cart</h1>
		
		<?php if(!empty($itemsInCart)):?>
			<p>Your food will be delivered at the time you specify or you can come pick it up<br /></p>
			
			
			<div>
				<?php 
				foreach($itemsInCart as $food) : ?>
					<div>Food Name: <?php echo $food['food_name']?></div>
					<div>Image: <img src="<?php echo base_url('images/' . $food['image'])?>" width="100" /></div>
					<div>Price: <?php echo $food['price']?></div>
					
					<a class="btn btn-primary btn-lg" href="<?php echo base_url('cart/remove/' . $food['id']); ?>" role="button">Remove</a>				
					<br /><br /><hr />
				<?php endforeach; ?>
			</div>

			<a class="btn btn-primary btn-lg" href="<?php echo base_url('cart/checkout'); ?>" role="button">Checkout</a>				
		<?php else: ?>
			<p>There are no items in your Cart</p>
		<?php endif; ?>
	</div>
</section>
