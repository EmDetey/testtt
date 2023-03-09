<?php
   $id = $params->get('id');   
   $lazyload = $params->get('lazyload');
$module_params = json_decode($module->params);
$module_sfx = $module_params->moduleclass_sfx;
?>

<div class="rand_products_itb module<?=$module_sfx; ?>" id="rand_products_itb_<?php echo $module->id;?>">


    <?php
    foreach($rows as $prod):
        $alt=$prod->name;
        $catlink = SEFLink('index.php?option=com_jshopping&view=category&layout=category&task=view&category_id='.$prod->category_id, 1);
        if (!$prod->product_ean == null){
            $description = explode('|', $prod->product_ean);
            $desc_srok = ($description[0]);
            $desc_mesta = ($description[1]);
            $desc_zhdet = explode('~', $description[2]);
            $daysAll = explode('~', $desc_srok);
            if ($lang == 'ru-RU') {
                $desc_days = $daysAll[0];
                $desc_zhdet = $desc_zhdet[0];
            } else if ($lang == 'en-GB') {
                $desc_days = $daysAll[1];
                $desc_zhdet = $desc_zhdet[1];
            }
        }
        if($product_source == 'manuf_logo'){
            $prodLink = SEFLink('index.php?option=com_jshopping&controller=manufacturer&task=view&manufacturer_id='.$prod->manufacturer_id, 1);
            $imgSrc = $jshopConfig->image_manufs_live_path."/".$prod->manufacturer_logo;
        }
        else{
            $prodLink = SEFLink('index.php?option=com_jshopping&controller=product&task=view&category_id='.$prod->category_id.'&product_id='.$prod->product_id, 1);
            $buyLink = SEFLink('index.php?option=com_jshopping&controller=cart&task=add&category_id='.$prod->category_id.'&product_id='.$prod->product_id, 1);
            $fullImg = $jshopConfig->image_product_live_path."/".str_replace('thumb','full',$prod->product_thumb_image);
            $imgSrc = $jshopConfig->image_product_live_path."/".str_replace('thumb_','',$prod->product_thumb_image);
        } ?>

        <div class="product-item" onclick="location.href='<?=$prodLink ?>'">
            <div class="product-item-wrap">
                <div class="item-top-block">
                    <div class="item-back-image">
                        <img src="<?=$imgSrc ?>" alt="<?=$prod->name ?>" title="<?=$prod->name ?>"/>
                    </div>
                    <div class="item-labels">
                        <?php if($skidka):?>
                            <div class="label-discont">-5%</div>
                        <?php endif; ?>
                        <?php if($prod->_label_image):?>
                            <div class="label-hit">Хит продаж</div>
                        <?php endif; ?>
                    </div>
                    <div class="item-price">
                        <?php if($prod->product_old_price):?>
                            <div class="old_pricewrap">
                                <!--<?=formatprice($prod->product_old_price,null,1);?>-->
								<span class="label_price">Цена: </span><?php echo $prod->product_old_price;?> <i class="rub">i</i> 
                            </div>
                        <?php endif; ?>
                        <?php if($prod->product_price):?>
                            <div class="main_pricewrap">
								<span class="label_price">Цена: </span><?php echo $prod->product_price;?><i class="rub">i</i> 
                                <!--<?=formatprice($prod->product_price,null,1);?>-->
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="item-bottom-block">
                    <div class="item-bottom-inner">
                        <div class="item-title">
                            
                                <?=$prod->name; ?>
                          
                        </div>
                        <!--<div class="item-days"><i class="far fa-calendar-alt"></i><?=$desc_days; ?></div>-->
                        <div class="item-desc">
                            <?php if($desc_zhdet):?>
                                <?=$desc_zhdet;?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="item-more-link">
                    <a class="item-more" href="<?=$prodLink ?>">Подробнее</a>
                </div>
            </div>
        </div>

    <?php endforeach; ?>

</div>

<!--<div id="owl-demo<?php echo $id;?>" class="owl-carousel owl-theme">

