<?php 
	include '../db/db.php';
	session_start();
	
	if(!isset($_SESSION['amail']))
		header("location:./adminlogin.php");

	// Getting users info
	$getreguser = "SELECT * FROM user ORDER BY uname;";
	$getreguserfire = mysqli_query($con,$getreguser);

	// Getting given users info
	if(isset($_POST['searchuser']))
	{
		$getsreguser = "SELECT * FROM user WHERE uid = '".$_POST['searchuser']."';";
		$getsreguserfire = mysqli_query($con,$getsreguser);
		$msg='<span class="text-danger">Cant find record for user id '.$_POST['searchuser'].'</span>';
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

			<!-- User registered -->
			<div class="profile">
				<h3 class="text-dark text-center">Registered Users</h3>
	
				<!-- display given user -->
				<div class="searchuser mt-5 mb-2">
					<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" class="form-inline">
						<label>Search User:</label>&nbsp;
						<input type="text" name="searchuser" value="<?php if(isset($_POST['searchuser'])) echo $_POST['searchuser'] ?>" required class="form-control" placeholder="Enter user id">&emsp;
						<input type="submit" name="searchsubmit" class="mt-2 btn btn-primary" value="Search" />
    			
					</form>
				</div>

				<!-- Display all users -->
				<?php if(isset($_POST['searchsubmit']) && mysqli_num_rows($getsreguserfire)>0) { ?>
				<table class="table table-responsive-sm table-bordered table-striped table-dark">
					<thead class="bg-secondary">
						<tr>
							<th>S.N</th>
							<th>Id</th>
							<th>Name</th>
							<th>Phone</th>
							<th>Email</th>
						</tr>
					</thead>
					<tbody>
						<?php $i=0; while($row1 = mysqli_fetch_array($getsreguserfire)){ $i++;?>
						<tr>
							<td><?php echo $i; ?> </td>
							<td><?php echo $row1['uid'] ?></td>
							<td><?php echo $row1['uname'] ?></td>
							<td><?php echo $row1['uphone'] ?></td>
							<td><?php echo $row1['umail'] ?></td>
						</tr>
					<?php } ?>
					</tbody>
					
				</table>
			<?php } else { ?>
				<small>*Displaying all records.<?php if(isset($msg)) echo $msg;?></small>
				<table class="table table-responsive-sm table-bordered table-striped table-dark">
					<thead class="bg-secondary">
						<tr>
							<th>S.N</th>
							<th>Id</th>
							<th>Name</th>
							<th>Phone</th>
							<th>Email</th>
						</tr>
					</thead>
					<tbody>
						<?php $i=0; while($row = mysqli_fetch_array($getreguserfire)){ $i++;?>
						<tr>
							<td><?php echo $i; ?> </td>
							<td><?php echo $row['uid'] ?></td>
							<td><?php echo $row['uname'] ?></td>
							<td><?php echo $row['uphone'] ?></td>
							<td><?php echo $row['umail'] ?></td>
						</tr>
					<?php } ?>
					</tbody>
					
				</table>
			<?php } ?>
			</div>
		</div>
	</main>
</body>
</html>













