
<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

} else {
  $_SESSION['message'] = "Please Log in First";

    header("location: login.php?error=pleaselogin");
}

 ?>
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1" />
     <link rel="stylesheet" href="css/welcome.css">
     <title>Home</title>
   </head>
   <body>
     <?php include 'index.php' ?>
     <?php
     $showDivFlag=false;
     if (isset($_SESSION['message'])) {
        $showDivFlag=true;
     } ?>
     <br>
     <main>
         <div class="alert" <?php if ($showDivFlag===false){?>style="display:none"<?php } ?>>
           <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
           <strong>Success!</strong>
           <?php
              echo $_SESSION['message'];
              unset($_SESSION['message']);
              $showDivFlag=false;
            ?>
     </div>
     <div class="wel-msg">
     <div class="wel">
       <h1 class="sub flux">Welcome</h1>
     </div>
     <div id="wrapper">
	<h1 class="glitch" data-text="<?=$_SESSION['username']?>"><?=$_SESSION['username']?></h1>
 	</div>
  <div>
      </main>

   </body>
 </html>
