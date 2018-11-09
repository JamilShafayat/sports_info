<?php   
		include 'lib/user.php';
		include 'inc/header.php';
		session::checkSession();
?>

<?php
	if (isset($_GET['id'])) {
		$userid = (int)$_GET['id'];
	}
		$user = new user();
		if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Update'])) {
			$userupdate = $user->updateUserData($userid,$_POST);
		}
  ?>

	<div style="background:#F5F4F6; color:#776E63; border: 1px; padding:10px; margin-top: 10px ">
		<div style="max-width: 600px;  margin: 0 auto ">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2>User Profile <span style="float:right;"><a class="btn btn-primary" href="index.php">Back</a></span></h2>
				<div class="panel-body">

<?php if (isset($userupdate)) {
	echo $userupdate;
	} 
?>


<?php 
		$userdata = $user->getuserbyid($userid); 
		if ($userdata) {
?>

					<form action="" method="POST">

						<div class="form-group">
							<label for="name">Your Name</label>
							<input type="text" id="name" name="name" class="form-control" value="<?php echo $userdata->name; ?> "  />
						</div>


						<div class="form-group">
							<label for="username">User Name</label>
							<input type="text" id="username" name="username" class="form-control" value="<?php echo $userdata->username; ?>" />
						</div>

						<div class="form-group">
							<label for="email">Email Address</label>
							<input type="email" id="email" name="email" class="form-control" value="<?php echo $userdata->email; ?>" />
						</div>



						<?php  
							$setid = Session::get("id");
							if ($userid == $setid) {
						?>

							<button type="submit" name="Update" class="btn btn-success">Update</button>
							<a class="btn btn-info" href="changepass.php?id = <?php echo $userid; ?>">Change Password</a>

						<?php } ?>	

					</form>

					<?php } 
					?>
				</div>
			</div>
		</div>	
	</div>	

<?php include 'inc/footer.php'; ?>