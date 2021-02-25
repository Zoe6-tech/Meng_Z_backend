<?php
require_once '../load.php';

$ip = $_SERVER['REMOTE_ADDR'];//"REMOTE_ADDR" => The IP address from which the user is viewing the current page.
//we want get the value $ip, and add it in login() as the third parameter

//gain username and password, empty check
if(isset($_POST['submit'])){
    $username = trim($_POST['username']);
    $password = trim($_POST['password']); //The trim() function removes whitespace and other predefined characters from both sides of a string.
    
    
    if(!empty($username) && !empty($password)){//if username and password both not empty
        $result = login($username, $password, $ip);//allow login, login function in login.php
        $message = $result;
    }else{
        redirect_to('admin_login.php');
        // echo "<br />\n";
        // $message = 'Plesase fill out the request field';
    }
}

//Account complete lockout after 3 failed login attempts.
//   $_SESSION['login_attempts'] = isset($_SESSION['login_attempts']) ? ($_SESSION['login_attempts'] + 1) : 0;
//   // do checking on number of attempts
//   if ($_SESSION['login_attempts'] > 5)
//   {
//     echo "Login failure: Maximum login attempts was exceeded !";
//     echo "<br />\n"; 
//     echo " * Your IP is locked by server due to repeatedly fails logins. If you have any questions, please contact administrator.";
//     echo "<br />\n"; 
//     //echo "Please wait 30 seconds...";
    
//     die();
//   }


//if user already log in, redirect user to welcome.php, dont allow login in user access admin_login.php again
if(isset($_SESSION['user_id'])){
    redirect_to('index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../public/css/main.css">
    <link rel="stylesheet" type="text/css"  href="../public/css/reset.css">
    <title>Welcome to the admin panel</title>
</head>
<body>
    <section class="login_area">
            <div class="logo_area">
                <img class="logo" src="../public/images/LRG_logo.svg" alt="LRG_logo">
                <h2>Welcome login</h2>
                <h2>London Referees Group </h2>
            </div>

            <div class="login_form_area">
                <?php echo !empty($message)?$message:'';?>
                <h3>LOGIN TO YOUR ACCOUNT</h3>
                <div class="login_form">
                    <form action="admin_login.php" method="post">
                    <!-- <label for="username">Username:</label> -->
                    <input id="username" type="text" name="username" value="" placeholder="USERNAME: admin">
                    
                    <!-- <label for="password">Password:</label> -->
                    <input id="password" type="text" name="password" value="" placeholder="PASSWORD: admin123">
                    
                    <button type="submit" name="submit">LOGIN</button>
                    <!-- <h4>* Login Attempt: <?php echo $_SESSION['login_attempts']; ?> </h4> -->
                        <!-- <h5>Account will complete lockout after you 3 failed login attempts, please be careful ！！！</h5> -->
                    </form>
                </div>
            </div>
    </section>
</body>
</html>