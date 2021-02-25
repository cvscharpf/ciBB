
<section>
	<div class="container">
		<h1>Your Bag</h1>
		<hr />
		<?php if(!empty($itemsInCart)):?>
			<p>Your food will be delivered at the time you specify or you can come pick it up<br /><br /></p>
			
			
			<div class="table-responsive-sm">
				<table class="table table-hover">
					<thead>
						<tr>
							<th scope="col">Code</th>
							<th scope="col">Item</th>
							<th scope="col">Price</th>
							<th scope="col">Qty.</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($itemsInCart as $food) : ?>
							<tr>
								<th scope="row"><?php echo $food['id'] ?></th>
								<td>
									<div><img src="<?php echo base_url('images/' . $food['image'])?>" width="70" /></div>
									<div><?php echo $food['food_name']?></div>
								</td>
								<td>
									<div><?php echo $food['price']?></div>
								</td>
								<td>
									<div class="form-group form-inline mx-sm-3 mb-2">
										<label class="mr-2" for="qty">Qty. </label>
										<select class="form-control form-control-sm form-inline mr-5 selectQty" fid="<?= $food['id'] ?>">
											<?php for($i=1; $i<6; $i++){
													echo '<option ' . (($_SESSION[CART][$food['id']] == $i) ? 'selected' : '') . '>' . $i . '</option>';
												}
											?>
										</select>
										<a class="btn btn-primary btn-sm" href="<?php echo base_url('cart/remove/' . $food['id']); ?>" role="button">Remove</a>	
									</div>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
			
			<div class="d-flex">
				<a class="btn btn-primary btn-lg p-2" href="<?php echo base_url('orders/checkout'); ?>" role="button">Checkout</a>
				<a class="btn btn-primary btn-lg ml-auto p-2" id="emptyCart" href="<?php echo base_url('cart/empty'); ?>" role="button">Empty Cart</a>
			</div>
		<?php else: ?>
			<p>There are no items in your Cart</p>
		<?php endif; ?>
	</div>
</section>


