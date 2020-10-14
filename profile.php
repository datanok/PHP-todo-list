<?php
require_once('dbconnection.php');
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

} else {
  $_SESSION['message'] = "Please Log in First";

    header("location: login.php?error=pleaselogin");
}
if(isset($_POST['submit'])) {

 $newusername =$mysqli->real_escape_string($_POST['username']);
$username = $_SESSION['username'];
$query = "UPDATE users SET username='$newusername' WHERE username='$username';";
$query .= "UPDATE todo SET username='$newusername' WHERE username='$username'";
$result = mysqli_multi_query($mysqli, $query);
    if($result){

        $_SESSION['message'] = "Username Updated";
        $_SESSION['username'] = "$newusername";
    }else{
        echo mysqli_error($mysqli);
    }
    mysqli_close($mysqli);
 }
 $username = $_SESSION['username'];
 $query = "SELECT username, COUNT(*) as total FROM todo WHERE username='$username' ";
 $result = mysqli_query($mysqli, $query);
 $count = mysqli_fetch_assoc($result);

 ?>
<html>
<head>
 <title>Profile</title>

 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
 <link href="css/profile.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
</head>
<body>
<?php include 'index.php' ?>

<main>
    <?php if (isset($_SESSION['message'])) {
  echo '<div class="alert alert-success alert-dismissible" fade show" data-dismiss="alert"><i class="fa fa-check" aria-hidden="true"></i>'. $_SESSION['message'] .'</div>';
  unset($_SESSION['message']);
      }; ?>
<div class="gborder">
  <div class="card col-sm-12 col-md-8 col-lg-4 mx-auto my-auto">
      <img src='<?=$_SESSION['avatar']?>' alt="" class="image">
        <div class="trick">
        </div>

      <ul class="text"><?= $_SESSION['username'];?></ul>

<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <div class="panel panel-default">
    <div class="panel-heading " role="tab" id="headingOne">
      <h4 class="panel-title ">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="" aria-controls="collapseOne">
          <div class="title  btn btn-danger btn-outline btn-lg">INFO</div>
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
        <div class="info">
        <label for="email">Email: </label><span class="info-val"><?=$_SESSION['email'];?></span><br>
        <label for="email">Active Tasks: </label><span class="info-val"> <?php echo $count['total']; ?></span>
      </div>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingThree">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          <div class="title btn btn-danger btn-outline btn-lg">Edit Username</div>
        </a>
      </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
      <div class="panel-body">
            <form id="form" class="topBefore" action="profile.php" method="post">
            <div class="form__group field">
               <input name="username" class="form__field" type="text" placeholder="Name">
               <label for="name" class="form__label">Name</label>
               <br>
               <input type="submit" name="submit" value="Update" class="sub-btn mx-auto">
            </div>


          </form>
      </div>
    </div>
  </div>
</div>

</div>
</div>
</main>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js">
</script>
<script type="text/javascript" src="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js">

</script>

</script>
</body>
</html>
