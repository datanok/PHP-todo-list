<?php
require 'dbconnection.php';
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

} else {
  $_SESSION['message'] = "Please Log in First";

    header("location: login.php?error=pleaselogin");
}

if(isset($_POST['submit'])) {
 $title =$mysqli->real_escape_string($_POST['todoTitle']);
$description = $mysqli->real_escape_string($_POST['todoDescription']);
$username = $_SESSION['username'];
$query = "INSERT INTO todo(todoTitle, todoDescription, date, username)     VALUES ('$title', '$description', now() , '$username')";
$insertTodo = mysqli_query($mysqli, $query);
    if($insertTodo){
        $_SESSION['message'] = "Task Added";
    }else{
        echo mysqli_error($mysqli);
    }
    mysqli_close($mysqli);
 }

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add Tasks</title>
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
      integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z"
      crossorigin="anonymous"
    />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/addTasks.css">
  </head>

  <body>
  <?php include 'index.php' ?>
 <main>
  <h1>Add Tasks</h1>
<form method="post" action="addTasks.php">
  <div class="card col-sm-10 col-md-8 col-lg-6 mx-auto">
    <?php if (isset($_SESSION['message'])) {

    echo '<div class="alert alert-success alert-dismissible" data-dismiss="alert">' . $_SESSION['message'] . '</div>';
    unset($_SESSION['message']);
        }; ?>
<div class="form__group field">
   <input name="todoTitle" class="form__field" type="text" placeholder="Title">
   <label for="name" class="form__label">Title</label>
</div>

  <div class="form__group field">
    <textarea name="todoDescription" rows="4" cols="80" class="form__field" type="text" placeholder="Description"></textarea>
      <label for="name" class="form__label">Description</label>
</div>

 <br>
 <input type="submit" name="submit" value="submit" class="sub-btn">
 </div>
</form>
