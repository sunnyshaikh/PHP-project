
<?php 
	include '../db/db.php';
	session_start();

	$umail = $_SESSION['umail'];

	if(!isset($_SESSION['umail']))
		header("location:../index.php");


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
                <li class="nav-item">
                    <a href="./userprofile.php" class="nav-link">PROFILE</a>
                </li>
                <li class="nav-item active">
                    <a href="<?php $_SERVER['PHP_SELF'] ?>" class="nav-link">QUIZ HISTORY</a>
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

			<!-- Quiz played records -->
			<?php if($num_rows > 0) { ?>
			<div class="record mt-5">
				<h3 class="text-dark mb-3 text-center">Your Quiz Results</h3>	
				<form action="./deleterecords.php" method="post">
				<table class="table table-striped table-dark table-responsive-sm table-bordered">
					<thead class="bg-secondary text-light">
						<tr>
							<th>S.N</th>
							<th>Category</th>
							<th>Percentage</th>
							<th colspan="2">Date</th>
						</tr>
					</thead>
					<tbody>
						<?php $i=0; while($row1 = mysqli_fetch_array($getrecordsfire)) { $i++; ?>
						<tr>
							<td><?php echo $i; ?></td>
							<td><?php echo $row1['catname']; ?></td>
							<td><?php echo number_format($row1['percentage'],2)." %"; ?></td>
							<td><?php echo $row1['playdate']; ?></td>
							<td><button name="delrecord" class="db btn p-0 text-primary" value="<?php echo $row1['rid']; ?>" type="submit">Delete</button></td>
						</tr>
					<?php } ?>
					</tbody>
				</table>
			</form>
		<?php } else { ?>
			<h3 class="text-secondary text-center mt-5">No Records to show!</h3>
		<?php } ?>
			</div>
		</div>
	</main>
</body>
</html>













