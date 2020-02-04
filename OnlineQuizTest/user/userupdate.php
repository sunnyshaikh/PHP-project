<?php 
	include '../db/db.php';

	$umail = $_SESSION['umail'];
	
	if(!isset($_SESSION['umail']))
		header("location:../index.php");

	if(isset($_POST['submit']))
	{
		$uname = $_POST['uname'];
		$upass = $_POST['upass'];

		$update = "UPDATE user SET uname = '$uname',upass = '$upass' WHERE umail = '$umail';";
		$updatefire = mysqli_query($con,$update);

		if($updatefire)
		{
			$msg = '<div class="text-center alert alert-success mt-3">Successfully Updated :)</div>';	
		}
		else
			$msg = '<div class="text-center alert alert-danger mt-3">Something went wrong :(</div>';
	}
 ?>


<!-- main -->
<!-- Title -->
<div class="title">
	<h3 class="text-dark text-center">User Update Form</h6>
</div>

<!-- update form -->
<div class="form col-lg-6 shadow p-4 mt-3 center">
	<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
		<div class="form-group">
			<label>E-mail id:</label>
			<input type="text" name="umail" value="<?php echo $umail ?>" readonly class="form-control">
		</div>

		<div class="form-group">
			<label>Change Username:</label>
			<input type="text" name="uname" value="<?php if(isset($_POST['uname'])) echo $uname; ?>" required class="form-control">
		</div>

		<div class="form-group">
			<label>Change Password:</label>
			<input type="password" name="upass" required class="form-control">
		</div>

		<input type="submit" name="submit" value="Update" class="btn btn-primary">
		<?php 
			if(isset($msg))
				echo "$msg";
		 ?>
	</form>
</div>








