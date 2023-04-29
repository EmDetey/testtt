<?php require_once("header.php"); ?>

    <div class="container">
        <div class="wrapper">
            <div class="products">
                <?php 
                $products = mysqli_query($connect, "SELECT * FROM `product`" );
                while(($product = mysqli_fetch_assoc($products))):
                ?>
                    <div class="product">
                        <img class='tovarImg' src=<?=$product['img']?> alt=<?=$product['title']?>>
                        <div class="product__section">
                            <h1><?=$product['title']?></h1>
                            <form action="">
                                <input type="hidden" name="product_id" value=<?=$product['id']?>>
                                <input type="hidden" name="product_count">
                                <p class="counter-product"></p>
                                <div class="counter_plus counter" >+</div>
                                <button type="submit" name="buscket"><?=$product['price'] ?>Руб.</button>
                                <div class="counter_minus counter">-</div>
                                
                            </form>
                            
                        </div>
                    
                        

                    </div>

                <?php endwhile;  ?> 
            </div>
        </div>   
    </div>

<?php require_once("footer.php"); ?>