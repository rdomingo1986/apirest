<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<title>Hound I Fast build Admin dashboard for any platform</title>
		<meta name="description" content="Hound is a Dashboard & Admin Site Responsive Template by hencework." />
		<meta name="keywords" content="admin, admin dashboard, admin template, cms, crm, Hound Admin, Houndadmin, premium admin templates, responsive admin, sass, panel, software, ui, visualization, web app, application" />
		<meta name="author" content="hencework"/>
		
		<!-- Favicon -->
		<link rel="shortcut icon" href="<?= base_url();?>favicon.ico">
		<link rel="icon" href="<?= base_url();?>favicon.ico" type="image/x-icon">
		
		<!-- vector map CSS -->
		<link href="<?= base_url();?>vendors/bower_components/jasny-bootstrap/dist/css/jasny-bootstrap.min.css" rel="stylesheet" type="text/css"/>
		
		
		
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
						<span class="brand-text">Hound</span>
					</a>
				</div>
				<div class="form-group mb-0 pull-right">
					<span class="inline-block pr-10">Already have an account?</span>
					<a class="inline-block btn btn-info btn-rounded btn-outline" href="<?= base_url();?>">Sign In</a>
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
											<h3 class="text-center txt-dark mb-10">Sign up to Hound</h3>
											<h6 class="text-center nonecase-font txt-grey">Enter your details below</h6>
										</div>	
										<div class="form-wrap">
											<form action="#" id="signup-form">
												<div class="form-group" id="alert-error" style="display:none">
													<div class="alert alert-success alert-dismissable alert-style-1">
														<button type="button" class="close" aria-hidden="true">×</button>
														<i class="zmdi zmdi-check"></i>
														<span id="message"></span>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label mb-10" for="names">Name</label>
													<input type="text" class="form-control" id="names" name="names" placeholder="Name">
												</div>
												<div class="form-group">
													<label class="control-label mb-10" for="lastNames">Last Name</label>
													<input type="text" class="form-control" id="lastNames" name="lastNames" placeholder="Last Name">
												</div>
												<div class="form-group">
													<label class="control-label mb-10" for="gender">Genero</label>
													<select class="form-control" id="gender" name="gender">
													<option></option>
														<option value="masculino">Masculino</option>
														<option value="femenino">Femenino</option>
													</select>
												</div>
												<div class="form-group">
													<label class="pull-left control-label mb-10" for="email">Email</label>
													<input type="text" class="form-control" id="email" name="email" placeholder="Enter email">
												</div>
												<div class="form-group">
													<label class="pull-left control-label mb-10" for="password">Password</label>
													<input type="password" class="form-control" id="password" name="password" placeholder="Enter pwd">
												</div>
												<div class="form-group">
													<label class="pull-left control-label mb-10" for="passwordRepeat">Repeat Password</label>
													<input type="password" class="form-control" id="passwordRepeat" name="passwordRepeat" placeholder="Enter pwd">
												</div>
												<div class="form-group">
													<div class="checkbox checkbox-primary pr-10 pull-left">
														<input id="legalTerms" name="legalTerms" type="checkbox">
														<label for="legalTerms"> I agree to all <span class="txt-primary">Terms</span></label>
													</div>
													<div class="clearfix"></div>
												</div>
												<div class="form-group text-center">
													<button type="submit" class="btn btn-info btn-rounded">sign Up</button>
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
		<script>
			var parentAgencyCode = '<?= $parentAgencyCode;?>';
		</script>
		<!-- jQuery -->
		<script src="<?= base_url();?>vendors/bower_components/jquery/dist/jquery.min.js"></script>
		<script src="<?= base_url();?>bower_components/jquery-validation/dist/jquery.validate.min.js"></script>
		
		<!-- Bootstrap Core JavaScript -->
		<script src="<?= base_url();?>vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
		<script src="<?= base_url();?>vendors/bower_components/jasny-bootstrap/dist/js/jasny-bootstrap.min.js"></script>
		
		<!-- Slimscroll JavaScript -->
		<script src="<?= base_url();?>dist/js/jquery.slimscroll.js"></script>
		
		<!-- Init JavaScript -->
		<script src="<?= base_url();?>dist/js/init.js"></script>
		<script src="<?= base_url();?>src/js/plugins/jquery.block.ui.js"></script>
    <script src="<?= base_url();?>src/js/Signup/signup_view.js"></script>

    <input type="hidden" value="<?=base_url();?>" id="base_url">
	</body>
</html>
