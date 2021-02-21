<?php

function createUser($user_data){
    ##testing only, remove it later
    // return var_export($user_data, true);
    $pdo = Database::getInstance() -> getConnection();

    $create_user_query = 'INSERT INTO tbl_users(user_fname, user_lname, user_name, user_password, user_email)';
    $create_user_query .= ' VALUE(:fname, :lname, :username, :password, :email) '; //use placeholder prevent SQL injection

  
    //return $create_user_query;
    
    
    ## 1. Run the proper SQL query, insert user into tbl_user
    $create_user_set = $pdo -> prepare($create_user_query);
    $create_user_result = $create_user_set -> execute(
        array(
            'fname' => $user_data['fname'],
            'lname' => $user_data['lname'],
            'username' => $user_data['username'],
            'password' => $user_data['password'],
            'email' => $user_data['email'],
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

