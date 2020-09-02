		        <footer class="site-footer site-footer-one">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 footer-logo">
                        <a href="<?php echo(base_url()); ?>">
                            <img class="img-responsive" style="border-radius: 15px" src="<?php echo(base_url() . "assets/"); ?>images/logo_background.png" alt="<?php echo($appName); ?>"/>
                        </a>
                        <p class="copyright-text">
                            <?php echo($copyright); ?>
                        </p>
                    </div>
                    <div class="col-lg-9 footer-widget-area">
                        <div class="row">
                            <div class="col-sm-6 col-md-3">
                                <section class="widget clearfix widget_lc_taxonomy">
                                    <h3 class="widget-title">Locations</h3>
                                    <ul>
										<?php
											$uniqueAreas = $this->DatabaseModel->getUniquePropertiesArea();
											foreach($uniqueAreas as $uniqueArea){
												$cleanUniqueAreas = htmlspecialchars($uniqueArea->area);
												$uniqueAreaCount = $this->DatabaseModel->getPropertiesCountByArea($uniqueArea->area);
										?>
											<li><a href="<?php echo(base_url() . "welcome/viewByLocation/{$cleanUniqueAreas}"); ?>"><?php echo(ucwords($uniqueArea->area)); ?></a> (<?php echo($uniqueAreaCount); ?>)</li>
										<?php	
											}
										?>
                                    </ul>
                                </section>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <!--<section class="widget clearfix widget_recent_entries">
                                    <h3 class="widget-title">Latest Posts</h3>
                                    <ul>
                                        <li><a href="#">Gallery Post Format</a></li>
                                        <li><a href="#">Image Post Format</a></li>
                                        <li><a href="#">Video Post Format</a></li>
                                        <li><a href="#">Another Image Post Format</a></li>
                                        <li><a href="#">Standard Post Format with Featured Image</a></li>
                                    </ul>
                                </section>-->
                            </div>
                            <div class="clearfix visible-sm"></div>
                            <div class="col-sm-6 col-md-3">
                                <section class="widget clearfix widget_lc_taxonomy">
                                    <h3 class="widget-title">Properties</h3>
                                    <ul>
										<?php
											$cleanHotDealsUrl = htmlspecialchars("HOT DEAL");
											$cleanSaleUrl = htmlspecialchars("SALE");
											$cleanRentUrl = htmlspecialchars("RENT");
										?>
										<li><a href="<?php echo(base_url() . "welcome/viewByCategory/{$cleanHotDealsUrl}"); ?>">Hot Deal (<?php echo($this->DatabaseModel->getlAllHotDealsPropertiesCount()); ?>)</a> </li>
										<li><a href="<?php echo(base_url() . "welcome/viewByCategory/{$cleanSaleUrl}"); ?>">Sale (<?php echo($this->DatabaseModel->getAllSalePropertiesCount()); ?>)</a></li>
										<li><a href="<?php echo(base_url() . "welcome/viewByCategory/{$cleanRentUrl}"); ?>">Rent (<?php echo($this->DatabaseModel->getAllRentPropertiesCount()); ?>)</a> </li>
                                    </ul>
                                </section>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <section id="inspiry_social_media_icons-1" class="widget clearfix widget_inspiry_social_media_icons">
                                    <h3 class="widget-title">Connect With Us</h3>
                                    <div class="social-networks clearfix">
                                        <a class="twitter" href="<?php echo($this->config->item('social_twitter')); ?>" target="_blank"><i class="fa fa-twitter fa-lg"></i></a>
                                        <a class="facebook" href="<?php echo($this->config->item('social_facebook')); ?>" target="_blank"><i class="fa fa-facebook fa-lg"></i></a>
                                        <a class="instagram" href="<?php echo($this->config->item('social_instagram')); ?>" target="_blank"><i class="fa fa-instagram fa-lg"></i></a>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- .footer -->
    </div>
    <!-- .site-content -->
