<?php $filepath = realpath(dirname(__FILE__));
	include_once  $filepath.'/../lib/session.php';
	session::init();
?>


<!DOCTYPE html>
<html>
<head>
	<title>Login Registration Page</title>
	<script src="inc/jquery.min.js"></script>
	<link rel="stylesheet" href="inc/bootstrap.min.css" />
	<script src="inc/bootstrap.min.js"></script>
</head>

<?php  
	if (isset($_GET['action']) && $_GET['action'] == "logout") {
		session::destroy();
	}
?>



<body>
	<div class="container">
		<nav class="navbar navbar-expand-sm bg-secondary text-muted navbar-dark">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="index.php">Login Register Page by PHP & PDO</a>
				</div>
				<ul class="navbar-nav  pull-right">

					<?php 

						$id = session::get("id");
						$userlogin = session::get("login");
						if ($userlogin == true) { ?>

						<li class="nav-item active">
							<a  class="nav-link" href="index.php">Home</a>
						</li>

						<li class="nav-item active">
							<a  class="nav-link" href="profile.php?id=<?php echo $id; ?>">Profile</a>
						</li>

						<li class="nav-item active">
							<a class="nav-link" href="?action=logout">Log Out</a>
						</li>

					<?php  }else{
					?>

						<li class="nav-item active">
							<a class="nav-link" href="login.php">Log In</a>
						</li>

						<li class="nav-item active">
							<a class="nav-link" href="register.php">Register</a>
						</li>

					<?php } 
					?>

				</ul>
			</div>
		</nav>	
