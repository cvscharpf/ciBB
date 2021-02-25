	<div class="container">
		<h3>CheckOut</h3>
		<hr />
		
		<div class="row p-2">
			<div class="col-12 col-lg-6">
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
						
							<?php $sum = 0; 
							foreach($itemsInCart as $food) : ?>
							<tr>
								<th scope="row"><?php echo $food['id']; ?></th>
								<td>
									<div><?php echo $food['food_name']; ?></div>
								</td>
								<td>
									<div>$<?php echo number_format($food['price'], 2); ?></div>
								</td>
								<td>
									<div><?php echo $_SESSION[CART][$food['id']]; ?></div>
								</td>
								<td>
									<div>$<?php 
										$totItem = $food['price'] * $_SESSION[CART][$food['id']]; 
										$sum += $totItem; 
										echo number_format($totItem, 2); ?>
									</div>
								</td>
							</tr>
							<?php endforeach; ?>
							
							<tr class="table-danger">
								<th>
									<div>Total:</div>
								</th>
								<td colspan="3">
									&nbsp;
								</td>
								<th>
									<div>$<?php echo number_format($sum, 2); ?></div>
								</th>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			
			<div class="col-12 col-lg-6 pickup_time">
				<form class="container" action="/orders/checkout" method="post">
					<h5>How would you like to receive your order?</h5>
					<div class="row" id="deliveryType">
						<div class="col-6 border-right" id="orderPickup">
							<div class="form-check">
								<input class="form-check-input" type="radio" name="deliveryType" id="check_orderPickup" value="pickup" <?php echo ((isset($_POST['deliveryType']) && $_POST['deliveryType'] == 'pickup') ? 'checked' : '') ?> checked>
								<label class="form-check-label" for="check_orderPickup">I will pick it up</label>
							</div>
							<br /><br />
							
							<div class="col-12">
								<div class="form-group">
									<label for="carDescription">Car Description</label>
									<textarea class="form-control" name="carDescription" id="carDescription" rows="3"><?php echo set_value('carDescription'); ?></textarea>
								</div>
							</div>
						</div>
						<div class="col-6">
							<div class="form-check" id="orderDeliver">
								<input class="form-check-input" type="radio" name="deliveryType" id="check_orderDeliver" value="deliver" <?php echo ((isset($_POST['deliveryType']) && $_POST['deliveryType'] == 'deliver') ? 'checked' : '') ?> >
								<label class="form-check-label" for="check_orderDeliver">I want it delivered</label>
							</div>
							<br /><br />
							<div class="col-12">
								<div class="form-group">
									<label for="deliveryAddress">My Address</label>
									<textarea class="form-control" name="deliveryAddress" id="deliveryAddress" rows="3"><?php echo (isset($_POST['deliveryAddress']) ? set_value('deliveryAddress'): $userAddress); ?></textarea>
								</div>
							</div>
						</div>
						
					</div>
					
					<div class="form-group" id="deliveryType_time">
						<label for="time">Prefered Time</label>
						<input type="time" class="form-control" name="time" id="time" value="<?php echo set_value('time'); ?>" />
					</div>
					
					<?php if(isset($validationResult)): ?>
					<div class="col-12">
						<div class="alert alert-danger" role="alert">
							<?php echo $validationResult->listErrors(); ?>
						</div>
					</div>
					<?php endif; ?>
					
					
					
					<div class="row">
						<button type="submit" class="btn btn-primary ml-auto m-5 float-right">Place Order</button>
					</div>
					<input type="hidden" name="orderTotal" id="orderTotal" value="<?php echo $sum; ?>" />
				</form>
			</div>
		</div>
		
	</div>

<!--  var_dump( session()->get('validationResult')['validationResult']->listErrors());  -->