<?
    require_once("core/controller.php");
   
    if(isset($_REQUEST['deleteThis']))
    {
        $id = $_GET['itemId'];
        $controller->DeleteTovar('product',$id);
    }


?>

    <div class="container">

        <form action="" class="addTovars">
            <input type="text" name='title'>
            <input type="text" name='price'>
            <input type="submit" name='addTovar' value="добавить товар">
        </form>

        <div class="menu">
            <div class="menu__item"><a href="?selectAllTovars">Все</a></div>
            <div class="menu__item"><a href="?selectAllDeletedTovars">Удаленные</a></div>
            <div class="menu__item"><a href="javascript:return false" id="callForm">Добавить товар</a></div>
            <div class="menu__item"><a href=""></a></div> 
        </div>


    

   <div class='container-tovars'>
        <?$products = $controller->selectAllDeletedTovars('product');?>
        <? while(($product = mysqli_fetch_assoc($products))): ?>
            <div class='container-tovars__item'>
                <h1><?=$product['title']?></h1>
                    <p><?=$product['price']?> RUB</p>
                    <p> Дата создания: <?=$product['created_at']?></p>
                    <p> Дата обновления: <?=$product['updated_at']?></p>
                    <p> Дата удаления: <?=$product['deleted_at']?></p>
                    <form action="" method='POST'>
                        <input type="hidden" name="itemId" value=<?=$product['id']?>>
                        <input type="submit" name="deleteThis" value="deleted">
                    </form>
            </div>
        <?endwhile;?>


        <?$productsDeleted = $controller->selectAllTovars('product');?>
        <? while(($product = mysqli_fetch_assoc($productsDeleted))): ?>           
            <div class='container-tovars__item'>
                <h1><?=$product['title']?></h1>
                <p><?=$product['price']?> RUB</p>
                <p> Дата создания: <?=$product['created_at']?></p>
                <p> Дата обновления: <?=$product['updated_at']?></p>
                <p> Дата удаления: <?=$product['deleted_at']?></p>
                <form action="" method='GET'>
                    <input type="hidden" name="itemId" value=<?=$product['id']?>>
                    <input type="submit" name="deleteThis" value="deleted">
                </form>
            </div>
        <?endwhile;?>
    </div>

   
   
    
</div>