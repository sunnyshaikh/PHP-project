<?php 
    include '../db/db.php';
    session_start();

    // when pressed login button
    if(isset($_POST['submit'])){
        $amail = $_POST['amail'];
        $apass = $_POST['apass'];

        $checkadmin = "SELECT * FROM admin WHERE amail = '$amail' AND apass = '$apass';";
        if(mysqli_num_rows(mysqli_query($con,$checkadmin)) == 1){
            $_SESSION['amail'] = $amail;
            header("location:./adminhome.php");
        }
        else{   
            $msg1 = '<div class="alert alert-danger">Email or Password entered wrong :(</div>';
        }
    }
 ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="X-UA-Compatible" content="ie=edge"> -->
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
    <div class="section1 main" style="height: 100vh;">
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
                            <a href="../index.php" class="nav-link">HOME</a>
                        </li>
                        <li class="nav-item">
                            <a href="../index.php" class="nav-link">REGISTER</a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php $_SERVER['PHP_SELF'] ?>" class=" text-primary nav-link">ADMIN</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- navbar end -->

        <div class="center login-form col-lg-5 col-12 mt-5">
            <!-- admin login form -->
            <h2 class="text-dark text-center">Admin Login Form</h2>
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" class="form p-3 shadow mt-3">
                <div class="form-group">
                    <label for="amail">Email id</label>
                    <input type="text" placeholder="ex- john1234@gmail.com" name="amail" id="amail" class="form-control" required>
                    <div class="email-msg"></div>
                </div>
                <div class="form-group">
                    <label for="apass">Password</label>
                    <input type="text" placeholder="ex- @John1234" name="apass" id="apass" class="form-control" required>
                    <div class="pass-msg"></div>
                </div>
                <button type="submit" name="submit" class="btn btn-primary col-12 col-lg-2 mt-3">LOGIN</button>
                <?php 
                    if(isset($msg1))
                        echo $msg1;
                 ?>
            </form>
        </div>
        <!-- admin login form -->
    </div>

     <footer class="bg-dark py-2">
            <h6 class="text-center text-secondary">PHP Project (Online Quiz)</h6>
            <h6 class="text-center text-secondary">Developed by- Altaf Alam Shaikh & Saipras Dongre</h6>
            
    </footer>
    <!-- footer end -->
</body>
</html>