</div>

		<!-- .site-content-wrapper -->
		<script src="<?php echo(base_url() . "assets/"); ?>js/flexslider/jquery.flexslider-min.js"></script>
		<script src="<?php echo(base_url() . "assets/"); ?>js/lightslider/js/lightslider.min.js"></script>
		<script src="<?php echo(base_url() . "assets/"); ?>js/select2/select2.min.js"></script>
		<script src="<?php echo(base_url() . "assets/"); ?>js/owl.carousel/owl.carousel.min.js"></script>
		<script src="<?php echo(base_url() . "assets/"); ?>js/swipebox/js/jquery.swipebox.min.js"></script>
		<script src="<?php echo(base_url() . "assets/"); ?>js/jquery.hoverIntent.js"></script>
		<script src="<?php echo(base_url() . "assets/"); ?>js/jquery.validate.min.js"></script>
		<script src="<?php echo(base_url() . "assets/"); ?>js/jquery.form.js"></script>
		<script src="<?php echo(base_url() . "assets/"); ?>js/transition.js"></script>
		<script src="<?php echo(base_url() . "assets/"); ?>js/jquery.appear.js"></script>
		<script src="<?php echo(base_url() . "assets/"); ?>js/modal.js"></script>
		<script src="<?php echo(base_url() . "assets/"); ?>js/meanmenu/jquery.meanmenu.min.js"></script>
		<script src="<?php echo(base_url() . "assets/"); ?>js/jquery.placeholder.min.js"></script>
		<script src="<?php echo(base_url() . "assets/"); ?>js/custom.js"></script>
		<div id="login-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="login-modal" aria-hidden="true">
			<div class="modal-dialog">
				<div class="login-section modal-section">
					<div class="form-wrapper">
						<div class="form-heading clearfix">
							<span><i class="fa fa-sign-in"></i>Login</span>
							<button type="button" class="close close-modal-dialog " data-dismiss="modal" aria-hidden="true"><i class="fa fa-times fa-lg"></i></button>
						</div>
						<form id="login-form" action="<?php echo(base_url() . "welcome/login"); ?>" method="post" enctype="multipart/form-data">
							<div class="form-element">
								<label class="login-form-label" for="login-username">Email</label>
								<input id="login-username" name="email" type="email" class="login-form-input login-form-input-common required" autofocus="" title="* You registered email." placeholder="Email">
							</div>
							<div class="form-element">
								<label class="login-form-label" for="password">Password</label>
								<input id="password" name="password" type="password" class="login-form-input login-form-input-common required" placeholder="Password">
							</div>
							<div class="form-element">
								<input type="submit" class="login-form-submit login-form-input-common" value="Login">
							</div>
						</form>
						<div class="clearfix">
							<span class="sign-up pull-left">Not a Member?<a href="#" class="activate-section" data-section="register-section">Sign up now</a></span>
							<span class="forgot-password pull-right"><a href="#" class="activate-section" data-section="password-section">Forgot Password?</a></span>
						</div>
					</div>
					<!--<div class="buttons-external">
						<div class="graphic">
							<span class="or">or</span>
							<span class="vertical-line"></span>
							<span class="circle"></span>
						</div>
						<div class="clearfix">
							<a class="button facebook-button" href="#"><i class="fa fa-facebook"></i>Login with Facebook</a>
							<a class="button google-button" href="#"><i class="fa fa-google"></i>Login with Google</a>
						</div>
					</div>-->
				</div>
				<!-- .login-section -->
				<div class="password-section modal-section">
					<div class="form-wrapper">
						<div class="form-heading clearfix">
							<span>Reset Password</span>
							<button type="button" class="close close-modal-dialog" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times fa-lg"></i></button>
						</div>
						<form id="forgot-form" action="#" method="post">
							<div class="form-element">
								<label class="login-form-label" for="password-reset">User Name or Email<span>*</span></label>
								<input id="password-reset" name="password-reset" type="text" class="login-form-input login-form-input-common email required" title="* Please provide user name or email!" placeholder="Email">
							</div>
							<div class="form-element">
								<input type="submit" name="user-submit" class="login-form-submit login-form-input-common" value="Reset Password">
							</div>
						</form>
						<div class="clearfix">
							<span class="sign-up pull-left">Not a Member?<a href="#" class="activate-section" data-section="register-section">Sign up now</a></span>
							<span class="login-link pull-right"><a href="#" class="activate-section" data-section="login-section">Login</a></span>
						</div>
					</div>
				</div>
				<!-- .password-reset-section -->
				<div class="register-section modal-section">
					<div class="form-wrapper">
						<div class="form-heading clearfix">
							<span>Register</span>
							<button type="button" class="close close-modal-dialog" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times fa-lg"></i></button>
						</div>
						<form id="register-form" action="#" method="post">
							<div class="form-element">
								<label class="login-form-label" for="user_email">Email<span>*</span></label>
								<input id="user_email" name="email" type="email" class="login-form-input login-form-input-common email required" title="* Please provide valid email address!" placeholder="Email">
							</div>
							<div class="form-element">
								<label class="login-form-label" for="register-username">Telephone<span>*</span></label>
								<input id="register-username" name="telephone" type="tel" class="login-form-input login-form-input-common required" title="* Please enter a valid telephone numbers." placeholder="Telephone">
							</div>
							<div class="form-element">
								<label class="login-form-label" for="password">Password</label>
								<input id="password" name="password" type="password" class="login-form-input login-form-input-common required" placeholder="Password">
							</div>
							<div class="form-element">
								<input type="submit" name="user-submit" class="login-form-submit login-form-input-common" value="Register">
							</div>
						</form>
						<div class="clearfix">
							<span class="login-link pull-left"><a href="#" class="activate-section" data-section="login-section">Login</a></span>
							<span class="forgot-password pull-right"><a href="#" class="activate-section" data-section="password-section">Forgot Password?</a></span>
						</div>
					</div>
				</div>
				<!-- .register-section -->
			</div>
			<!-- .modal-dialog -->
		</div>
		<!-- .modal -->

		
		<script>
			(function ($) {
				"use strict";

				/*-----------------------------------------------------------------------------------*/
				/* Modal dialog for Login and Register
				 /*-----------------------------------------------------------------------------------*/
				var loginModal = $('#login-modal'),
					modalSections = loginModal.find('.modal-section');

				$('.activate-section').on('click', function (event) {
					var targetSection = $(this).data('section');
					modalSections.slideUp();
					loginModal.find('.' + targetSection).slideDown();
					event.preventDefault();
				});

			})(jQuery);
		</script>
	</body>
</html>
		








