<h3><?php echo $that->title_text;?></h3>
<div class="main-text">
							
	<?php echo (empty($_SESSION['edit_error']))		?	 ""		:	$_SESSION['edit_error']; 
		unset($_SESSION['edit_error']);
	?>
	
	<form action="" method="post" id="updateForm" class="updateForm" >
		<input class="input" type="text" size="25" name="posName" id="posName" 	value="<?php echo htmlspecialchars($that->title_text) ?>" />
		<br/><br/><br/>	
		<textarea cols="50" rows="25" name="posText" id="posText" class="textarea"><?php echo $that->osn_text;?></textarea>


		<?php if( ($that->id == 0)): ?>
			<input class="input" type="hidden" name="glava_h" id="glava_h" value="0" />
			<input class="input" type="hidden" name="nomer_por" id="nomer_por" value="<?php echo ($that->last_nomer( $that->glavy) + 1); ?>" />
		<?php else: ?>
			<input class="input" type="hidden" name="glava_h" id="glava_h" value="<?php echo $that->glava;?>" />
			<input class="input" type="hidden" name="nomer_por" id="nomer_por" value="<?php echo $that->last_nomer( $that->glavy[$that->glava]['childs'] ) + 1?>" />
		<?php  endif; ?>

		<input class="input" type="hidden" name="type" id="type" value="<?php echo $that->controller;?>" />
		<input class="input-submit"  type="submit" name="submitText" id="submitText" value=" " />  
	</form>	
							
</div>