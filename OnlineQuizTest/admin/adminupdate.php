<?php 
	include '../db/db.php';
	session_start();

	$amail = $_SESSION['amail'];
	
	if(!isset($_SESSION['amail']))
		header("location:./adminlogin.php");

	if(isset($_POST['submit']))
	{
		$aname = $_POST['aname'];
		$apass = $_POST['apass'];

		$update = "UPDATE admin SET aname = '$aname',apass = '$apass' WHERE amail = '$amail';";
		$updatefire = mysqli_query($con,$update);

		if($updatefire)
		{
			$msg = '<div class="text-center alert alert-success mt-3">Successfully Updated :)</div>';	
		}
		else
			$msg = '<div class="text-center alert alert-danger mt-3">Something went wrong :(</div>';
	}
 ?>

 <!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Online Quiz</title>

	<!-- Bootstrap css link -->
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">

	<!-- Custom css link -->
	<link rel="stylesheet" type="text/css" href="../css/style.css">

	<!-- Jquery link -->
	<script src="../js/jQuery.min.js"></script>

	<!-- Bootstrap js link -->
	<script src="../js/bootstrap.min.js"></script>

</head>
<body>
	<!-- navbar -->
    <nav class="navbar bg-light navbar-expand-md shadow navbar-light">
        <div class="container">
            <h5 class="text-primary logo">THE QUIZ</h5>

            <button class="navbar-toggler" data-toggle="collapse" data-target="#navbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="menu collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a href="./adminhome.php" class="nav-link">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a href="./adminprofile.php" class="nav-link">PROFILE</a>
                    </li>
                    <li class="nav-item active mr-5">
                        <a href="./adminupdate.php" class="nav-link">UPDATE</a>
                    </li>
                    <li class="nav-item">
						<a class="nav-link btn btn-secondary text-light" href="../logout.php">Logout</a>
					</li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- navbar end -->

	<!-- main -->
	<main>
		<div class="container py-5">
			<!-- Title -->
			<div class="title">
				<h2 class="text-dark text-center main-heading">Online Quiz Website.</h2>
				<h6 class="text-secondary text-center slogan">ADMIN UPDATE FORM</h6>
			</div>

			<!-- update form -->
			<div class="form center col-lg-6 shadow p-4 mt-5 bg-white">
				<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
					<div class="form-group">
						<label>E-mail id:</label>
						<input type="text" name="amail" value="<?php echo $amail ?>" readonly class="form-control">
					</div>

					<div class="form-group">
						<label>Change Username:</label>
						<input type="text" name="aname" value="<?php if(isset($_POST['aname'])) echo $aname; ?>" required class="form-control">
					</div>

					<div class="form-group">
						<label>Change Password:</label>
						<input type="password" name="apass" required class="form-control">
					</div>

					<input type="submit" name="submit" value="Update" class="btn btn-primary">
					<?php 
						if(isset($msg))
							echo "$msg";
					 ?>
				</form>
			</div>
		</div>
	</main>
</body>
</html>








