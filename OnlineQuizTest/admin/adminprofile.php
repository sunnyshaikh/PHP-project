<?php 
	include '../db/db.php';
	session_start();

	$amail = $_SESSION['amail'];

	if(!isset($_SESSION['amail']))
		header("location:./adminlogin.php");

	// Getting users info
	$getadmininfo = "SELECT * FROM admin WHERE amail = '$amail';";
	$getadmininfofire = mysqli_query($con,$getadmininfo);
	$row = mysqli_fetch_array($getadmininfofire);

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>The Quiz</title>

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
                    <li class="nav-item active">
                        <a href="./adminprofile.php" class="nav-link">PROFILE</a>
                    </li>
                    <li class="nav-item mr-5">
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
			<!-- User profile -->
			<div class="profile">
				<h3 class="text-dark text-center mb-3">Your Profile</h3>
				<table class="table table-bordered table-striped table-dark table-responsive-sm">
					<thead class="bg-secondary">
						<tr>
							<th>Id</th>
							<th>Name</th>
							<th>Phone</th>
							<th>Email</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?php echo $row['aid'] ?></td>
							<td><?php echo $row['aname'] ?></td>
							<td><?php echo $row['aphone'] ?></td>
							<td><?php echo $row['amail'] ?></td>
						</tr>
					</tbody>
					
				</table>
			</div>
		</div>
	</main>
</body>
</html>













