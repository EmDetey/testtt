<?php
# $Id: default.php
# package mod_jshopping_products_itb
# file default.php
# license http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
defined('_JEXEC') or die('Restricted access');
$document = JFactory::getDocument();
//$document->addStyleSheet(JURI::base().'modules/mod_jshopping_products_itb/itbstyle.css');
$lang = JFactory::getLanguage()->getTag();

if($ribbon_behavior == 'scroll'){
    $suff = ($ribbon_orientation == 'hor')?"horizontal":'vertical';
}
else{
    $suff = "static";
}
?>
<?
$module_params = json_decode($module->params);
$module_sfx = $module_params->moduleclass_sfx;

$orient = $module_params->ribbon_orientation;
?>
<?php if($title_module){
    echo '<div class="col main-title-max">'.$title_module.'</div>';
}?>
    <div class="rand_products_itb_<?php echo $suff; ?> module<?=$module_sfx; ?> <?=$orient; ?>" id="rand_products_itb_<?php echo $module->id;?>">


        <?php
        foreach($list as $prod):
            $alt=$prod->name;
            $catlink = SEFLink('index.php?option=com_jshopping&view=category&layout=category&task=view&category_id='.$prod->category_id, 1);
            if (!$prod->product_ean == null){
                $description = explode('|', $prod->product_ean);
                $desc_srok = ($description[0]);
                $desc_mesta = ($description[1]);
                $desc_zhdet = explode('~', $description[2]);;
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
                            <?php if(in_array('add_label',$additional_params) && $prod->_label_image):?>
                                <div class="label-hit">Хит продаж</div>
                            <?php endif; ?>
                        </div>
                        <div class="item-price">
                            <?php if(in_array('add_old_price',$additional_params) && $prod->product_old_price):?>
                                <div class="old_pricewrap">
                                    <!--<?=formatprice($prod->product_old_price,null,1);?>-->
                                    <?php
                                    echo '<span class="label_price">Цена: </span>';
                                    $result = preg_replace( ' /([0-9\s]+)/ ' , '<span>$1</span>', formatprice($prod->product_old_price));
                                    echo formatprice($prod->product_old_price);
                                    ?>
                                </div>
                            <?php endif; ?>
                            <?php if(in_array('price',$additional_params) && $prod->product_price):?>
                                <div class="main_pricewrap">
                                    <!--<?=formatprice($prod->product_price,null,1);?>-->
                                    <?php
                                    echo '<span class="label_price">Цена: </span>';
                                    $result = preg_replace( ' /([0-9\s]+)/ ' , '<span>$1</span>', formatprice($prod->product_price));
                                    echo formatprice($prod->product_price);
                                    ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="item-bottom-block">
                        <div class="item-bottom-inner">
                            <div class="item-title">
                                <?php if(in_array('caption',$additional_params)):?>
                                    <?=$prod->name; ?>
                                <?php endif; ?>
                            </div>
                            <div class="item-days"><i class="far fa-calendar-alt"></i><?=$desc_days; ?></div>
                            <div class="item-desc">
                                <?php if(in_array('description',$additional_params) && $desc_zhdet):?>
                                    <?=$desc_zhdet;?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="item-more-link">
                        <a class="item-more" href="<?=$prodLink ?>">Подробнее о туре</a>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>

    </div>
    <div class="row">
        <div class="open_prod">Показать еще</div>
        <div class="close_prod">Свернуть туры</div>
    </div>
    <style>
        .open_prod{
            width: 165px;
            height: 48px;
            background: #71B85F;
            border-radius: 4px;
            font-style: normal;
            font-weight: 600;
            font-size: 16px;
            line-height: 150%;
            color: #FFFFFF;
        }
        .close_prod{
            width: 165px;
            height: 48px;
            background: #71B85F;
            border-radius: 4px;
            font-style: normal;
            font-weight: 600;
            font-size: 16px;
            line-height: 150%;
            color: #FFFFFF;
        }
    </style>
<? if ($orient == 'hor') { ?>
    <script>
        jQuery('#rand_products_itb_<?=$module->id;?>').slick({
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 3,
            dots: true,
            arrows: true,
            responsive: [
                {
                    breakpoint: 991.99,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 767.99,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        dots: false,
                        //arrows:false
                    }
                }
            ]
        });
    </script>
<? } ?>