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
                            <h2>Вход для редактирования</h2><!-- Page title here -->
                        </div>                            	
                    </div>                            
                    
                    <div class="maincontent">                            
                                                
                        <p id="emailSuccess" style="display:block;">
                            <strong style="color:red;"><?php echo $result;?></strong>
                        </p>
                        
                        
                        <p><?php echo $error_login;?></p>
                        
                        <div id="contactFormArea">
                            <form action="<?php echo boot::PATH?>login" method="post" id="cForm">
                                <fieldset>
                                    
									<label for="login">Login</label>
									<input class="input" type="text" size="25" name="login" id="login" 	value="" />
									<br/><br/><br/><br/>
                                    
									<label for="password">Password</label>
                                    <input class="input" type="password" size="25" name="password" id="password" value="" />
									<br/><br/><br/><br/>
																	
                                                                        
									<input class="input-submit"  type="submit" name="submit_login" id="submit_login" value=" " />                           
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
