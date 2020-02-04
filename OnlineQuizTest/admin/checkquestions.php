<?php
	include '../db/db.php';
	session_start();
	
	if(!isset($_SESSION['amail']))
		header("location:./adminlogin.php");

	// Getting users info
	$getque = "SELECT * FROM questions;";
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
	<div class="container mt-5">
		<h3 class="text-center">Added Questions</h3>
	<form action="./delete.php" method="post">
	<table class="table table-bordered table-striped table-dark mt-4 table-responsive-sm">
		<thead class="bg-secondary">
			<tr>
				<th>S.N</th>
				<th>Q.Id</th>
				<th colspan="2">Name</th>
			</tr>
		</thead>
		<tbody>
			<?php $i=0; while($row = mysqli_fetch_array($getquefire)){ $i++;?>
			<tr>
				<td><?php echo $i; ?> </td>
				<td><?php echo $row['qid'] ?></td>
				<td><?php echo $row['qname'] ?></td>
				<td><button type="submit" name="delque" value="<?php echo $row['qid'] ?>" class="btn text-primary p-0">Delete</button></td>
			</tr>
		<?php } ?>
		</tbody>
			
	</table>
	</form>
	</div>
</body>
</html>













