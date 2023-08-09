<?php use Application\config\boot; ?>
<?php echo $header;?>    	
<body>
    <!-- MAIN_CONTAINER -->
    <div id="main_container">
        
        <!-- FRAME -->
        <div id="frame">
            <!-- BEGIN HEADER -->
            <?php echo $menu;?>    	
            
            <!-- BEGIN CONTENT -->
            <div id="content">                     	                   	
				<div id="content-inner"> 
                    <div id="head-top-inner">
                        <div id="head-title-inner">
                            <h2><?php echo $settings['feedback']['title'] ?></h2><!-- Page title here -->
                        </div>                            	
                    </div>                            
                    
                    <div class="maincontent">                            
                        <p id="loadBar" style="display:none;">
                            <strong>Sending Email. Hold on just a sec&#8230;</strong><br />
                            <img src="images/loading.gif" alt="Loading..." title="Sending Email" />
						</p>
                        
                        <p id="emailSuccess" style="display:block;">
                            <strong style="color:red;"><?php echo $result;?></strong>
                        </p>


                        <p><?php echo $settings['feedback']['desc'] ?></p>
                        
                        <div id="contactFormArea">
                            <form action="<?php echo boot::PATH ?>feedback<?php echo $settings['language_c'] ?>"
                                  method="post" id="cForm">
                                <fieldset>

                                    <label for="posName"><?php echo $settings['feedback']['name'] ?></label>
									<input class="input" type="text" size="25" name="posName" id="posName" 	value="<?php echo $name;?>" />
									<?php echo $error['name'];?><br /><br />

                                    <label for="posEmail"><?php echo $settings['feedback']['email'] ?></label>
                                    <input class="input" type="text" size="25" name="posEmail" id="posEmail" value="<?php echo $email;?>" />
									<?php echo $error['email'];?><br /><br />

                                    <label for="posRegard"><?php echo $settings['feedback']['subject'] ?></label>
                                    <input class="input" type="text" size="25" name="posRegard" id="posRegard" value="<?php echo $subject;?>" />
									<?php echo $error['subject'];?><br /><br />

                                    <label for="posText"><?php echo $settings['feedback']['message'] ?></label>
                                    <textarea cols="50" rows="10" name="posText" id="posText" class="textarea"><?php echo $message;?></textarea>
									<?php echo $error['message'];?><br /><br />
									
                                                                        
									<input class="input-submit"  type="submit" name="sendContactEmail" id="sendContactEmail" value=" " />                           
                                </fieldset>
                            </form>     
                        </div>
                    </div>
                </div>
				<div id="content-right">
					&nbsp;
				</div>
            </div>
                	 <!-- END OF CONTENT -->
                     
        </div><!-- END OF FRAME -->
                
    </div>  <!-- END OF MAIN_CONTAINER -->
        
        
    <!-- BEGIN FOOTER -->
    <?php echo $footer;?>
