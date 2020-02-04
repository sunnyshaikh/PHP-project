<?php 
	include '../db/db.php';

	//Delete category and question from it
	if(isset($_POST['delcat']))
	{
		include '../database/db_connect.php';
		$delcat = $_POST['delcat'];
		$del = "DELETE FROM category WHERE catid = '$delcat';"; 
		$delfire = mysqli_query($con,$del);
		$delque = "DELETE FROM questions WHERE catid = '$delcat';"; 
		$delquefire = mysqli_query($con,$delque);
		if($delfire)
		{
			header("location:./checkcategory.php");
		}
		else
			echo "Cant delete";
	}

	//Delete questions
	if(isset($_POST['delque']))
	{
		$delque = $_POST['delque'];
		$del = "DELETE FROM questions WHERE qid = '$delque';"; 
		$delquefire = mysqli_query($con,$del);
		if($delquefire)
		{
			header("location:./checkquestions.php");
		}
		else
			echo "Cant delete";
	}

	//Delete feedback
	if(isset($_POST['delfeed']))
	{
		$del = $_POST['delfeed'];
		$delfeed = "DELETE FROM userfeedback WHERE fid='$del';";
		$delfeedfire = mysqli_query($con,$delfeed);
		if($delfeedfire)
			header("location:./feedback.php");
		else{
			echo "<script>alert('Cant Delete')</script>";
			header("location:./feedback.php");
		}
	}
 ?>