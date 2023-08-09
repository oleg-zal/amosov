<?php  
    $title_oz = $ini_array['menu_left']['title'];
    $title_alt = 'title_ua';
    //$lang = $ini_array['language_c'];
    //print_r($glavy); exit;
?>
<?php if (!empty($title)): ?>
    <h2 style="border-bottom: 1px solid #71736b;"><?=$title?></h2>
<?php endif; ?>	
<ul class="menu-cat" id="accordion">

<?php foreach($glavy as $item): ?>
		
    <?php if( isset($item['childs']) && $item['childs'] ): ?>
	<?php $iter = 1; ?>
	<?php foreach($item['childs'] as $item_child): ?>
            <?php if($iter == 1): ?>
            <li class="h4">
            <a class="viewing" href="<?=$fold . $item_child['link']?>">
            <?php 
                if ($ini_array['language_c'] == 'en') {
                    echo (empty( $item[ $title_oz ]) ?	$item[ $title_alt ] : $item[ $title_oz ] );
                }
		        else {
                    echo (empty( $item[ $title_oz ]) ?	'******' : trim($item[ $title_oz ]) );
		        }
            ?>
            </a>
            <?php if( !empty($view) && ($auth === 1) ): ?>
                <span>(<a class="editing" href="<?=$fold . $view . $lang?>/updater/<?=$item['id']?>">ред</a>)</span>
            <?php endif; ?>	
            </li>
							
<li class="sub-g"><ul class="menu-cat">
					
<li>
<a <?php self::active($item_child['id'], $active)?>href="<?=$fold . $item_child['link']?>">
            <?php 
            if ($ini_array['language_c'] == 'en') {
                    echo (empty($item_child[ $title_oz ]) ? $item_child[$title_alt] : $item_child[ $title_oz ]);
            }
            else {
                    echo (empty($item_child[ $title_oz ]) ? '******' :	$item_child[ $title_oz ]);	
            }	
            ?>
</a>
</li>
						
	<?php else: ?>
					
<li>
    <a <?php self::active($item_child['id'], $active)?>href="<?=$fold . $item_child['link']?>">

	<?php
            if ($ini_array['language_c'] == 'en') {
                echo (empty($item_child[ $title_oz ]) ? $item_child[$title_alt]	: $item_child[ $title_oz ]);
            }
            else {
                echo (empty($item_child[ $title_oz ])	?	'******'	:	$item_child[ $title_oz ]);
            }	
	?>
    </a>
</li>
						
	<?php endif; ?>			
	<?php $iter++; ?>
    <?php endforeach; ?>
				
    <?php if( ($auth === 1) && ($that->settings[$that->controller]['ua'] != 'news')): ?>
        <li>
            <a style="font-size: 10px;" href="<?=$fold . $view . $lang?>/add/<?=$item['id']?>">Добавить</a>
        </li>
	<?php endif;?>

</ul></li>
				
	<?php else: ?>
            <li>
				<a <?php self::active($item['id'], $active)?>href="<?=$fold . $item['link']?>">
					<?php
					if ($ini_array['language_c'] == 'en') {
						echo (empty(	$item[ $title_oz ])	?	$item[ $title_alt ]	:	$item[ $title_oz ]	);
					}
					else {
						echo (empty(	$item[ $title_oz ])	?	'******'	:	$item[ $title_oz ]	);
					}
					?>
				</a>				
            </li>

	<?php endif;?>
    <?php endforeach; ?>
    <?php if( ($auth === 1) && ($that->settings[$that->controller]['ua'] == 'nature')): ?>
        <li>
            <a style="font-size: 10px;" href="<?=$fold . $view . $lang?>/add/0">Добавить</a>
        </li>
    <?php  endif;?>
	
</ul>
