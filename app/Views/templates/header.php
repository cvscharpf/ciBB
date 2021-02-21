<!DOCTYPE html>
<html lang="en">
	<head>
		<title>BadgerBytes Restaurant</title>
		<meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		
		<link rel="icon" href="<?php echo base_url('favicon.ico'); ?>" type="image/x-icon" sizes="24x24" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('style/bootstrap.min.css'); ?>" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('style/general.css'); ?>" media="screen" />
		
		<script type="text/javascript" src="<?php echo base_url('scripts/js/jquery.min.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url('scripts/js/general.js'); ?>"></script>
	</head>
	
	<body>
		<?php $uri = service('uri'); $uri->setSilent(); ?>
		
		<div class="bs-component">
			<nav class="navbar navbar-expand-lg navbar-light" id="navHeader">
				<div class="container">
					<a class="navbar-brand" href="/">
						<img src="<?php echo base_url('images/bbLogoTrans.png'); ?>" width="60" alt="BadgerBytes" />
					</a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleMenu" aria-controls="collapsibleMenu" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="collapsibleMenu">
						<ul class="navbar-nav mr-auto">
							<li class="nav-item <?php echo ($uri->getSegment(1) == 'menu' ? 'active' : null); ?>">
								<a class="nav-link" href="<?php echo base_url('menu/'); ?>">What's Cooking? </a>
							</li>
						</ul>
						<ul class="navbar-nav mx-auto">
							<li class="nav-item"><!-- this will use menu controller -->
								<input type="text" value="search menu..." />
							</li>
						</ul>
						<ul class="navbar-nav ml-auto">
							<li class="nav-item <?php echo ($uri->getSegment(1) == 'cart' ? 'active' : ''); ?>">
								<a class="nav-link" href="<?php echo base_url('cart'); ?>">Cart</a>
							</li>
							
							<?php if(session()->get('user') && session()->get('user')['isLoggedIn']): ?>
								<li class="nav-item <?php echo ($uri->getSegment(2) == 'account' ? 'active' : ''); ?>">
									<a class="nav-link" href="<?php echo base_url('users/account'); ?>">Account</a>
								</li>
								<li class="nav-item <?php echo ($uri->getSegment(2) == 'orders' ? 'active' : ''); ?>">
									<a class="nav-link" href="<?php echo base_url('users/orders'); ?>">Orders</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="<?php echo base_url('users/logout'); ?>">Logout</a>
								</li>
							<?php else: ?>
								<li class="nav-item <?php echo ($uri->getSegment(2) == 'login' ? 'active' : ''); ?>">
									<a class="nav-link" href="<?php echo base_url('users/login'); ?>">Login</a>
								</li>
								<li class="nav-item <?php echo ($uri->getSegment(2) == 'register' ? 'active' : ''); ?>">
									<a class="nav-link" href="<?php echo base_url('users/register'); ?>">Register</a>
								</li>
							<?php endif; ?>
						</ul>
					</div>
				</div>
			</nav>
		</div>
		
		<div>
		
			<div>
				<?php if(session()->get('flash')): ?>
					<div class="alert alert-success" role="alert">
						<?php echo session()->get('flash'); ?>
					</div>
				<?php endif; ?>
			</div>

