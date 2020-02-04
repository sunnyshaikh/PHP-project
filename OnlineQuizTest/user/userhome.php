<?php 
	include '../db/db.php';
	session_start();

	$umail = $_SESSION['umail'];

	if(!isset($umail))
		header("location:../index.php");

	// get categories from db
	$selectcat = "SELECT * FROM category;";
	$selectcatfire = mysqli_query($con,$selectcat);
 ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>The Quiz</title>

    <!-- Bootstrap css link -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- Custom css link -->
    <link rel="stylesheet" href="../css/style.css">
    <!-- jquery link -->
    <script src="../js/jQuery.min.js"></script>
    <!-- bootstrap js link -->
    <script src="../js/bootstrap.min.js"></script>

</head>
<body>
    <div class="section1" id="section1">
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
                        <a href="<?php $_SERVER['PHP_SELF'] ?>" class="nav-link">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a href="./userprofile.php" class="nav-link">PROFILE</a>
                    </li>
                    <li class="nav-item">
                        <a href="./quizhistory" class="nav-link">QUIZ HISTORY</a>
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
        
        <div class="container">
        	<div class="mt-4">
	        	<div class="title text-center">
	        		<h1 class="text-dark main-heading">Welcome, <i><?php echo $umail; ?></i></h1>
	        		<p class="text-secondary slogan">TEST YOUR PROGRAAMMING SKILLS HERE.</p>
	        	</div>
				
				<!-- select category form -->
	        	<div class="form center shadow col-lg-6 mt-5 p-3">
	        		<form action="../questions.php" method="post">
	        			<div class="form-group">
	        				<label>Select Category</label>
	        				<select name="selectcat" class="form-control">
	        					<?php while($row = mysqli_fetch_array($selectcatfire)) { ?>
	        					<option value="<?php echo $row['catid']; ?>"><?php echo $row['catname'];?></option>
	        				<?php } ?>
	        				</select>
	        				<input type="submit" name="submit" value="Start Quiz" class="btn btn-primary mt-3">
	        			</div>
	        		</form>
	        	</div>
	        	<!-- category form end -->
	        </div>
        </div>

    </div>
</body>
</html>


















