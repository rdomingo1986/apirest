<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en" ng-app="admintool">
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

	<!-- select2 CSS -->
	<link href="<?= base_url();?>vendors/bower_components/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css"/>

	<!-- vector map CSS -->
	<link href="<?= base_url();?>vendors/bower_components/jquery-wizard.js/css/wizard.css" rel="stylesheet" type="text/css"/>
		
	<!-- jquery-steps css -->
	<link rel="stylesheet" href="<?= base_url();?>vendors/bower_components/jquery.steps/demo/css/jquery.steps.css">

	<!-- Data table CSS -->
	<link href="<?= base_url();?>vendors/bower_components/datatables/media/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
	
	<!--alerts CSS -->
	<link href="<?= base_url();?>vendors/bower_components/sweetalert/dist/sweetalert.css" rel="stylesheet" type="text/css">

	<link href="<?= base_url();?>vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.css" rel="stylesheet" type="text/css">

	<!-- Bootstrap Switches CSS -->
	<link href="vendors/bower_components/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>

	<!-- Custom CSS -->
	<link href="<?= base_url();?>dist/css/style.css" rel="stylesheet" type="text/css">
	<link href="<?= base_url();?>src/css/custom.css" rel="stylesheet" type="text/css">
</head>

<body>
	<!--Preloader-->
	<div class="preloader-it">
		<div class="la-anim-1"></div>
	</div>
	<!--/Preloader-->
    <div class="wrapper theme-1-active pimary-color-red">

		<!-- Top Menu Items -->
			<?php $this->load->view('Dashboard/top_menu_view'); ?>
		<!-- /Top Menu Items -->
		
		<!-- Left Sidebar Menu -->
			<?php $this->load->view('Dashboard/left_sidebar_view'); ?>
		<!-- /Left Sidebar Menu -->
		
		<!-- Right Sidebar Menu -->
			<?php $this->load->view('Dashboard/right_sidebar_view'); ?>
		<!-- /Right Sidebar Menu -->
		
		
       
		<!-- Main Content -->
		<div class="page-wrapper">
			<div class="container-fluid">
				
				<!-- Title -->
				<div class="row heading-bg">
					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
						<h5 class="txt-dark no-capitalize" id="title-module"></h5>
					</div>
					<!-- Breadcrumb -->
					<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12" id="breadcrumb">
						<!-- <ol class="breadcrumb">
							<li><a href="index.html">Dashboard</a></li>
							<li><a href="#"><span>speciality pages</span></a></li>
							<li class="active"><span>blank page</span></li>
						</ol> -->
					</div>
					<!-- /Breadcrumb -->
				</div>
				<!-- /Title -->


        <div id="main-content-div" ng-view></div>


				<!-- Footer -->
				<footer class="footer container-fluid pl-30 pr-30">
					<div class="row">
						<div class="col-sm-12">
							<p>2017 &copy; Hound. Pampered by Hencework</p>
						</div>
					</div>
				</footer>
				<!-- /Footer -->
			</div>
		</div>
        <!-- /Main Content -->

    </div>
    <!-- /#wrapper -->
	
	<!-- JavaScript -->
	<script src="<?= base_url();?>src/js/plugins/angularjs/angularjs.min.js"></script>
	<script src="<?= base_url();?>src/js/plugins/angularjs/angularjs-route.min.js"></script>
	
	<!-- jQuery -->
	<script src="<?= base_url();?>vendors/bower_components/jquery/dist/jquery.min.js"></script>
	<script src="<?= base_url();?>bower_components/jquery-validation/dist/jquery.validate.min.js"></script>

	<!-- Momentjs -->
	<script src="<?= base_url();?>vendors/bower_components/moment/min/moment.min.js"></script>
	
	<!-- md5js -->
	<script src="<?= base_url();?>src/js/plugins/md5.min.js"></script>

	<!-- Bootstrap Core JavaScript -->
	<script src="<?= base_url();?>vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<!-- <script src="<?= base_url();?>vendors/bower_components/jasny-bootstrap/dist/js/jasny-bootstrap.min.js"></script>		 -->
	<script src="<?= base_url();?>vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.js"></script>

	<!-- Bootstrap Switch JavaScript -->
	<script src="vendors/bower_components/bootstrap-switch/dist/js/bootstrap-switch.min.js"></script>

	<!-- Form Wizard JavaScript -->
	<script src="vendors/bower_components/jquery.steps/build/jquery.steps.min.js"></script>
    
	<!-- Data table JavaScript -->
	<script src="<?= base_url();?>vendors/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
	<script src="<?= base_url();?>dist/js/dataTables-data.js"></script>
	
	<!-- Slimscroll JavaScript -->
	<script src="<?= base_url();?>dist/js/jquery.slimscroll.js"></script>
	
	<!-- Owl JavaScript -->
	<script src="<?= base_url();?>vendors/bower_components/owl.carousel/dist/owl.carousel.min.js"></script>
	
	<!-- Switchery JavaScript -->
	<script src="<?= base_url();?>vendors/bower_components/switchery/dist/switchery.min.js"></script>

	<!-- Select2 JavaScript -->
	<script src="vendors/bower_components/select2/dist/js/select2.full.min.js"></script>
	
	<!-- Sweet-Alert  -->
	<script src="<?= base_url();?>vendors/bower_components/sweetalert/dist/sweetalert.min.js"></script>
	
	<!-- Fancy Dropdown JS -->
	<script src="<?= base_url();?>dist/js/dropdown-bootstrap-extended.js"></script>
	
	<!-- Init JavaScript -->
	<script src="<?= base_url();?>src/js/globals.js"></script>
	<script type="text/javascript">
		$(document).ready(function () {
			siteUrl = $('#base_url').val();
			$(window).off('scroll');
		});
	</script>
	<script src="<?= base_url();?>dist/js/init.js"></script>

  <script src="<?= base_url();?>src/js/plugins/jquery.block.ui.js"></script>
  <script src="<?= base_url();?>src/js/custom_functions.js"></script>
	<script src="<?= base_url();?>src/js/controllers/Agencies.js"></script>
	<script src="<?= base_url();?>src/js/controllers/Entities.js"></script>
	<script src="<?= base_url();?>src/js/controllers/Invoices.js"></script>
	<script src="<?= base_url();?>src/js/controllers/Clients.js"></script>
  <script src="<?= base_url();?>src/js/controllers/Categories.js"></script>
	<script src="<?= base_url();?>src/js/controllers/Items.js"></script>

	<script src="<?= base_url();?>src/js/controllers/ClientsProfile.js"></script>
	
	<input type="hidden" value="<?=base_url();?>" id="base_url">
</body>

</html>
