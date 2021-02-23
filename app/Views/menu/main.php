
<!-- main menu -->
<section>
	<div class="container">
		<h1>The Good Stuff</h1>
		<p>Badger Bytes offers cakes<br /></p>
	
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

	
	
	
<!--
	<div class="container">
		<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
			<ol class="carousel-indicators">
				<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
				<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
			</ol>
			<div class="carousel-inner">
				<div class="carousel-item active">
					<img class="d-block w-100" src="<?php echo base_url('images/foods/tiramisu.PNG'); ?>" alt="First slide">
				</div>
				<div class="carousel-item">
					<img class="d-block w-100" src="<?php echo base_url('images/foods/strbCake.PNG'); ?>" alt="Second slide">
				</div>
			</div>
			<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
		</div>
	</div>
-->
