<?php
include '../../db.php';
      if(isset($_POST['login'])){
        $admin_username = $_POST['user_username'];
        $admin_password = md5($_POST['user_password']);

        if($admin_username && $admin_password){
              $run_user = $conn->prepare("SELECT * FROM users WHERE user_username=:username and user_password=:password");
              $run_user->execute(array(
                'username'=>$admin_username,
                'password'=>$admin_password));
             $count_admin=$run_user->rowCount();


     if ($count_admin == 1) {
          $_SESSION['user_username']= $admin_username;

            header('Location: index.php');
            die();
            } else {
              header('Location: login.php?case=no');
              die();}
        }
      }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gentelella Alela! | </title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="../vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form action=" " method="post">
              <h1>Login Form</h1>
              <div>
                <input type="text" name="user_username" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="password" name="user_password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
               <button class="btn btn-lg btn-default" name="login" type="submit">Log in</button>
              </div>
              <?php
              if(@$_GET['case']=="no"){
                echo "Check your username and password.";

              }elseif(@$_GET['case']=="exit"){
                echo "Succesfuly log out.";
              }

              ?>
              <div class="clearfix"></div>

              <div class="separator">


                <p class="change_link">Want to
                  <a href="../../index.php"> Homepage?</a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                  <p>©2017 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>

        <!--
        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form>
              <h1>Create Account</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Email" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <a class="btn btn-default submit" href="index.html">Submit</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                  <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>
        -->
      </div>
    </div>
  </body>
</html>
