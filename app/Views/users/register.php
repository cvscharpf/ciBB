
	<div class="container">
		<div class="row">
			<div class="col-12 col-sm8- offset-sm-2 col-md-6 offset-md3 mt-5 pt-3 pb-3 bg-white from-wrapper">
				<div class="container">
					<h3>Register</h3>
					<hr />
					<form class="" action="/users/register" method="post">
						<div class="row">
							<div class="col-12 col-sm-6">
								<div class="form-group">
								<label for="firstname">First Name</label>
								<input type="text" class="form-control" name="firstname" id="firstname" value="<?php echo set_value('firstname'); ?>" />
								</div>
							</div>
							<div class="col-12 col-sm-6">
								<div class="form-group">
								<label for="lastname">Last Name</label>
								<input type="text" class="form-control" name="lastname" id="lastname" value="<?php echo set_value('lastname'); ?>" />
								</div>
							</div>
							
							<div class="col-12">
								<div class="form-group">
									<label for="email">Email</label>
									<input type="text" class="form-control" name="email" id="email" value="<?php echo set_value('email'); ?>" />
								</div>
							</div>
							
							<div class="col-12 col-sm-6">
								<div class="form-group">
									<label for="phone">Phone</label>
									<input type="text" class="form-control" name="phone" id="phone" value="<?php echo set_value('phone'); ?>" />
								</div>
							</div>
							<div class="col-12 col-sm-6">
								<div class="form-group">
									<label for="pay_method">Payment Method</label>
									<select class="form-control" name="pay_method" id="pay_method">
										<?php foreach($pay_methods as $pm): ?>
											<?php echo '<option value="' . $pm['id'] . '">' . $pm['name'] . '</option>'; ?>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
							
							<div class="col-12 col-sm-6">
								<div class="form-group">
									<label for="password">Password</label>
									<input type="password" class="form-control" name="password" id="password" value="" />
								</div>
							</div>
							<div class="col-12 col-sm-6">
								<div class="form-group">
									<label for="password_confirm">Confirm Password</label>
									<input type="password" class="form-control" name="password_confirm" id="password_confirm" value="" />
								</div>
							</div>
							
							<?php if(isset($validationResult)): ?>
							<div class="col-12">
								<div class="alert alert-danger" role="alert">
									<?php echo $validationResult->listErrors(); ?>
								</div>
							</div>
							<?php endif; ?>
						</div>
						
						
						<div class="row">
							<div class="col-12 col-sm-4">
								<button type="submit" class="btn btn-primary">Register</button>
							</div>
							<div class="col-12 col-sm-8 text-right">
								<a href="/users/login">Already have an account?</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>