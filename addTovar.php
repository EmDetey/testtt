<?php 

    require_once("core/controller.php");
    $errors = [];
    $id = trim($_POST['id']);
   // $price = trim($_POST['price']);
    //$descripttion = "some text";
    $date = date('Y-m-d');
   
  
    
    if(empty($errors)){
        $controller->DeleteTovar('products',$id);
    }
    
    