<?php 
	include './db/db.php';
	session_start();

	$umail = $_SESSION['umail'];
	$catid = $_POST['selectcat'];
	$_SESSION['catid'] = $catid;

	if(!isset($umail))
		header("location:../index.php");

	// get categories from db
	$selectque = "SELECT * FROM questions WHERE catid = '$catid';";
	$selectquefire = mysqli_query($con,$selectque);
	$num_rows = mysqli_num_rows($selectquefire);
 ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>The Quiz</title>

    <!-- Bootstrap css link -->
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <!-- Custom css link -->
    <link rel="stylesheet" href="./css/style.css">
    <!-- jquery link -->
    <script src="./js/jQuery.min.js"></script>
    <!-- bootstrap js link -->
    <script src="./js/bootstrap.min.js"></script>

	
</head>
<body onload="timer()">
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
                    <li class="nav-item mr-5">
                        <a href="./user/userhome.php" class="nav-link">QUIT QUIZ</a>
                    </li>
				    <li class="nav-item">
						<a class="nav-link btn btn-secondary text-light" href="./logout.php">Logout</a>
					</li>
                </ul>
            </div>
        </div>
        </nav>
        <!-- end navbar -->
        
        <div class="container py-5">
			<div class="col-12 col-lg-8 center">
				<?php if($num_rows) { ?>
					<div id="showtime"></div>
				<form action="./result.php" method="post" id="form1">
					
					<?php $i=0; while($row = mysqli_fetch_array($selectquefire)) {$i++; ?>
					<table class="table table-dark table-striped table-bordered">
						<thead class="bg-secondary text-light">
							<tr>
								<th><?php echo $i.". ". $row['qname']; ?></th>
							</tr>
						</thead>
						<tbody>
	            	<?php 
	            	if(isset($row['option1']) || isset($row['option2']) || isset($row['option3']) || isset($row['option4'])) {?>
							<tr>
								<td><input type="radio" value="0" name="<?php echo $row['qid']; ?>"> <?php echo $row['option1']; ?></td>
							</tr>
							<tr>
								<td><input type="radio" value="1" name="<?php echo $row['qid']; ?>"> <?php echo $row['option2']; ?></td>
							</tr>
							<tr>
								<td><input type="radio" value="2" name="<?php echo $row['qid']; ?>"> <?php echo $row['option3']; ?></td>
							</tr>
							<tr>
								<td><input type="radio" value="3" name="<?php echo $row['qid']; ?>"> <?php echo $row['option4']; ?></td>
							</tr>
	            	<?php } ?>

	            	<tr class="bg-secondary">
	                    <td><input type="radio" checked="checked" style="display: none;" value="none" name="<?php echo $row['qid']; ?>" /></td>
	                </tr>
						</tbody>
					</table>
				<?php  } $_SESSION['tq']=$i; ?>
				
					<input type="submit" name="submit" value="Submit" class="btn btn-primary">
				</form>
			<?php } 
			else { ?>
				<h2 class="text-secondary text-center mt-5">No Questions Available!</h2>
			<?php } ?>
			</div>
		</div>

    </div>


    <script language="javascript">
		var tf=10;
        function timer() {
            if(tf<0)
            {
                clearTimeout(x);
                document.getElementById("form1").submit();
            }
            else
            {
                document.getElementById("showtime").innerHTML=tf+" seconds left";
            }
            tf--;
            var x=setTimeout(function(){timer()},1000);
        }
	</script>
</body>
</html>


















