<?php

require "dataBroker.php";
require "model2/admin.php";

session_start();
if(isset($_POST['username']) && isset($_POST['password'])){
    $uname = $_POST['username'];
    $upass = $_POST['password'];

   
    $admin = new Admin(1, $uname, $upass);
    $odg = Admin::logAdmin($admin, $conn);

    if($odg->num_rows==1){
        ?>
        <script>
        console.log( "Uspešno ste se prijavili");
        alert("Uspešna prijava");
        </script>
        <?php
        $_SESSION['admin_id'] = $admin->id;
        header('Location: home2.php');
        exit();
    }else{
        ?>
        <script>
        console.log( "Niste se prijavili!");
        alert("Neuspešna prijava");
        </script>
        <?php
    }

}

?>

<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="css/indexstyle.css">
  </head>
  <body>
    <div class="login-form">
      <form  method="POST" action="#">
        <h2>Login</h2>
        <div class="form-group">
          <label for="username">Username:</label>
          <input type="text" id="username" name="username">
        </div>
        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" id="password" name="password">
        </div>
        <button type="submit">Submit</button>
      </form>
    </div>
  </body>
</html>