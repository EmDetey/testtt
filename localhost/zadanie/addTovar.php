<?php 

    require_once("core/controller.php");
    $errors = [];
    $title = trim($_POST['title']);
    $price = trim($_POST['price']);
    //$descripttion = "some text";
    $date = date('Y-m-d');
   
    $data = [1,$title,$price,$date];
    if(empty($title) || empty($price))
        $errors [] = "заполните все поля";
    if(empty($errors)){
        $controller->AddNewTovar('products',$data);
    }
    
    