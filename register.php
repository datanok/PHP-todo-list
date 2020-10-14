
<?php
require 'dbconnection.php';
session_start();
$_SESSION['message'] = '';

if ($_SERVER['REQUEST_METHOD']  == 'POST'){
  if ($_POST['password'] == $_POST['confirmpassword']) {


    $username = $mysqli->real_escape_string($_POST['username']);
    $email= $mysqli->real_escape_string($_POST['email']);
    $password= md5($_POST['password']);
    $avatar_path = $mysqli->real_escape_string('images/'.$_FILES['avatar']['name']);

    if (preg_match("!image!", $_FILES['avatar']['type'])) {

      //copy image to image folder
      if (copy($_FILES['avatar']['tmp_name'], $avatar_path)) {

        // $_SESSION['username'] = $username;
        // $_SESSION['avatar'] = $avatar_path;

        $sql = "INSERT INTO users (username, email, password, avatar)"
        . "VALUES('$username', '$email', '$password', '$avatar_path')";

        //redirect to welcome.php if query successfull
        if ($mysqli->query($sql) == true) {
          $_SESSION['message'] = " Registeration successfull";

          header("location: success.php");
        }
        else {
          $_SESSION['message'] = "User could not be added to database";
        }
      }
      else {
        $_SESSION['message'] = "File upload fail";
      }
    }
    else {
      $_SESSION['message'] = "Only upload jpg , png , gif";
    }
  }
  else {
    $_SESSION['message'] = "password do not match";
  }
}
 ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register</title>
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
      integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="css/style.css" />
  </head>
  <body>
    <div class="container reg">
      <div class="row justify-content-center">
        <div class="col-md-5">
          <div class="card">
            <h2 class="card-title text-center">Register</h2>
            <div class="card-body py-md-4">
              <?php if ($_SESSION['message'] != '') {
              echo '<div class="alert alert-danger alert-dismissible fade show" data-dismiss="alert">' . $_SESSION['message'] . '</div>';
                  }; ?>
              <form action="register.php" method="post" enctype= "multipart/form-data">
                <div class="form-group">


                  <input
                    type="text"
                    class="form-control"
                    name="username"
                    placeholder="UserName"
                  />
                </div>
                <div class="form-group">
                  <input
                    type="email"
                    class="form-control"
                    id="email"
                    name="email"
                    placeholder="Email"
                  />
                </div>

                <div class="form-group">
                  <input
                    type="password"
                    class="form-control"
                    id="password"
                    name="password"
                    placeholder="Password"
                  />
                </div>
                <div class="form-group">
                  <input
                    type="password"
                    class="form-control"
                    id="confirm-password"
                    name="confirmpassword"
                    placeholder="confirm password"
                  />
                </div>
                <div class="form-group test">
                  <label class="text-dark">Select your avatar</label>
                  <input
                    type="file"
                    accept="image/*"
                    name="avatar"
                    required
                  />
                </div>
                <div
                  class="d-flex flex-row align-items-center justify-content-between"
                >
                  <span
                    >Already registered ? <a href="login.php">Login</a></span
                  >
                  <button class="btn btn-primary" type="submit" name="submit">Create Account</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
