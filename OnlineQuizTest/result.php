<?php 
	include './db/db.php';
	session_start();

	if(!isset($_SESSION['umail']))
		header('location:./index.php');

	$catid = $_SESSION['catid'];
	$tq = $_SESSION['tq'];
	$umail = $_SESSION['umail'];

	$selectcat = "SELECT catname FROM category WHERE catid = '$catid';";
	$selectcatfire = mysqli_query($con,$selectcat);
	$row = mysqli_fetch_array($selectcatfire);
	$catname = $row['catname'];

	$date = date('y-m-d');

	$selectans = "SELECT * FROM questions WHERE catid = '$catid';";
	$selectansfire = mysqli_query($con,$selectans);


	$right = 0;
	$wrong = 0;
	$attempt = 0;
	$na = 0;

	while($row = mysqli_fetch_array($selectansfire))
	{
		if($_POST[$row['qid']] == $row['answer'])
		{
			$attempt++;
			$right++;
		}
		else if ($_POST[$row['qid']] == 'none') {
			$na++;
		}
		else
		{
			$attempt++;
			$wrong++;
		}
	}

	$per = number_format(($right*100)/$tq,2);
	if($per >= 50)
		$msg = '<h1 class="text-center text-success mt-5 greet">Congratulations You Won :)</h1>';
	else
		$msg = '<h1 class="text-center text-danger mt-5 greet">Better Luck Next Time :(</h1>';

		$insertrecord = "INSERT INTO userrecords (catname,umail,percentage,playdate) VALUES('$catname','$umail','$per','$date');";
		$insertrecordfire = mysqli_query($con,$insertrecord);
			
		

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Online Quiz</title>

	<!-- Bootstrap css link -->
	<link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">

	<!-- Custom css link -->
	<link rel="stylesheet" type="text/css" href="./css/style.css">

	<!-- Jquery link -->
	<script src="./js/jQuery.min.js"></script>

	<!-- Bootstrap js link -->
	<script src="./js/bootstrap.min.js"></script>

</head>
<body>
	<!-- Navbar -->
    <nav class="navbar bg-light navbar-expand-md shadow navbar-light">
        <div class="container">
        <h5 class="text-primary logo">THE QUIZ</h5>

        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="menu collapse navbar-collapse" id="navbar">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item mr-5">
                    <a href="./user/userhome.php" class="nav-link">BACK TO HOME</a>
                </li>
			    <li class="nav-item">
					<a class="nav-link btn btn-secondary text-light" href="./logout.php">Logout</a>
				</li>
            </ul>
        </div>
    	</div>
    </nav>
        <!-- end navbar -->

	<!-- main -->
	<main>
		<div class="container py-5">
			<!-- Title -->
			<div class="title text-center">
				<h2 class="text-dark main-heading">Online Quiz Website.</h2>
				<h6 class="text-secondary slogan">YOUR QUIZ RESULT</h6>
			</div>

			<div class="resultboard mt-4">
				<table class="table table-bordered table-striped table-dark">
					<thead class="bg-secondary text-light">
						<tr>
							<th>Total Questions</th>
							<th><?php echo $tq; ?></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Right answer</td>
							<td><?php echo $right; ?></td>
						</tr>
						<tr>
							<td>Wrong answer</td>
							<td><?php echo $wrong; ?></td>
						</tr>
						<tr>
							<td>Attempted Question</td>
							<td><?php echo $attempt; ?></td>
						</tr>
						<tr>
							<td>Not attempted question</td>
							<td><?php echo $na; ?></td>
						</tr>
						<tr>
							<td>Percentage</td>
							<td><?php echo "$per %"; ?></td>
						</tr>
					</tbody>
				</table>
				 
				<?php if(isset($msg)) echo $msg; ?>

			</div>
		</div>
	</main>
</body>
</html>
