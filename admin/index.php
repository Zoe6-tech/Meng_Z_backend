<?php
require_once '../load.php';
confirm_logged_in();//only login in user can see the index.php page


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Page</title>
</head>
<body>
    <h2>Hello <?php echo $_SESSION['user_name'];?>! Welcome To Our Page. </h2>
    <h4>IP address:  <?php echo $_SESSION['user_ip']?></h4>
    <h4>Last Login Time: <?php echo $_SESSION['last_login']; ?></h4>
    <h4>Number of Successful Login: <?php echo $_SESSION['login_times'];?></h4>

    <h3>You are in level: <?php echo getCurrentUserLevel();?></h3>
    <?php if(!empty($_SESSION['user_level'])):?>
    <a href="admin_createuser.php">Create User</a>
    <?php endif;?>

    <a href="admin_edituser.php">Edit User</a>
    <a href="admin_logout.php">Sign Out</a>
    
</body>
</html>