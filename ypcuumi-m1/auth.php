<?php 
    require_once("header.php");

    if(isset($_REQUEST['registr-submit']))
   {
        
        
        $login = trim($_POST['login']);
        $password = trim($_POST['password']);
        $errors = [];

        if(UsersRepeat($connect, $login, $password, true) == 0)
        {
            CreateUserSession($connect,$login,$password);
            header("location: /");
        }
        
   }

?>

<div class="container">
        <div class="title">
            <h1>Авторизация</h1>
        </div>

        <div class="error-alerts">
        
        </div>

        <div class="registr-container">
            <?php if(isset($_REQUEST['auth-submit']) && !empty($errors)): ?>
                
                <ul>
                    <?=ErrorsPrint($errors)."<br>" ?>
                </ul>

                
            <?php endif ?>    
            <form action="" method="post">
                
                <input type="text" name='login' placeholder="логин">
                <input type="password" name='password' placeholder="пароль">
                
                <input type="submit" name='auth-submit'>
            </form>
        </div>
    </div>

<?php 
    require_once("footer.php");
?>
