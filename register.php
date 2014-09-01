<?php include('header.php'); ?>
<div class="container normal-page sliderhome">
			<div class="row block">
				<div class="span12">
					<div class="template-wrapper">
						<ul id="js-news" class="js-hidden">
						<?php $ticker = $ez_frontend->get_ticker_messages(); ?>
						<?php foreach( $ticker as $msg ) { ?>
                                <li class="news-item"><?php echo htmlspecialchars_decode( $msg['text'] ); ?></li> 
                        <?php } ?>
                        </ul>
						<div class="clear"></div>
					</div>
					<div class="clear"></div>
				</div>
			</div>
			<div class="row">
				<div class="span12">
					<div class="template-wrapper">
						<div class="block block-contactform_block span7 first cf">
								<div class="title-wrapper">
									<h3 class="widget-title">Registration Form</h3>
									<div class="clear"></div>
								</div>
								<div class="mcontainer">
						  <form id="ezLeagueRegister" name="ezLeagueRegister" class="contact" method="post">
						   <input type="hidden" name="form" value="ezLeagueRegister">
                            <ul class="contactform controls">
                            <li class="input-prepend">
                                <span class="add-on"><i class="fa fa-user"></i></span>
                                <input type="text" name="register-username" placeholder="Username" id="register-username">
                                                            </li>
                            <li class="input-prepend">
                                <span class="add-on"><i class="fa fa-envelope"></i></span>
                                <input type="text" placeholder="E-Mail" name="register-email" id="register-email">
                                                            </li>
                            <li class="input-prepend">
                                <span class="add-on"><i class="fa fa-lock"></i></span>
                                <input type="text" placeholder="Password" name="register-password" id="register-password">
                            </li>
                            <li class="input-prepend">
                                <span class="add-on"><i class="fa fa-lock"></i></span>
                                <input type="text" placeholder="Confirm Password" name="register-confirm" id="register-confirm">
                            </li>
                            <li>
                                <button type="submit" class="button-green button-small">Register Account</button>
                            </li>
                        </ul>
                        <div class="register_success"><span class="register_success_text"></span></div>
	                    </form>
								</div>
							</div>
<?php include('sidebar.php'); ?>
<?php include('footer.php'); ?>