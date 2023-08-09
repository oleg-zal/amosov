<?php
use Application\config\boot;
?>
<ul class="pic">
		
	<?php $kol_vo = count($gallery); $iter=1; ?>
	<?php foreach($gallery as $slide): ?>
		<?php if ($iter == 1): ?>
				<li class="first">
		<?php elseif ($iter == $kol_vo): ?>
				<li class="last">
		<?php else: ?>	
				<li>
		<?php endif; ?>
			

			<img alt="" src="<?php echo boot::SLIDE.$slide?>"/>
		<!-- </a> -->
		</li>
		<?php $iter++; ?>
	<?php endforeach; ?>
		
</ul>