<?php include('includes/header.php'); ?>

<form role="form" enctype="multipart/form-data" method="post" action="register.php">
							<div class="form-group">
								<label>Name*</label>
								<input name="name" type="text" class="form-control" placeholder="Enter Your Name">
							</div>
							<div class="form-group">
								<label>Email address</label>
								<input type="email" class="form-control" placeholder="Enter Email" name="email">
							</div>
							<div class="form-group">
								<label>Choose UserName*</label>
								<input type="text" class="form-control" placeholder="Enter Your Username" name="username">
							</div>
							<div class="form-group">
								<label>Password*</label>
								<input type="password" class="form-control" name="password" placeholder="Enter Password">
							</div>
							<div class="form-group">
								<label>Confirm Password*</label>
								<input type="password" class="form-control" name="cnf_password" placeholder="Enter Password Again">
							</div>
							<div class="form-group">
								<label>Upload Avatar</label>
								<input type="file" name="avatar">
								<p class="help-block"></p>
							</div>	
							<div class="form-group">
								<label>About Me</label>
								<textarea id="about" rows="6" cols="10" class="form-control" name="about" placeholder="Tell us about yourself(Optional)"></textarea>
							</div>
							
							<input name="reg" type="submit" class="btn btn-default" value="Register"/>
						</form>
<?php include('includes/footer.php'); ?>	