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
			
			<!-- Main Content -->
			<div class="page-wrapper pa-0 ma-0 auth-page">
				<div class="container-fluid">
					<!-- Row -->
					<div class="table-struct full-width full-height">
						<div class="table-cell vertical-align-middle auth-form-wrap">
							<div class="auth-form  ml-auto mr-auto no-float">
								<div class="row">
									<div class="col-sm-12 col-xs-12">
										<div class="sp-logo-wrap text-center pa-0 mb-30">
											<a href="index.html">
												<img class="brand-img mr-10" src="<?= base_url();?>dist/img/logo-admintool.mini.png" width="15%" alt="brand"/>
												<span class="brand-text">Hound</span>
											</a>
										</div>
										<div class="mb-30">
											<h3 class="text-center txt-dark mb-10">Reset Password</h3>
										</div>	
										<div class="form-wrap">
											<form action="#" id="resetpassword-form">
                        <div class="form-group" id="alert-error" style="display:none">
													<div class="alert alert-success alert-dismissable alert-style-1">
														<button type="button" class="close" aria-hidden="true">×</button>
														<i class="zmdi zmdi-check"></i>
														<span id="message"></span>
													</div>
												</div>
												<div class="form-group">
													<label class="pull-left control-label mb-10" for="oldPassword">Old Password</label>
													<input type="password" class="form-control" id="oldPassword" name="oldPassword" placeholder="Enter pwd">
												</div>
												<div class="form-group">
													<label class="pull-left control-label mb-10" for="newPassword">New Password</label>
													<input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="Enter New pwd">
												</div>
												<div class="form-group">
													<label class="pull-left control-label mb-10" for="newPasswordRepeat">Confirm Password</label>
													<input type="password" class="form-control" id="newPasswordRepeat" name="newPasswordRepeat" placeholder="Re-Enter pwd">
												</div>
												<div class="form-group text-center">
													<button type="submit" class="btn btn-info btn-rounded">Reset</button>
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
		
		<!-- Init JavaScript -->
		<script src="<?= base_url();?>dist/js/init.js"></script>
    <script src="<?= base_url();?>src/js/plugins/jquery.block.ui.js"></script>
    <script src="<?= base_url();?>src/js/Resetpassword/resetpassword_view.js"></script>

    <input type="hidden" value="<?=base_url();?>" id="base_url">
	</body>
</html>
