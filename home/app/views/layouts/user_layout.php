<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title><?=$title?></title>
		<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootswatch/4.1.3/flatly/bootstrap.min.css">
		<style type="text/css">
			.footer{
			  position: absolute;
			  bottom: 0;
			  width: 100%;
			  height: 60px;
			  line-height: 60px;
			}
		</style>
	</head>
	<body>
		<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
			<a class="navbar-brand" href="/"><i class="fa fa-home fa-2x"></i></a>
			<ul class="nav navbar-nav ml-auto">
			<?php if($this->session->userdata('is_logged_in')) : ?>				
				<li class="nav-item">
				<a class="nav-link" href="<?php echo base_url(); ?>user/logout"><i class="fa fa-sign-out fa-2x"></i></a>
				</li>
			<?php endif; ?>
			<?php if(!$this->session->userdata('is_logged_in')) : ?>
				<li class="nav-item">
				<a class="nav-link" href="<?php echo base_url(); ?>user/login">Log in</a>
				</li>
				<li class="nav-item">
				<a class="nav-link" href="<?php echo base_url(); ?>user/register">Register</a>
				</li>
			<?php endif; ?>
			</ul>
			</div>
		</nav>
		<div class="container">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="/">Home</a></li>
				<li class="breadcrumb-item"><a href="/<?=$this->router->fetch_class()?>"><?=ucwords($this->router->fetch_class())?></a></li>
				<li class="breadcrumb-item active"><?=ucwords($this->router->fetch_method())?></li>
			</ol>
			<?php if($this->session->flashdata('message')) : ?>
				<div class="alert alert-<?=$this->session->flashdata('class')?> alert-dismissible fade show" role="alert">
					<?=$this->session->flashdata('message')?>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			<?php endif ?>

			<?php	
				if(isset($public_view) && $public_view){
					$this->load->view($public_view);
				}			
			?>
		</div>
		<footer class="footer bg-primary">
			<div class="container text-center">
				<span class="text-muted">&copy; <?=date('Y')?> Copyright - Youness Bougteb</span>
			</div>
		</footer>

		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" charset="utf-8"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.min.js" charset="utf-8"></script>
		<script>$('.alert').alert();</script>
	</body>
</html>