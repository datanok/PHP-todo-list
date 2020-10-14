
 <?php
 require 'dbconnection.php';
 session_start();
 $_SESSION['message'] = '';
 if ($_SERVER['REQUEST_METHOD']  == 'POST') {
   if(isset($_POST["login"]))
   {
        if(empty($_POST["email"]) && empty($_POST["password"]))
        {
             echo '<script>alert("Both Fields are required")</script>';
        }
        else
        {
             $email= mysqli_real_escape_string($mysqli, $_POST["email"]);
             $password = mysqli_real_escape_string($mysqli, $_POST["password"]);
             $password = md5($password);
             $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";

             $temp = mysqli_query($mysqli, $query);
             $result = $temp->fetch_assoc();
             if(!empty($result))
             {
               $_SESSION['email'] = $result['email'];
               $_SESSION['username'] = $result['username'];
               $_SESSION['avatar'] = $result['avatar'];
               $_SESSION['message'] = "login successfull";
               $_SESSION['loggedin'] = true;

              header("location: welcome.php");
             }
             else
             {
              //echo '<script>alert("Wrong User Details")</script>';
              $_SESSION['message'] = "Wrong Details";

             }
        }
   }
 }

  ?>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
      integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="css/style.css" />
  </head>
  <body>
    <div class="login-form col-md-8 col-12 col-lg-4">

      <form action="login.php" method="post">
        <h2 class="text-center">Log in</h2>
        <?php if ($_SESSION['message'] != '') {
        echo '<div class="alert alert-danger alert-dismissible fade show" data-dismiss="alert">' . $_SESSION['message'] . '</div>';
            }; ?>
        <div class="form-group">

          <input
            type="text"
            class="form-control"
            placeholder="Email"
            required="required"
            name="email"
          />
        </div>
        <div class="form-group">
          <input
            type="password"
            class="form-control"
            placeholder="Password"
            required="required"
            name = "password"
          />
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary btn-block" name="login">
            Log in
          </button>
        </div>
        <div class="clearfix">
          <label class="float-left form-check-label"
            ><input type="checkbox" class="custom-checkbox" /> Remember
            me</label
          >
        <a href="#" class="float-right">Forgot Password?</a>
        </div>
      </form>

      <p class="text-center"><a href="register.php">Create an Account</a></p>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
