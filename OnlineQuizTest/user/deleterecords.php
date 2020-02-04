<?php 
	include '../db/db.php';

	// delete result record
	if(isset($_POST['delrecord']))
	{
		$rid = $_POST['delrecord'];
		$delrecord = "DELETE FROM userrecords WHERE rid = '$rid';";
		$delrecordfire = mysqli_query($con,$delrecord);

		if($delrecordfire)
		{
			header("location:./quizhistory.php");
		}
		else{
			echo "<script>alert('Cant delete)</script>";
			header("location:./quizhistory.php");
		}
	}

	// Delete feedback
	if(isset($_POST['delfeed']))
	{
		$del = $_POST['delfeed'];
		$delfeed = "DELETE FROM userfeedback WHERE fid='$del';";
		$delfeedfire = mysqli_query($con,$delfeed);
		if($delfeedfire)
			header("location:./recentfeed.php");
		else{
			echo "<script>alert('Cant Delete')</script>";
			header("location:./recentfeed.php");
		}
	}
?>
