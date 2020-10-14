<?php
require_once('dbconnection.php');
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

} else {
  $_SESSION['message'] = "Please Log in First";

    header("location: login.php?error=pleaselogin");
}
if(isset($_POST['delete'])){
  $id = $_POST['id'];
  mysqli_query($mysqli, "DELETE FROM todo WHERE id=$id");
} ?>
<html>
<head>
 <title>my todos</title>

 <link href='https://css.gg/trash.css' rel='stylesheet'>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
 <link href="lst.css" rel="stylesheet">

</head>
<body>
<?php include 'index.php' ?>

  <main>
  <div class="container">
  <div class="float-right" id="addbtn">
<a href="test.php" id="add"><i class="fas fa-plus"></i> Add</a>
</div>
    <table class="table table-hover table-dark" >
      <thead class="thead-dark">
        <tr>
          <th>Title</th>
          <th>Description</th>
          <th>Date</th>
          <th>Edit</th>
        </tr>
      </thead>
      <tbody>
  <?php
$username = $_SESSION['username'];
$query = "SELECT id, todoTitle, todoDescription, date FROM todo WHERE username='$username' ";
$result = mysqli_query($mysqli, $query);
//check if there's any data inside the table
if(mysqli_num_rows($result) >= 1){
 while($row = mysqli_fetch_array($result)){
 $id = $row['id'];
 $title = $row['todoTitle'];
 $desc = $row['todoDescription'];
 $date = $row['date'];
 echo '<tr id="'.$id.'">
 <td>'.$title.'</td>
 <td>'.$desc.'</td>
 <td>'.$date.'</td>
 <td>
 <form method="POST">
                        <button type="submit" class="btn" name="delete"><i class="gg-trash"></i></button>
                        <input type="hidden" name="id" value="'.$id.'">
                        <input type="hidden" name="delete" value="true">
                    </form>
</td>

</tr>';
 }
}
?>
      </tbody>
    </table>
  </div>
</main>

</body>
</html>
