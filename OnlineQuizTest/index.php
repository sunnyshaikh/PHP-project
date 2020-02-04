<?php 
    include './db/db.php';
    session_start();

    // when pressed register button
    if (isset($_POST['regsubmit'])) {
        $uname = $_POST['uname'];
        $umail = $_POST['umail'];
        $uphone = $_POST['uphone'];
        $upass = $_POST['upass'];

        $checkuser = "SELECT * FROM user WHERE umail = '$umail';";

        if(mysqli_num_rows(mysqli_query($con,$checkuser)) < 1){
        $insertuser = "INSERT INTO user (uname,umail,uphone,upass) VALUES('$uname','$umail','$uphone','$upass');";

        if(mysqli_query($con, $insertuser))
            $msg = '<div class="alert alert-success">Successfully Registered :)</div>';
        else
            $msg = '<div class="alert alert-danger">Something went wrong :(</div>';
        }
        else
            $msg = '<div class="alert alert-danger">Email alreay exists :(</div>';

    }


    // when pressed login button
    if(isset($_POST['loginsubmit'])){
        $umail = $_POST['umail'];
        $upass = $_POST['upass'];

        $checkuser = "SELECT * FROM user WHERE umail = '$umail' AND upass = '$upass';";
        if(mysqli_num_rows(mysqli_query($con,$checkuser)) == 1){
            $_SESSION['umail'] = $umail;
            header("location:./user/userhome.php");
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
<body>
    <div class="section1 main" id="section1">
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
                        <a href="<?php $_SERVER['PHP_SELF'] ?>" class="nav-link">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a href="#section2" class="nav-link">LOGIN</a>
                    </li>
                    <li class="nav-item">
                        <a href="#section1" class="nav-link">REGISTER</a>
                    </li>
                    <li class="nav-item">
                        <a href="./admin/adminlogin.php" class=" text-primary nav-link">ADMIN</a>
                    </li>
                </ul>
            </div>
        </div>
        </nav>
        <!-- end navbar -->

        <!-- main content -->
        <div class="container-fluid main-content">
            <div class="mt-5 d-flex justify-content-around flex-lg-row flex-md-column flex-column">
                <!-- welcome note -->
                <div class="heading">
                    <h1 class="main-heading">Welcome To <u class="text-primary logo">THE QUIZ</u></h1>
                    <p class="text-secondary slogan mt-3">SHOW UP YOUR PROGRAMMING SKILLS.</p>
                    <hr class="p-0 m-0">
                    <a href="#section2"><button class="btn btn-success mt-3">LOGIN</button></a>
                </div>
                <!-- welcome note end -->

                <!-- user register form -->
                <div class="register-form col-lg-5 col-12 mt-lg-0 mt-5">
                    <h2 class="text-dark text-center">Register Form</h2>
                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" class="form p-3 shadow mt-3" onsubmit="return valid()">
                        <div class="form-group">
                            <label for="uname">Username</label>
                            <input type="text" placeholder="ex- John1999" name="uname" id="uname" class="form-control" required>
                            <div id="username-msg" class="text-danger small"></div>
                        </div>
                        <div class="form-group">
                            <label for="umail">Email id</label>
                            <input type="text" placeholder="ex- john1234@gmail.com" name="umail" id="umail" class="form-control" required>
                            <div id="email-msg" class="text-danger small"></div>
                        </div>
                        <div class="form-group">
                            <label for="uphone">Phone</label>
                            <input type="text" placeholder="ex- 9128456321" name="uphone" id="uphone" class="form-control" required>
                            <div id="phone-msg" class="text-danger small"></div>
                        </div>
                        <div class="form-group">
                            <label for="upass">Set Password</label>
                            <input type="password" placeholder="ex- @John1234" name="upass" id="upass" class="form-control" required>
                            <div id="pass-msg" class="text-danger small"></div>
                        </div>
                        <div class="form-group">
                            <label for="ucpass">Confirm Password</label>
                            <input type="password" placeholder="Confirm Password" name="ucpass" id="ucpass" class="form-control" required>
                            <div id="cpass-msg" class="text-danger small"></div>
                        </div>
                        <button type="submit" name="regsubmit" class="btn btn-primary col-12 col-lg-3 mt-3">REGISTER</button>
                        <?php 
                            if (isset($msg)) {
                                echo $msg;
                            }
                         ?>
                    </form>
                </div>
                <!-- register form end -->
            </div>
            <!-- main-content end -->
        </div>
    </div>
    <!-- section 1 end -->

    <hr>

    <div class="section2" id="section2">
        <!-- user login form -->
        <div class="center login-form col-lg-5 col-12 mt-lg-0 mt-5">
            <h2 class="text-dark text-center">Login Form</h2>
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" class="form p-3 shadow mt-3">
                <div class="form-group">
                    <label for="umail">Email id</label>
                    <input type="text" placeholder="ex- john1234@gmail.com" name="umail" id="umail" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="upass">Password</label>
                    <input type="password" placeholder="ex- @John1234" name="upass" id="upass" class="form-control" required>
                </div>
                <button type="submit" name="loginsubmit" class="btn btn-primary col-12 col-lg-2 mt-3">LOGIN</button>
                <?php 
                    if(isset($msg1))
                        echo $msg1;
                 ?>
            </form>
        </div>
        <!-- user login form end -->
    </div>
    <!-- section2 end -->

    <footer class="bg-dark py-2">
            <h6 class="text-center text-secondary">PHP Project (Online Quiz)</h6>
            <h6 class="text-center text-secondary">Developed by- Altaf Alam Shaikh & Saipras Dongre</h6>
            
    </footer>
    <!-- footer end -->

    <!-- custom js -->
    <script type="text/javascript">

        function valid() {
            var uname = document.getElementById('uname').value;
            var umail = document.getElementById('umail').value;
            var uphone = document.getElementById('uphone').value;
            var upass = document.getElementById('upass').value;
            var ucpass = document.getElementById('ucpass').value;

            // Username validating
            if(uname.length == ""){
                document.getElementById('username-msg').innerHTML = "*Field Required";
                return false;
            }
            else if(uname.length <= 2 || uname.length >=16){
                document.getElementById('username-msg').innerHTML = "*Length can be between 3 and 15";
                return false;
            }
            else{
                document.getElementById('username-msg').innerHTML = ""; 
            }

            // email validating
            // regular expression for email
            var email_re = /^[a-zA-Z0-9]+[a-zA-Z0-9_]*@[a-z]+\.[a-z]{2,3}$/;

            if(umail.length == ""){
                document.getElementById('email-msg').innerHTML = "*Field Required";
                return false;
            }
            else if(!email_re.test(umail)){
                document.getElementById('email-msg').innerHTML = "*Email id might be incorrect";
                return false;
            }
            else
                document.getElementById('email-msg').innerHTML = "";



            // phone validating
            // regular expression for phone
            var phone_re = /^[0789][0-9]{9}$/;

            if(uphone.length == ""){
                document.getElementById('phone-msg').innerHTML = "*Field Required";
                return false;
            }
            else if(!phone_re.test(uphone)){
                document.getElementById('phone-msg').innerHTML = "*Phone number is invalid";
                return false;
            }
            else
                document.getElementById('phone-msg').innerHTML = "";



            // password validating
            if(upass.length == ""){
                document.getElementById('pass-msg').innerHTML = "*Field Required";
                return false;
            }
            else if(upass.length < 8 || upass.length > 21){
                document.getElementById('pass-msg').innerHTML = "*Length must be between 8 and 20";
                return false;
            }
            else
                document.getElementById('pass-msg').innerHTML = "";


            // confirm password
            if(ucpass.length == ""){
                document.getElementById('cpass-msg').innerHTML = "*Field Required";
                return false;
            }
            else if(ucpass != upass){
                document.getElementById('cpass-msg').innerHTML = "*Password did not matched";
                return false;
            }
            else
                document.getElementById('cpass-msg').innerHTML = "";
        }
    </script>
    <!-- js end -->
</body>
</html>



















