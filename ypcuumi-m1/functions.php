<?php 
    session_start();
 const HOST ="localhost";
 const USER ="urfmjmba";
 const PASSWORD = "kc7eba";
 const DATABASE = "urfmjmba_m1";


   
 $connect = mysqli_connect(HOST,USER,PASSWORD,DATABASE);
     

     function GetConnectStatus($connect){
        if($connect === false)
            return "error connect to database";
           
    }

    

     function CreateNewUser($connect,$name,$sername,$lastname,$email,$password,$login,$telephone)
    {
        mysqli_query($connect, "INSERT INTO `users` (`name`,
        `surname`,
        `lastname`,
        `email`,
        `passwords`,
        `login`,
        `telephone`)
         VALUES
         ('$name',
           ' $sername',
         '$lastname',
         '$email',
         '$password',
         '$login',
         '$telephone'
          ) ");
    }



    function UsersRepeat($connect,$row,$row_pass=null, $auth=false)
    {
        if($auth == false){
        $row_pass = null;
        $users = mysqli_query($connect,"SELECT * FROM `users` WHERE '$row' = `login`");
        return mysqli_num_rows($users);
        }
        else{
            $users = mysqli_query($connect,"SELECT * FROM `users` WHERE '$row' = `login` AND '$row_pass' = `passwords` ");
            return mysqli_num_rows($users);
        }
    }

    function CreateUserSession($connect, $login, $password)
    {
        $user = mysqli_query($connect, "SELECT * FROM `users` WHERE '$login' = `login` AND '$password' = `passwords` ");
        $user = mysqli_fetch_assoc($user);
        $_SESSION['user-id'] = $user['id'];
        $_SESSION['login'] = $login;
        
    }

    function ErrorsPrint($errors)
    {
        
        foreach($errors as $error)
            return "<p>".$error."</p>";
    }



   

    

    
