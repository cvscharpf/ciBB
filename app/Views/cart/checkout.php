
	<div class="container">
		<h3>CheckOut</h3>
		<hr />
		
		<div class="table-responsive-sm">
			<table class="table table-hover">
				<thead>
					<tr>
						<th scope="col">Code</th>
						<th scope="col">Item</th>
						<th scope="col">Price</th>
						<th scope="col">Qty.</th>
						<th scope="col">Total</th>
					</tr>
				</thead>
				<tbody>
				
				<?php
				foreach($itemsInCart as $food) : ?>
					<tr>
						<th scope="row"><?php echo $food['id'] ?></th>
						<td>
							<div><?php echo $food['food_name']?></div>
						</td>
						<td>
							<div><?php echo $food['price']?></div>
						</td>
						<td>
							<div><?php echo $_SESSION[CART][$food['id']]; ?></div>
						</td>
						<td>
							<div>$<?php echo $food['price'] * $_SESSION[CART][$food['id']]; ?></div>
						</td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
