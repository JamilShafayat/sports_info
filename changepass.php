<?php   
		include 'lib/user.php';
		include 'inc/header.php';
		session::checkSession();
?>

<?php
	if (isset($_GET['id'])) {
		$userid = (int)$_GET['id'];
		$setid = session::get("id");
		if ($userid !== $setid) {
			header("location: index.php");
		}
	}
		$user = new user();
		if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['updatepass'])) {
			$updatepass = $user->updateUserPassword($id,$_POST);
		}
  ?> 

	<div style="background:#F5F4F6; color:#776E63; border: 1px; padding:10px; margin-top: 10px ">
		<div style="max-width: 600px;  margin: 0 auto ">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2>Change Password <span style="float:right;"><a class="btn btn-primary" href="profile.php?id=<?php echo $id;?>">Back</a></span></h2>
				<div class="panel-body">

<?php if (isset($updatepass)) {
	echo $updatepass;
	} 
?>
					<form action="" method="POST">

						<div class="form-group">
							<label for="old_pass">Old Password</label>
							<input type="password" id="old_pass" name="old_pass" class="form-control" />
						</div>


						<div class="form-group">
							<label for="password">New Password</label>
							<input type="password" id="password" name="password" class="form-control" />
						</div>

							<button type="submit" name="updatepass" class="btn btn-success">Update</button>
					</form>
				</div>
			</div>
		</div>	
	</div>	

<?php include 'inc/footer.php'; ?>