<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<title>Admintool PRO</title>
		<meta name="description" content="Hound is a Dashboard & Admin Site Responsive Template by hencework." />
		<meta name="keywords" content="admin, admin dashboard, admin template, cms, crm, Hound Admin, Houndadmin, premium admin templates, responsive admin, sass, panel, software, ui, visualization, web app, application" />
		<meta name="author" content="hencework"/>
		
		<!-- Favicon -->
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
		<link rel="icon" href="favicon.ico" type="image/x-icon">
		
		<!-- vector map CSS -->
		<link href="<?= base_url();?>vendors/bower_components/jasny-bootstrap/dist/css/jasny-bootstrap.min.css" rel="stylesheet" type="text/css"/>
		
		<!--alerts CSS -->
		<link href="<?= base_url();?>vendors/bower_components/sweetalert/dist/sweetalert.css" rel="stylesheet" type="text/css">
		
		<!-- Custom CSS -->
		<link href="<?= base_url();?>dist/css/style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<!--Preloader-->
		<div class="preloader-it">
			<div class="la-anim-1"></div>
		</div>
		<!--/Preloader-->
		
		<div class="wrapper pa-0">
			<header class="sp-header">
				<div class="sp-logo-wrap pull-left">
					<a href="index.html">
						<img class="brand-img mr-10" src="<?= base_url();?>dist/img/logo-admintool.mini.png" width="15%" alt="brand"/>
						<span class="brand-text">Admintool</span>
					</a>
				</div>
				<div class="form-group mb-0 pull-right">
					<span class="inline-block pr-10">¿No tienes una cuenta?</span>
					<a class="inline-block btn btn-primary btn-rounded btn-outline" href="<?= base_url();?>Signup/4d3371e938217822eeb0273deda368c4">Registrate</a>
				</div>
				<div class="clearfix"></div>
			</header>
			
			<!-- Main Content -->
			<div class="page-wrapper pa-0 ma-0 auth-page">
				<div class="container-fluid">
					<!-- Row -->
					<div class="table-struct full-width full-height">
						<div class="table-cell vertical-align-middle auth-form-wrap">
							<div class="auth-form  ml-auto mr-auto no-float">
								<div class="row">
									<div class="col-sm-12 col-xs-12">
										<div class="mb-30">
											<h3 class="text-center txt-dark mb-10">Iniciar Sesión</h3>
											<h6 class="text-center nonecase-font txt-grey">Ingreses sus datos</h6>
										</div>	
										<div class="form-wrap">
											<form action="#" id="login-form">
												<div class="form-group" id="alert-error" style="display:none">
													<div class="alert alert-info alert-dismissable alert-style-1">
														<button type="button" class="close" aria-hidden="true">×</button>
														<i class="zmdi zmdi-info-outline"></i>
														<span id="message"></span>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label mb-10" for="email">Correo Electrónico</label>
													<input type="text" class="form-control" id="email" name="email" placeholder="">
												</div>
												<div class="form-group">
													<label class="pull-left control-label mb-10" for="password">Contraseña</label>
													<a class="txt-primary block mb-10 pull-right font-12" href="<?= base_url();?>Forgotpassword">Olvidó su Contraseña ?</a>
													<div class="clearfix"></div>
													<input type="password" class="form-control" id="password" name="password" placeholder="">
												</div>
												
												
												<div class="form-group text-center">
													<button type="submit" class="btn btn-primary btn-rounded">Iniciar Sesión</button>
												</div>
											</form>
										</div>
									</div>	
								</div>
							</div>
						</div>
					</div>
					<!-- /Row -->	
				</div>
				
			</div>
			<!-- /Main Content -->
		
		</div>
		<!-- /#wrapper -->
		
		<!-- JavaScript -->
		
		<!-- jQuery -->
		<script src="<?= base_url();?>vendors/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?= base_url();?>bower_components/jquery-validation/dist/jquery.validate.min.js"></script>
		
		<!-- Bootstrap Core JavaScript -->
		<script src="<?= base_url();?>vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
		<script src="<?= base_url();?>vendors/bower_components/jasny-bootstrap/dist/js/jasny-bootstrap.min.js"></script>
		
		<!-- Slimscroll JavaScript -->
		<script src="<?= base_url();?>dist/js/jquery.slimscroll.js"></script>

		<!-- Sweet-Alert  -->
		<script src="<?= base_url();?>vendors/bower_components/sweetalert/dist/sweetalert.min.js"></script>
		
		<!-- Init JavaScript -->
		<script src="<?= base_url();?>dist/js/init.js"></script>
		<script src="<?= base_url();?>src/js/plugins/jquery.block.ui.js"></script>
    <script src="<?= base_url();?>src/js/Login/login_view.js"></script>

		<input type="hidden" value="<?=base_url();?>" id="base_url">
	</body>
</html>
