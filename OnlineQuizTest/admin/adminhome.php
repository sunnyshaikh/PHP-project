<?php 
	include '../db/db.php';
	session_start();

	if(!isset($_SESSION['amail']))
		header("location:./adminlogin.php");

	$amail = $_SESSION['amail'];

	// Getting admminame from database
	$getaname = "SELECT aname FROM admin WHERE amail = '$amail';";
	$getanamefire = mysqli_query($con,$getaname);
	$row = mysqli_fetch_array($getanamefire);

	// getting categories from database
	$selectcat = "SELECT * FROM category;";
	$selectcatfire = mysqli_query($con,$selectcat);

	if(isset($_POST['submit']))
	{
		switch ($_POST['action'])
		{
			case 0:
				header("location:./addquestions.php");
				break;
			case 1:
				header("location:./addcategory.php");
				break;
			case 2:
				header("location:./checkquestions.php");
				break;
			case 3:
				header("location:./checkcategory.php");
				break;
			case 4:
				header("location:./checkusers.php");
				break;
			case 5:
				header("location:./feedback.php");
				break;	
		}
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
			<!-- Title -->
			<div class="title">
				<h2 class="text-dark text-center main-heading">Welcome, <?php echo "<i>".$row['aname']."</i>"; ?> to Online Quiz Website.</h2>
				<h6 class="small slogan text-secondary text-center">TELL ME WHAT YOU WANT TO DO.</h6>
			</div>
			
			<!-- Actions -->
			<div class="form center shadow bg-white p-3 mt-5 col-sm-12 col-lg-6">
				<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
					<div class="form-group">
					<label>Select Action:</label>
						<select name="action" class="form-control">
							<option value="0">Add Questions</option>
							<option value="1">Add Category</option>
							<option value="2">View Questions</option>
							<option value="3">View Category</option>
							<option value="4">View Users</option>
							<option value="5">View Feedbacks</option>
						</select>
					</div>
					<input type="submit" name="submit" value="Submit" class="btn btn-primary">
				</form>
			</div>
		</div>
	</main>
</body>
</html>







