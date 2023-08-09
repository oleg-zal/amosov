<h3><?php echo $that->title_text;?></h3>
<div class="main-text">

	<?php 	if (empty($_SESSION['edit_error']))	echo "";
	else{ echo	$_SESSION['edit_error']; unset($_SESSION['edit_error']); };
	?>
	
		
	<form action="" method="post" id="updateForm" class="updateForm" >
		<input class="input" type="text" size="25" name="posName" id="posName" 	value="<?php echo htmlspecialchars($that->title_text) ?>" />
		<br/><br/><br/>	
		
		<?php if($root == 'r'): ?>
			<input type="hidden" name="posText" value="root" />
		<?php else: ?>
			<textarea cols="50" rows="25" name="posText" id="posText" class="textarea"><?php echo $that->osn_text;?></textarea>
		<?php endif; ?>	
		
		<input class="input" type="hidden" name="glava_h" id="glava_h" value="<?php echo $that->glava;?>" />
		<input class="input-submit"  type="submit" name="submitText" id="submitText" value=" " />  
	</form>	
							
</div>