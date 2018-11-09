<?php   
		include 'lib/user.php';
		include 'inc/header.php';
		session::checkSession();
		
?>


<?php
	$loginsms = session::get("loginsms");
	if (isset($loginsms)) {
		echo $loginsms;
	}
	session::set("loginsms",NULL);
?>

		<div class="panel panel-default">
			<div class="panel-heading">
				<h2 style="margin:20px; ">User List <span style="float:right;">Welcome! <strong>
				<?php 
					$name = session::get("name");

					if (isset($name)) {
						echo $name;
					}

				?></strong>
			</span></h2>
			</div>
			<div class="panel panel-body">
				<table class="table table-striped">
					<th width="20%">Serial</th>
					<th width="20%">Name</th>
					<th width="20%">Username</th>
					<th width="20%">Email Address</th>
					<th width="20%">Action</th>
				<?php 
				
					$user = new user();
					$usrdata = $user->getuserdata();
					if ($usrdata) {
						$i = 0;
						foreach ($usrdata as $sdata) {
						$i++;
				?>

					<tr>
						<td><?php echo $i; ?></td>
						<td><?php  echo $sdata['name']; ?></td>
						<td><?php  echo $sdata['username']; ?></td>
						<td><?php  echo $sdata['email']; ?></td>
						<td>
							<a class="btn btn-primary" href="profile.php?id=<?php echo $sdata['id']; ?>">View</a>
						</td>
					</tr>
				<?php 	
						}
					}else {	
				?>
				<tr><td colspan="5"><h2>No user data found.</h2></td></tr>
				
				<?php } ?>

				</table>

			</div>
		</div>

<?php include 'inc/footer.php'; ?>