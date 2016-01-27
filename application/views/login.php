<?php 
if ($this->session->userdata('logged_in') == TRUE) {
	redirect(base_url());
}
// Configuration for TelkomID SSO
$config = array(
		//'client_id' => 'udi_alfan',
// 		'client_id' => 'qjournal',
		//'client_secret' => 'udi_alfan',
// 		'client_secret' => 'qjournal',
		'client_id' => 'q-journal',
		'client_secret' => 'qjournal@2014',
		'redirect_uri' => base_url().'login/telkom_login',
		'scope' => 'scope_read'
);
		
// pembuatan class handler AppPrime
$telkomId = new TelkomID($config);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard  Q-Journal</title>
    <!-- Core CSS - Include with every page -->
	<link rel="icon" href="<?php echo base_url();?>assets/images/icon.png" type="image/x-icon" />
    <link href="<?=base_url()?>assets2/plugin/bootstrap-3.2.0-cust/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/admin/font-awesome-4.1.0/css/font-awesome.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="<?php echo base_url();?>bootstrap/css/bootstrap-combobox.css"> -->
    <!-- SB Admin CSS - Include with every page -->
    <link href="<?php echo base_url('assets/admin/css/sb-admin-2.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/admin/css/plugins/social-buttons.css')?>" rel="stylesheet">
	     
	<script src="<?=base_url()?>assets2/plugin/jquery/1.11.1/jquery.min.js"></script>
    <script src="<?=base_url()?>assets2/plugin/bootstrap-3.2.0-dist/js/bootstrap.min.js"></script>
    <!-- <script src="<?=base_url()?>bootstrap/js/plugins/metisMenu/jquery.metisMenu.js"></script> -->
    <!-- SB Admin Scripts - Include with every page -->
	<link href="<?php echo base_url('assets/admin/js/sb-admin-2.js')?>" rel="stylesheet">
    <!-- <script type="text/javascript" src="<?php echo base_url();?>bootstrap/js/bootstrap-combobox.js"></script> -->
	<script>
	window.fbAsyncInit = function() {
		FB.init({
		    appId      : '318069428397604',
		    cookie     : true,  // enable cookies to allow the server to access 
		                        // the session
		    xfbml      : true,  // parse social plugins on this page
		    version    : 'v2.1' // use version 2.1
		});
	};
	function fb_login(){
		FB.login(function(response) {
			statusChangeCallback(response);
		}, {
	        scope: 'public_profile,email'
	    });
	}
	function statusChangeCallback(response) {
		//console.log('statusChangeCallback');
		//console.log(response);
		if (response.status === 'connected') {
			// Logged into your app and Facebook.
			FB.api('/me', function(data) {
				console.log(data);
				console.log('Successful login for: ' + data.name + '; myID: ' + data.id);
				//document.getElementById('status').innerHTML = 'Thanks for logging in, ' + response.name + '!';
				$.post("<?php echo base_url().'login/fblogin'; ?>", data)
					.done(function(){
						window.location='<?php echo base_url()?>'; 
					});
			});
		        	      
		}
		/* else if (response.status === 'not_authorized') {
			// The person is logged into Facebook, but not your app.
			document.getElementById('status').innerHTML = 'Please log ' + 'into this app.';
		} else {
			// The person is not logged into Facebook, so we're not sure if
			// they are logged into this app or not.
			//document.getElementById('status').innerHTML = 'Please log ' + 'into Facebook.';
			//FB.login();
		}*/
	}
	
	    	  // This function is called when someone finishes with the Login
	    	  // Button.  See the onlogin handler attached to it in the sample
	    	  // code below.
	function checkLoginState() {
		FB.getLoginStatus(function(response) {
			statusChangeCallback(response);
		});
	}
	function tw_login()
	{
		window.location="<?php echo base_url().'login/twitter'?>";
	}
	</script>
</head>
<body style="background:#FFFFFF;">
    <div class="container" style="background:#FFFFFF;">
        <div class="row" style="background:#FFFFFF;">
		           <div align="center" style="margin-top:60px;margin-bottom:20px">
					     <a href="<?php echo base_url()?>"><img src="<?php echo base_url();?>assets2/images/logo.png" /></a>
					</div>
		</div>
		<div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading" style="color:#fff;background-color: #d9534f;;border-color:#d43f3a;">
                        <h3 class="panel-title">DASHBOARD</h3>
                    </div>
                    <div class="panel-body">
					       <?php
								//$message = '';
							   if($message!='' || validation_errors()){
								echo "<div class='alert alert-danger' align='center'><a class='close' data-dismiss='alert' 
								href='#' aria-hidden='true'>&times;</a>".validation_errors().$message."</div>";
							   }
						  ?>
							<?php
								 $attributes = array('role' => 'form');
								 echo form_open('',$attributes);
							?>
                            <fieldset>
                                <div class="form-group">
                                    <?php
									      $atribut = array('class'=>'form-control','placeholder'=>'Email','name'=>'email',
										  			 'value'=>set_value('email'));
										  echo form_input($atribut);
									?>
                                </div>
                                <div class="form-group">
                                    <?php
									      $atribut = array('class'=>'form-control','placeholder'=>'Password','name'=>'password',
										  			 'value'=>set_value('password'));
										  echo form_password($atribut);
									?>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <div class="form-group">
	                                <input type="submit" class="btn btn-lg btn-danger btn-block" value="Sign In">
	                            </div>
                                <div class="form-group text-right">
                                	<!-- <fb:login-button scope="public_profile,email" onlogin="checkLoginState();" data-size="large"></fb:login-button> -->
	                                
                                    <a href="<?php echo $telkomId->getLoginURL()?>" class="btn btn-default btn-icon input-block-level tip" title="Sign in with TelkomID"><img class="fa" src="<?php echo base_url().'assets2/images/telkom-icon.png';?>" height="28px"></a>
                                    <a onclick="tw_login();" class="btn btn-info btn-icon input-block-level tip" href="javascript:void(0);" title="Sign in with Twitter"><i class="fa fa-twitter fa-2x"></i></a>
                                    <!-- <a onclick="fb_login();" class="btn btn-social-icon btn-facebook"><i class="fa fa-facebook"></i></a> -->
                                    <a onclick="fb_login();" class="btn btn-primary btn-icon input-block-level tip" href="javascript:void(0);" title="Sign in with Facebook"><i class="fa fa-facebook-square fa-2x"></i></a>
                                </div><?php //print_r($telkomId->getUserProfile());?>
                            </fieldset>
                        <?=form_close()?>
                        <div id="fb-root"></div>
						<script>(function(d, s, id) {
							  var js, fjs = d.getElementsByTagName(s)[0];
							  if (d.getElementById(id)) return;
							  js = d.createElement(s); js.id = id;
							  js.src = "//connect.facebook.net/en_US/sdk.js";
							  fjs.parentNode.insertBefore(js, fjs);
							}(document, 'script', 'facebook-jssdk'));
						</script>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
	<div align="center">Copyright &copy; 2014 PT. Telekomunikasi Indonesia</div>
    <!-- Core Scripts - Include with every page -->
</body>
</html>
