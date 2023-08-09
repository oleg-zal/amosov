<?php 
    $link1 = (empty($glava)) ? "" :	'/'.$glava;
    $lang = empty($ini_array['language_c']) ? 'ua' : $ini_array['language_c'];
?>
<div id="top">
    <div id="lang">
	<div class="lang-img <?php echo ( ($lang == 'ua') ? 'active' : '')?>">
            <a href="<?php echo $fold . $ini_array[$view]['ua'] . $link1 ?>">
                <img src="<?php echo $roott?>images/flag_ua.jpg" alt="" />
            </a>
	</div>
	<div class="lang-img <?php echo ( ($lang == 'ru') ? 'active' : '')?>">
            <a href="<?php echo $fold . $ini_array[$view]['ru'] . $link1 ?>">
                <img src="<?php echo $roott?>images/flag_ru.jpg" alt="" />
            </a>
	</div>
	<div class="lang-img <?php echo ( ($lang == 'en') ? 'active' : '')?>">
            <a href="<?php echo $fold . $ini_array[$view]['en'] . $link1 ?>">
                <img src="<?php echo $roott?>images/flag_en.jpg" alt="" />
            </a>
	</div>
    </div>
				
    <div id="logo">
	<div id="pad_logo">
            <h1><?php echo $ini_array['flag']['title']?></h1>
	</div>
    </div>
					
    <div id="topmenu">
	<div id="nav">
            <ul id="menu">	
<?php foreach($menu as $item): ?>
                <li>
                        <a <?php self::active($item['title'], $active)?> href="<?php echo $item['link']?>">
                            <?php echo $item['title']?>
			</a>
                </li> 
<?php endforeach; ?>
            </ul>
	</div>
    </div>
	
    <div class="foto1">
        <img src="<?php echo $roott ?>images/amosov_f.jpg" alt=""/>

        <div class="foto2">6.12.1913&nbsp; - &nbsp;12.12.2002</div>
    </div>


</div>  <!-- END OF HEADER -->
