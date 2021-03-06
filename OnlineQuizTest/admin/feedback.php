<?php 
	include '../db/db.php';
	session_start();

	if(!isset($_SESSION['amail']))
		header("location:./adminlogin.php");

		// Getting users info
		$getque = "SELECT * FROM userfeedback;";
		$getquefire = mysqli_query($con,$getque);
		$num_rows = mysqli_num_rows($getquefire);
	
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
                    <li class="nav-item active">
                        <a href="./adminhome.php" class="nav-link">HOME</a>
                    </li>
                    <li class="nav-item">
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

			<?php if($num_rows > 0) { ?>
				<form action="./delete.php" method="post">
				<?php while($row = mysqli_fetch_array($getquefire)) { ?>
					<div class="form center jumbotron shadow-sm p-3 col-lg-8">
						<div class="from">
							<h6 class="text-secondary">From:</h6> <?php echo $row['umail']; ?><br>
							<h6 class="text-secondary">Date:</h6> <?php echo $row['feeddate']?>
						</div>
						<div class="feed">
							<h6 class="text-secondary">Feedback:</h6>
							<?php echo $row['feed']; ?>
						</div>
						<hr class="my-4">
						<button type="submit" name="delfeed" value="<?php echo $row['fid'] ?>" class="btn btn-primary">Delete</button>
					</div>
				<?php } ?>
				</form>

			<?php } 
			else {?>
				<h2 class="text-secondary text-center mt-5">No Feedback Available!</h2>
			<?php } ?> 

		</div>
	</main>
</body>
</html>