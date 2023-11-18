<?php     

    ob_start();
    if(!isset($_SESSION)) {
        session_start();
    }
// if (! isset($_SERVER['HTTPS']) or $_SERVER['HTTPS'] == 'off' ) {
//     $redirect_url = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
//     header("Location: $redirect_url");
//     exit();
// }
?>


<?php

    if(isset($_SESSION['username']) && isset($_SESSION['password'])) {

        header("Location: dashboard.php");
    }

 ?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Live Streaming Tv</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css" />
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
  
  </head>
  <body>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
          <form action="" method="post" class="sign-in-form">
            <div class="d-flex align-items-center mb-3 pb-1">
              <span class="h1 fw-bold mb-0">
                <img src="./img/winlogo.png" class="img-fluid" style="height: 100px;"/>
              </span>
            </div>
            <h2 class="title">Sign In</h2>
            <div class="card-header center" id="msg">Welcome Back !</div>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="email" name="email" id="email_address" placeholder="Email" required autofocus />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" name="password" id="password" placeholder="Password" required />
            </div>
            <button type="submit" class="btn solid">Login</button>
           

            <p class="social-text">Or Sign in with social platforms</p>
            <div class="social-media">
              <a href="#" class="social-icon">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-google"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </div>
          </form>


         
        </div>
      </div>
      <div class="panels-container">

        <div class="panel left-panel">
            <div class="content">
                <h3>Live Streaming Tv</h3>
                <p>Real-time broadcasting of television content over the internet, 
                  allowing viewers to watch live shows, sports events, news, and other programs on various devices.</p>
                <button class="btn transparent" id="sign-up-btn">Watch Now</button>
            </div>
            <img src="./img/register.svg" class="image" alt="">
        </div>
      </div>
    </div>

  
  </body>
</html>


<?php if(!empty($_POST['email']) && !empty($_POST['password'])){

        $username = $_POST['email'];
        
        require('db.php');


        $sql = "select password,id from users where username='".$username."'";
        $results = $conn->query($sql);

        if($results->num_rows > 0){

            $row = $results->fetch_assoc();

            $hash = $row['password'];
            $password = $_POST['password'];

            if(password_verify($password,$hash)){

                $_SESSION['valid'] = true;
                $_SESSION['username'] = $username;
                $_SESSION['password'] = "success";
                $_SESSION['timeout'] = time();
                $_SESSION['userid'] = $row['id'];

                header('Location: dashboard.php');
            }else {
                echo "<script>document.getElementById('msg').innerHTML = 'Incorect Password';</script>";
            }

           

        }else {
            echo "<script>document.getElementById('msg').innerHTML = 'User Doesnot Exists.';</script>";
        }

   } ?>