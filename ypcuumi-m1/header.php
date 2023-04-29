<?php
require_once("functions.php");
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
<?=GetConnectStatus($connect);?>
<header>
    <div class="header-wrapper">
        <div class="logotype">
            <a href=""><h1>
                True<span>Games</span> 
            </h1></a>
        </div>
        <div class="menu">
            <a href="">О нас</a>
            <a href="catalog.php">Каталог</a>
            <?php if(empty($_SESSION)): ?>
                <a href="registr.php">Регистрация</a>
                <a href="auth.php">войти</a>
            <?php endif ?>
        </div>
    </div>
</header>