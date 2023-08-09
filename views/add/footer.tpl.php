<?php
    use Application\config\boot;
?>
	<div id="bottom_container">
		<div id="footer">
            <div id="foot">
                <div class="left-foot">
					<a style="color: #333;" href="<?=boot::PATH .'login'?>">Вход</a>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $footer['line1']?><br />
					<?php echo $footer['line2']?><br />
					<?php echo $footer['line3']?>.
                </div>
            </div>
        </div>
    </div>
    