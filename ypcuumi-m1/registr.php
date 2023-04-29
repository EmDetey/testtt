<?php 
   
   require_once("header.php");

   if(isset($_REQUEST['registr-submit']))
   {
        
        $name = trim($_POST['name']);
        $sername = trim($_POST['sername']);
        $lastname = trim($_POST['lastname']);
        $email = trim($_POST['email']);
        $telephone = trim($_POST['tel']);
        $login = trim($_POST['login']);
        $password = trim($_POST['password']);
        $errors = [];

        if(trim($_POST['password-rep']) !== $password)
        {
            $errors[] = "пароли не совпадают";
        }
        
        if(UsersRepeat($connect,$login) != 0)
        {
            $errors[] = "пользователь уже существует";
        }

        if(empty($errors))
            CreateNewUser(
                $connect,
                $name,
                $sername,
                $lastname,
                $email,
                $password,
                $login,
                $telephone
            );
          header("location: /");
   }
?>

    <div class="container">
        <div class="title">
            <h1>Регистрация</h1>
        </div>

        <div class="error-alerts">
        
        </div>

        <div class="registr-container">
            <?php if(isset($_REQUEST['registr-submit']) && !empty($errors)): ?>
                
                <ul>
                    <?=ErrorsPrint($errors)."<br>" ?>
                </ul>

                
            <?php endif ?>    
            <form action="" method="post">
                <input type="text" name='name' placeholder="имя">
                <input type="text" name='sername' placeholder="фамилия">
                <input type="text" name='lastname' placeholder="отчество">
                <input type="email" name='email' placeholder="email">
                <input type="tel" name='tel' placeholder="номер телефона">
                <input type="text" name='login' placeholder="логин">
                <input type="password" name='password' placeholder="пароль">
                <input type="password" name='password-rep' placeholder="повторите пароль">
                <input type="submit" name='registr-submit'>
            </form>
        </div>
    </div>

<?php 
    require_once("footer.php");
?>
