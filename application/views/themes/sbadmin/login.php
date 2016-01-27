
<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Please Sign In</h3>
				</div>
				<div class="panel-body">
                    <?php
						//$message = '';
						if($message!='' || validation_errors()){
							echo "<div class='alert alert-danger' align='center'><a class='close' data-dismiss='alert' 
							href='#' aria-hidden='true'>&times;</a>".validation_errors().$message."</div>";
						}
					?>
					<form action="<?php echo base_url('login')?>" role="form" method="post">
						<fieldset>
							<div class="input-group">
								<span class="input-group-addon" id="basic-addon1"><i class="fa fa-user"></i></span> 
								<input class="form-control" placeholder="Username" name="username" autofocus>
							</div>
							<div class="input-group">
								<span class="input-group-addon" id="basic-addon2"><i class="fa fa-lock"></i></span> 
								<input class="form-control" placeholder="Password" name="password" type="password" value="">
							</div>
							<div class="checkbox">
								<label> <input name="remember" type="checkbox" value="Remember Me">Remember Me
								</label>
							</div>
							<!-- Change this to a button or input when using this as a form -->
							<button type="submit" class="btn btn-primary btn-block">Login</button>
							<a href="<?php echo base_url('login/google');?>" class="btn btn-block btn-social btn-google-plus">
                                <i class="fa fa-google-plus"></i> Sign in with Google
                            </a>
						</fieldset>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>