<?php 
	include 'inc/header.php';
	include 'lib/user.php';
	session::checkLogin();
?>

<?php 
		$user = new user();
		if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
			$userlogin = $user->getlogin($_POST);
		}
?>

	<div style="background:#F5F4F6; color:#776E63; border: 1px; padding:10px; margin-top: 10px ">
		<div style="max-width: 600px;  margin: 0 auto ">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2 >User Login:</h2>
				<div class="panel-body">


					<?php 
						if (isset($userlogin)) {
							echo $userlogin;
						}
					?>


					<form action="" method="POST">

						<div class="form-group">
							<label for="email">Email Address</label>
							<input type="text" id="email" name="email" class="form-control" required=" " />
						</div>

						<div class="form-group">
							<label for="password">Password</label>
							<input type="password" id="password" name="password" class="form-control" />
						</div>

							<button type="submit" name="login" class="btn btn-success">Login</button>
					</form>
				</div>
			</div>
		</div>	
	</div>	

<?php include 'inc/footer.php'; ?>