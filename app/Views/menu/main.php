
<!-- main menu -->
<section>
	<div class="container">
		<h1>Menu</h1>
		<p>This is what Badger Bytes offers: <br /></p>
		
		
		<div>
			<?php foreach($menu as $food): ?>
				<div>Food Name: <?php echo $food['food_name']?></div>
				<div>Image: <img src="<?php echo base_url('images/' . $food['image'])?>" width="300" /></div>
				<div>Description: <?php echo $food['food_description']?></div>
				<div>Price: <?php echo $food['price']?></div>
				
				<a class="btn btn-primary btn-lg" href="<?php echo base_url('cart/add/' . $food['id']); ?>" role="button">Add to Cart</a>
				<br /><br /><hr />
			<?php endforeach; ?>
		</div>
				
	</div>
</section>
