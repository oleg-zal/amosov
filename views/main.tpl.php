<?php echo $header;?>
<body>

    <!-- MAIN_CONTAINER -->
    <div id="main_container">
        
    <!-- FRAME -->
        <div id="frame">
        <!-- BEGIN HEADER -->
            <?php echo $menu;?>	
			
                <div id="content">
                    <div id="content1">			
                        <?php echo $left_menu;?>	
                    </div>
				
                    <div id="content2">
                        <div id="main_slides" <?php //echo $style_css;?>>
                            <?php echo $galery;?>
                        </div>
                        <div class="br_c">
                            <?php if( isset($br_c) ): ?>
                                <?php foreach($br_c as $item): ?>
                                    <?php if (empty($item['link'])): ?>
                                        <span><?php echo $item['title'];?></span>
                                    <?php else: ?>
                                        <a href="<?php echo $item['link'];?>">
                                            <?php echo $item['title'];?>
                                        </a>&nbsp; > &nbsp;
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>	
                            <?php //print_arr($br_c);?>							
                        </div>
                        <div class="fraza">
                            <?php echo $content;?>							
                        </div>	
                    </div>
				
                </div><!-- END OF CONTENT -->
						 
						 
        </div><!-- END OF FRAME -->
					
    </div>  <!-- END OF MAIN_CONTAINER -->
	<!-- BEGIN FOOTER -->
    <?php echo $footer;?>
	<!-- END OF FOOTER -->
    <script type="text/javascript">
        function destroy()
        {
            r = confirm("Bы уверены, что хотите уничтожить эту страницу?");
            return r;
        }
    </script>
</body>
</html>
