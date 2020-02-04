<?php 
	include '../db/db.php';
	session_start();

	$umail = $_SESSION['umail'];
	
	if(!isset($_SESSION['umail']))
		header("location:../index.php");

	// Getting users info
	$getuserinfo = "SELECT * FROM user WHERE umail = '$umail';";
	$getuserinfofire = mysqli_query($con,$getuserinfo);
	$row = mysqli_fetch_array($getuserinfofire);

	// Getting users records
	$getrecords = "SELECT * FROM userrecords WHERE umail = '$umail';";
	$getrecordsfire = mysqli_query($con,$getrecords);
	$num_rows = mysqli_num_rows($getrecordsfire);
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
                    <a href="./userhome.php" class="nav-link">HOME</a>
                </li>
                <li class="nav-item active">
                    <a href="<?php $_SERVER['PHP_SELF'] ?>" class="nav-link">PROFILE</a>
                </li>
                <li class="nav-item">
                    <a href="./quizhistory.php" class="nav-link">QUIZ HISTORY</a>
                </li>
				<!-- Dropdown -->
			    <li class="nav-item dropdown mr-5">
			        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
			       		FEEDBACK
			      	</a>
			      	<div class="dropdown-menu">
					    <a class="dropdown-item" href="./feedback.php">Send Feedback</a>
					    <a class="dropdown-item" href="./recentfeed.php">Recent</a>
			      	</div>
			    </li>
			    <li class="nav-item">
					<a class="nav-link btn btn-secondary text-light" href="../logout.php">Logout</a>
				</li>
            </ul>
        </div>
    </div>
    </nav>
    <!-- end navbar -->

	<!-- main -->
	<main>
		<div class="container py-5">

			<!-- User profile -->
			<div class="profile mb-5">
				<h3 class="text-dark mb-3 text-center">Your Profile</h3>
				<table class="table table-bordered table-striped table-dark table-responsive-sm">
					<thead class="bg-secondary text-light">
						<tr>
							<th>Id</th>
							<th>Name</th>
							<th>Phone</th>
							<th>Email</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?php echo $row['uid'] ?></td>
							<td><?php echo $row['uname'] ?></td>
							<td><?php echo $row['uphone'] ?></td>
							<td><?php echo $row['umail'] ?></td>
						</tr>
					</tbody>
					
				</table>
			</div>

			<!-- update form -->
			<?php include './userupdate.php'; ?>


		</div>
	</main>
</body>
</html>













