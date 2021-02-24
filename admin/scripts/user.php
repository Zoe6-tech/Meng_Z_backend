<?php


//drop down menu
function getUserLevelMap(){
    return array(
        '0' => 'Member',
        '1' => 'Admin',
        '2' => 'Super Admin',
        
    );
}

//display user level on dashboard
function getCurrentUserLevel(){
    $user_level_map = getUserLevelMap();
    if(isset($_SESSION['user_level']) && array_key_exists($_SESSION['user_level'], $user_level_map)){
        // array_key_exists will check $_SESSION['user_level'] whether exist in array $user_level_map for not
        return $user_level_map[$_SESSION['user_level']];
    }else{
        return "unrecognized";
    }
}

//insert new user info in database
function createUser($user_data){
    ##testing only, remove it later
    // return var_export($user_data, true);
    $pdo = Database::getInstance() -> getConnection();

    $create_user_query = 'INSERT INTO tbl_users(user_fname, user_lname, user_name, user_password, user_email, user_level)';
    $create_user_query .= ' VALUE(:fname, :lname, :username, :password, :email, :user_level) '; //use placeholder prevent SQL injection

  
    //return $create_user_query;
    
    
    ## 1. Run the proper SQL query, insert user into tbl_user
    $create_user_set = $pdo -> prepare($create_user_query);
    $create_user_result = $create_user_set -> execute(
        array(
            ':fname' => $user_data['fname'],
            ':lname' => $user_data['lname'],
            ':username' => $user_data['username'],
            ':password' => $user_data['password'],
            ':email' => $user_data['email'],
            ':user_level' =>$user_data['user_level'],
        )
    );



    ## 2. Redirect to index.php if create user successfully, mayber leave some message to user? 
    ## Otherwise, showing error message
    if($create_user_result){
        redirect_to('admin_createsuccess.php');
    }else{
        return 'The user did not go through!!!';
    }
}

function getSingleUser($user_id){
     echo 'you are try to fetch user :'.$user_id;
    $pdo = Database::getInstance() -> getConnection();

    $get_user_query = 'SELECT * FROM tbl_users WHERE user_id = :id';//SQL placeholder to aviod SQL injection
    $get_user_set = $pdo ->prepare($get_user_query);
    $get_user_result = $get_user_set -> execute(
        array(
            ':id' => $user_id
        )
        );

    if($get_user_result && $get_user_set ->rowCount()){
        return $get_user_set;
    }else{
        return false;
    }
}


