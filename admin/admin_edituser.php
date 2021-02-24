<?php
require_once '../load.php';

//make sure this page only access to 
confirm_logged_in();

$id = $_SESSION['user_id'];//define in login.php
$current_user = getSingleUser($id);//function in user.php

if(empty($current_user)){//is user doesnt exist
    $message = 'failed to get user info';
}

// when user click submit
if(isset($_POST['submit'])){
    $data = array(
        'fname'      => trim($_POST['fname']),
        'lname'      => trim($_POST['lname']),
        'username'   => trim($_POST['username']),
        'password'   => trim($_POST['password']),
        'email'      => trim($_POST['email']),
        'user_level' => isCurrentUserAdminAbove()?trim($_POST['user_level']):'0',
        'id'         => $id,//update a exist user so need id
    );
    
  $message = editUser($data);//update user info to database
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>
<body>
    <h2>Edit User</h2>
    <?php echo !empty($message)?$message:'';?>
        <?php if(!empty($current_user)):?>
            <form action="admin_edituser.php" method="post">
                <?php while($user_info = $current_user -> fetch(PDO::FETCH_ASSOC)):?><!--user_info: table columns name-->
                    
                    <label for="user_name">User Name:</label><br>
                    <input type="text" name="username"  id="user_name" placeholder="enter user name" value="<?php echo $user_info['user_name']; ?>">
                    <br><br>
                    
                    <label for="first_name">First Name:</label><br>
                    <input type="text" name="fname"  id="first_name" placeholder="enter first name" value="<?php echo $user_info['user_fname']; ?>"> 
                    <br><br>

                    <label for="last_name">Last Name:</label><br>
                    <input type="text" name="lname"  id="last_name" placeholder="enter last name" value="<?php echo $user_info['user_lname']; ?>">
                    <br><br>

                    <label for="password">Password:</label><br>
                    <input type="text" name="password"  id="password" placeholder="auto generated by system" value="<?php echo $user_info['user_password']; ?>">
                    <br><br>

                    <label for="email">Email:</label><br>
                    <input type="email" name="email"  id="email" placeholder="enter email" value="<?php echo $user_info['user_email']; ?>">
                    <br><br>

                    
                    <?php if(isCurrentUserAdminAbove()):?>
                        <label for="user_level">User Level:</label><br>
                        <select  name="user_level"  id="user_level" >
                            <?php  $user_level_map = getUserLevelMap();
                            foreach($user_level_map as $val => $label): ?>
                            <option value="<?php echo $val;?>"<?php echo $val ===(int)$user_info['user_level']?'selected':'';?>><?php echo $label;?></option>   
                            <?php endforeach;?>
                        </select><br><br>
                    <?php endif;?>

                    <button  class="subimt-createuser" type="submit" name="submit">Submit</button>
                    <a href="index.php">Back</a><br>

                <?php endwhile;?>
            </form>
        <?php endif;?>
</body>
</html>