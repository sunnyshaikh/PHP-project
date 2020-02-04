<?php 
	include '../db/db.php';
	session_start();
	
	if(!isset($_SESSION['amail']))
		header("location:./adminlogin.php");
	
	// get categorie from databse
	$selectcat = "SELECT * FROM category;";
	$selectcatfire = mysqli_query($con,$selectcat);


	if(isset($_POST['submit']))
	{
		$que = trim($_POST['que']);
		$option1 = trim($_POST['option1']);
		$option2 = trim($_POST['option2']);
		$option3 = trim($_POST['option3']);
		$option4 = trim($_POST['option4']);
		$rightans = $_POST['rightans']-1;
		$catid = $_POST['selectcat'];

		//get questions from database
		$selectque = "SELECT * FROM questions WHERE qname = '$que';";
		$selectquefire = mysqli_query($con,$selectque);
		$num_rows = mysqli_num_rows($selectquefire);

		// inserting questions
		if($num_rows<1)
		{
		$insertque = "INSERT INTO questions(qname,option1,option2,option3,option4,answer,catid) VALUES ('$que','$option1','$option2','$option3','$option4','$rightans','$catid')";
		$insertquefire = mysqli_query($con,$insertque);
		if($insertquefire)
			$msg = '<div class="alert alert-success mt-4 text-center">Successfully Inserted :)</div>';
		else
			$msg = '<div class="alert alert-danger mt-4 text-center">Something went wrong :(</div>';
		}
		else
			$msg = '<div class="alert alert-danger mt-4 text-center">Question Already Exists!</div>';
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

	<!-- Form -->
	<div class="container mt-5">
	<h3 class="text-center">Add Question</h3>
	<div class="form center shadow mt-4 p-3 col-lg-10">
	<form action="<?php $_SERVER['PHP_SELF'] ?>" method=post>
		<div class="form-group">
			<label>Enter Question</label>
			<input type="text" name="que" required class="form-control">
		</div>
		<div class="form-group">
			<label>Enter Option 1</label>
			<input type="text" name="option1" required class="form-control">
		</div>
		<div class="form-group">
			<label>Enter Option 2</label>
			<input type="text" name="option2" required class="form-control">
		</div>
		<div class="form-group">
			<label>Enter Option 3</label>
			<input type="text" name="option3" required class="form-control">
		</div>
		<div class="form-group">
			<label>Enter Option 4</label>
			<input type="text" name="option4" required class="form-control">
		</div>
		<div class="form-group">
			<label>Enter Right Option <small>(in number)</small></label>
			<input type="text" name="rightans" required class="form-control">
		</div>
		<div class="form-group">
			<label>Choose Category</label>
			<select name="selectcat" class="form-control" required>
				<?php while($row = mysqli_fetch_array($selectcatfire)){ ?>
					<option value="<?php echo $row['catid'] ?>"><?php echo $row['catname'] ?></option>
				<?php } ?>
			</select>
		</div>
		<input type="submit" name="submit" value="Insert" class="btn btn-primary">
		
		<?php 
			if(isset($msg))
				echo $msg;
		 ?>
		
	</form>
	</div><br><br><br><br><br><br>
</div>
</body>
</html>