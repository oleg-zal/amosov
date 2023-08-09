<?php 	use Application\config\boot; ?>
<h2><?php echo $title;?>	
	<?php if( $auth === 1 ): ?>
		<form style="display: inline-block;" name="auth3" action="<?php echo boot::PATH . $edit_link; ?>" method="POST">
			<button class="edit" name="edit" value="1" type="submit">Редактирование</button>
			<?php if ($podglavy || ($that->settings[$that->controller]['ua'] == 'nature' )  ) : ?>
				<input class="input" type="hidden" name="glava" id="glava" value="<?php echo $glava;?>" />
				<button class="del" name="del" value="<?php echo boot::PATH . $del_link; ?>" type="submit" onclick="return destroy();" >Удаление</button>
			<?endif?>
			<?php if (($that->settings[$that->controller]['ua'] == 'news' ) &&
					  ($that->parent != boot::ARCHIVE) &&
					  ($that->glava != 494)) : ?>
				<button class="arc" name="arc" value="<?php echo boot::PATH . $arc_link; ?>" type="submit" >В Архив</button>
			<?endif?>
			<?php if (($that->settings[$that->controller]['ua'] == 'news' ) &&
				($that->parent == boot::ARCHIVE)) : ?>
				<button class="restore" name="restore" value="<?php echo boot::PATH . $res_link; ?>" type="submit" >Восстановить</button>
			<?endif?>
		</form>
	<?php endif; ?>
</h2>

<div class="main-text">
	<?php 	if (empty($_SESSION['edit_error']))	echo "";
			else{ echo	$_SESSION['edit_error']; unset($_SESSION['edit_error']); };
	?>	
	<?php echo((empty($content) && ($lang == 'en'))	?"Sorry, this section is being translated into English and is currently available only <br/>	
		in Ukrainian &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='" . $ua_link . "'>›››</a>   <br/>
		and Russian &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='" . $ru_link . "'>›››</a>"	:	$content);?>
	
</div>