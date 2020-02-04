<?php 
	include '../db/db.php';
	session_start();
	
	if(!isset($_SESSION['umail']))
		header("location:../index.php");

	if(isset($_POST['submit']))
	{
		$uname = trim($_POST['uname']);
		$umail = trim($_POST['umail']);
		$feed = trim($_POST['feed']);
		$date = date('y-m-d');


		$checkfeedrecord = "SELECT umail FROM userfeedback WHERE uname='$uname' AND umail='$umail' AND feed = '$feed' AND feeddate='$date';";
		$userfeedfire = mysqli_query($con,$checkfeedrecord);
		$num_rows = mysqli_num_rows($userfeedfire);

		if($num_rows < 1)
		{
			$insertfeed = "INSERT INTO userfeedback (uname,umail,feed,feeddate) VALUES ('$uname','$umail','$feed','$date');";
			$insertfeedfire = mysqli_query($con,$insertfeed);

			if($insertfeedfire)
				$msg = '<div class="text-center alert alert-success">Sent Successfully :)</div>';
			else
				$msg = '<div class="text-center alert alert-danger">Something went wrong :(</div>';
		}
		else
			$msg = '<div class="text-center alert alert-danger">Feedback was already sent!!!</div>';
	}

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
                    <li class="nav-item">
                        <a href="./userprofile.php" class="nav-link">PROFILE</a>
                    </li>
                    <li class="nav-item">
                        <a href="./quizhistory" class="nav-link">QUIZ HISTORY</a>
                    </li>
					<!-- Dropdown -->
				    <li class="nav-item dropdown active mr-5">
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
			<!-- Title -->
			<div class="title">
				<h2 class="text-dark text-center">Online Quiz Website.</h2>
				<p class="text-secondary slogan text-center">USER FEEDBACK FORM</p>
			</div>

			<!-- register Form -->
			<div class="form center col-lg-6 shadow p-4 mt-5">
				<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
					<div class="form-group">
						<label>Username:</label>
						<input type="text" name="uname" value="<?php if(isset($_POST['uname'])) echo $uname; ?>" required="" class="form-control">
					</div>

					<div class="form-group">
						<label>E-mail id:</label>
						<input type="text" name="umail" value="<?php if(isset($_POST['umail'])) echo $umail; ?>" required="" class="form-control">
					</div>

					<div class="form-group">
						<label>Your Feedback</label>
						<textarea name="feed" required class="form-control"></textarea>
					</div>

					<input type="submit" name="submit" value="Send Feedback" class="btn btn-primary">
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







