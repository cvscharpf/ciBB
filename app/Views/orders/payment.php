

<div class="container">
    <div class="row">
		<div class="col-12 col-sm8- offset-sm-2 col-md-6 offset-md3 mt-5 pt-3 pb-3 bg-white from-wrapper">
			<form class="" action="/orders/confirmation" method="post">
			
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Payment Details</h3>
						<hr />
						<br /><br />
					</div>
					<div class="panel-body">
							
							
							
							<div class="form-group">
								<label for="cardNumber">Card Number</label>
								<div class="input-group">
									<input type="text" class="form-control" id="cardNumber" placeholder="Valid Card Number" required autofocus />
								</div>
							</div>
							<div class="row">
								<div class="col-xs-8 col-md-8">
									<div class="form-group">
										<label for="expityMonth">Expiration Date</label>
										<div class="col-xs-6 col-lg-6">
											<input type="text" class="form-control" id="expityMonth" placeholder="MM" required />
										</div>
										<div class="col-xs-6 col-lg-6">
											<input type="text" class="form-control" id="expityYear" placeholder="YY" required />
										</div>
									</div>
								</div>
								<div class="col-xs-4 col-md-4 pull-right">
									<div class="form-group">
										<label for="cvCode">CV CODE</label>
										<input type="password" class="form-control" id="cvCode" placeholder="CV" required />
									</div>
								</div>
							</div>
							
							<input type="hidden" name="orderId" value="<?php echo $orderId; ?>" />
					
					
					</div>
				</div>
				
				<div class="form-row">
					<div class="col-md-12 total btn btn-info">
						Total: <span class="amount">$<?php echo number_format($orderTotal, 2); ?></span>
					</div>
				</div>
				<div class="form-row">
					<div class="col-md-12 form-group">
						<input type="submit" class="form-control btn btn-primary submit-button" type="submit" value="Make the Payment "/>
					</div>
				</div>			
				<br/>
			</form>
		</div>
	</div>
</div>
