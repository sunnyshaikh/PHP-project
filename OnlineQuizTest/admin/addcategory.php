<?php 
	include '../db/db.php';
	session_start();
	
	if(!isset($_SESSION['amail']))
		header("location:./adminlogin.php");


	if(isset($_POST['submit']))
	{
		$catname = trim($_POST['catname']);
		
		// get categorie from databse
		$selectcat = "SELECT * FROM category WHERE catname = '$catname';";
		$selectcatfire = mysqli_query($con,$selectcat);
		$num_rows = mysqli_num_rows($selectcatfire);
		
		// inserting category
		if($num_rows<1)
		{
		$insertcat = "INSERT INTO category (catname) VALUES ('$catname');";
		$insertcatfire = mysqli_query($con,$insertcat);
		if($insertcatfire)
			$msg = '<div class="alert alert-success mt-4 text-center">Successfully Inserted :)</div>';
		else
			$msg = '<div class="alert alert-danger mt-4 text-center">Something went wrong :(</div>';
		}
		else
			$msg = '<div class="alert alert-danger mt-4 text-center">Category Already Exists!</div>';
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
				<h2 class="text-dark text-center">Add Category Form.</h2>
			</div>

			<!-- Form -->
			<div class="form center shadow mt-4 p-3 col-12 col-lg-6">
			<form action="<?php $_SERVER['PHP_SELF'] ?>" method=post>
				<div class="form-group">
					<label>Enter Category name</label>
					<input type="text" name="catname" required class="form-control">
				</div>
				<input type="submit" name="submit" value="Insert" class="btn btn-primary">
				<?php 
					if(isset($msg))
						echo $msg;
				 ?>
				
			</form>
			</div>

		</div>
	</main>
</body>
</html>