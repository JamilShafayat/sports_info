<?php 
	include 'inc/header.php'; 
	
	
?>

<?php include 'lib/user.php';
		$user = new user();

		if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
			$userregi = $user->getRegistration($_POST);
		}
?>

	<div style="background:#F5F4F6; color:#776E63; border: 1px; padding:10px; margin-top: 10px ">
		<div style="max-width: 600px;  margin: 0 auto ">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2 >User Registration</h2>
				<div class="panel-body">

					<?php 

						if (isset($userregi)) {
							echo $userregi;
						}


					?>

					<form action="" method="POST">

						<div class="form-group">
							<label for="name">Your Name</label>
							<input type="text" id="name" name="name" class="form-control" />
						</div>

						<div class="form-group">
							<label for="username">User Name</label>
							<input type="text" id="username" name="username" class="form-control" />
						</div>

						<div class="form-group">
							<label for="email">Email Address</label>
							<input type="email" id="email" name="email" class="form-control"  />
						</div>


						<div class="form-group">
							<label for="password">Password</label>
							<input type="password" id="password" name="password" class="form-control" />
						</div>

							<button type="submit" name="register" class="btn btn-success">Submit</button>
					</form>
				</div>
			</div>
		</div>	
	</div>	

<?php include 'inc/footer.php'; ?>