<?php foreach($rows as $product){ ?>
	<div class="item">
	

		<?php if ($show_image && $product->image){// option modul  show_image ?>
		<div class="image">
			<div class="image_block">
				<?php print $product->_tmp_var_image_block;?>
					<?php if($product->label_id && $show_image_label){?>		
					<div class="product_label">
						<?php if($product->_label_image){?>
							<img src="<?php print $product->_label_image?>" alt="<?php print htmlspecialchars($product->_label_name)?>" />
						<?php }else{?>
						<span class="label_name">
							<?php print $product->_label_name;?>
						</span>
						<?php }?>						 
					</div>
					<?php }?>
				<a href="<?php print $product->product_link?>">
					<img class="jshop_img owl-lazy" data-src="<?php print $product->image ? $product->image : $noimage;?>" alt="<?php print htmlspecialchars($product->name);?>" />
				</a>
			</div>
		</div>
		<?php } ?>

		
		<?php if($allow_review){	// option modul allow_review ?>
		<table class="review_mark">
			<tr>
				<td>
					<?php print showMarkStar($product->average_rating);?>
				</td>
			</tr>
		</table>
		<div class="count_commentar">
			<?php print sprintf(_JSHOP_X_COMENTAR, $product->reviews_count);?>
		</div>
		<?php } ?>

		<?php print $product->_tmp_var_bottom_foto;?>		
		<div class="name">
            <a href="<?php print $product->product_link?>"><?php print $product->name?></a>
        </div>
		
		<?php if($short_description){	// option modul short_description ?>		
		 <div class="description">
            <?php print $product->short_description?>
        </div>
		<?php } ?>

		<?php if ($product->manufacturer->name && $manufacturer_name){// option modul manufacturer_name ?>
        <div class="manufacturer_name">
			<?php print _JSHOP_MANUFACTURER;?>: 
			<span>
				<?php print $product->manufacturer->name?>
			</span>
		</div>
		<?php }?>

		<?php if ($product->product_quantity <=0 && !$jshopConfig->hide_text_product_not_available && $product_quantity){// option modul product_quantity?>
		<div class="not_available">
			<?php print _JSHOP_PRODUCT_NOT_AVAILABLE;?>
		</div>
		<?php }?>

		<?php if( $product_old_price){?>
		<?php if ($product->product_old_price > 0){// option modul product_old_price?>
			<div class="old_price">
				<?php if ($jshopConfig->product_list_show_price_description) print _JSHOP_OLD_PRICE.": ";?>
				<span><?php print formatprice($product->product_old_price)?></span>
			</div>
		<?php }?>
		<?php print $product->_tmp_var_bottom_old_price;?>
		<?php }?>

		<?php if ($product->product_price_default > 0 && $jshopConfig->product_list_show_price_default && $product_price_default){ // option modul product_price_default?>
        <div class="default_price">
			<?php print _JSHOP_DEFAULT_PRICE.": ";?>
			<span>
				<?php print formatprice($product->product_price_default)?>
			</span>
		</div>
		<?php }?>

		<?php if($display_price){?>
		<?php if ($product->_display_price){// option modul display_price?>
		<div class = "jshop_price">
			<?php if ($jshopConfig->product_list_show_price_description) print _JSHOP_PRICE.": ";?>
			<?php if ($product->show_price_from) print _JSHOP_FROM." ";?>
			<span><?php print formatprice($product->product_price);?></span>
		</div>
		<?php }?>
		<?php 	print $product->_tmp_var_bottom_price;?>
		<?php }?>

		<?php if ($jshopConfig->show_tax_in_product && $product->tax > 0 && $show_tax_product){// option modul show_tax_product?>
		<span class="taxinfo"><?php print productTaxInfo($product->tax);?></span>
		<?php }?>

		<?php if ($jshopConfig->show_plus_shipping_in_product && $show_plus_shipping_in_product){?>
        <span class="plusshippinginfo"><?php print sprintf(_JSHOP_PLUS_SHIPPING, $shippinginfo);?></span>
		<?php }?>

		<?php if ($product->basic_price_info['price_show'] && $basic_price_info){// option modul basic_price_info?>
		<div class="base_price"><?php print _JSHOP_BASIC_PRICE?>: <?php if ($product->show_price_from) print _JSHOP_FROM;?> <span><?php print formatprice($product->basic_price_info['basic_price'])?> / <?php print $product->basic_price_info['name'];?></span></div>
		<?php }?>

		<?php if ($jshopConfig->product_list_show_weight && $product->product_weight > 0 && $product_weight){// option modul product_weight?>
        <div class="productweight"><?php print _JSHOP_WEIGHT?>: <span><?php print formatweight($product->product_weight)?></span></div>
		<?php }?>

		<?php if ($product->delivery_time != '' && $delivery_time){// option modul delivery_time?>
            <div class="deliverytime"><?php print _JSHOP_DELIVERY_TIME?>: <span><?php print $product->delivery_time?></span></div>
		<?php }?>

		<?php if (is_array($product->extra_field) && $extra_field){// option modul extra_field?>
		<div class="extra_fields">
		<?php foreach($product->extra_field as $extra_field){?>
			<div><?php print $extra_field['name'];?>: <?php print $extra_field['value']; ?></div>
		<?php }?>
		</div>
		<?php }?>

		<?php if ($product->vendor && $vendor){// option modul vendor?>
        <div class="vendorinfo"><?php print _JSHOP_VENDOR?>: <a href="<?php print $product->vendor->products?>"><?php print $product->vendor->shop_name?></a></div>
		<?php }?>

		<?php if ($jshopConfig->product_list_show_qty_stock && $product_list_qty_stock){// option modul product_list_qty_stock?>
            <div class="qty_in_stock"><?php print _JSHOP_QTY_IN_STOCK?>: <span><?php print sprintQtyInStock($product->qty_in_stock)?></span></div>
		<?php }?>

		<?php if($show_button){?>
		<?php print $product->_tmp_var_top_buttons;?>
        <div class="buttons">
		<?php if ($product->buy_link && $show_button_buy){?>
            <a class="button_buy" href="<?php print $product->buy_link?>"><?php print _JSHOP_BUY?></a> &nbsp;
		<?php }?>
		<?php if ($show_button_detal){?>
            <a class="button_detail" href="<?php print $product->product_link?>"><?php print _JSHOP_DETAIL?></a>
		<?php }?>
		<?php print $product->_tmp_var_buttons;?>
        </div>		
		<?php print $product->_tmp_var_bottom_buttons;?>
		<?php	}?>
		
	</div>
<?php } ?>

</div>










<script>
        jQuery(document).ready(function(){
          jQuery(".owl-carousel").owlCarousel({
            nav: false,
			dots: false,
			lazyLoad : true,
            // smartSpeed:1000,
            navText: [ '<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>' ],
            responsive:{
            	320:{
                    items:1,
                    nav:false
                },
     			480:{
                    items:2,
                    nav:false
                },
                600:{
                    items:3,
                    nav:false
                },
                1000:{
                    items:3,
                    nav:false,
                    loop:false
                }
            }
        });
      });
    </script>
-->