<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<body>
<div class="page-loader">
    <img class="page-loader-img" src="<?php echo(base_url() . "assets/"); ?>images/pageLoader.gif" width="150px" height="150px" alt="Page Loader"/>
</div>
<div id="mobile-header" class="mobile-header hidden-md hidden-lg">
    <div class="contact-number">
        <svg xmlns="http://www.w3.org/2000/svg" class="contacts-icon-container" width="24" height="24" viewBox="0 0 24 24">
            <path class="contacts-icon" fill-rule="evenodd" clip-rule="evenodd" fill="#0080BC" d="M1.027 4.846l-.018.37.01.181c.068 9.565 7.003 17.42 15.919 18.48.338.075 1.253.129 1.614.129.359 0 .744-.021 1.313-.318.328-.172.448-.688.308-1.016-.227-.528-.531-.578-.87-.625-.435-.061-.905 0-1.521 0-1.859 0-3.486-.835-4.386-1.192l.002.003-.076-.034c-.387-.156-.696-.304-.924-.422-3.702-1.765-6.653-4.943-8.186-8.896-.258-.568-1.13-2.731-1.152-6.009h.003l-.022-.223c0-1.727 1.343-3.128 2.999-3.128 1.658 0 3.001 1.401 3.001 3.128 0 1.56-1.096 2.841-2.526 3.079l.001.014c-.513.046-.914.488-.914 1.033 0 .281.251 1.028.251 1.028.015 0 .131.188.119.188-.194-.539 1.669 5.201 7.021 7.849-.001.011.636.309.636.309.47.3 1.083.145 1.37-.347.09-.151.133-.32.14-.488.356-1.306 1.495-2.271 2.863-2.271 1.652 0 2.991 1.398 2.991 3.12 0 .346-.066.671-.164.981-.3.594-.412 1.21.077 1.699.769.769 1.442-.144 1.442-.144.408-.755.643-1.625.643-2.554 0-2.884-2.24-5.222-5.007-5.222-1.947 0-3.633 1.164-4.46 2.858-2.536-1.342-4.556-3.59-5.656-6.344 1.848-.769 3.154-2.647 3.154-4.849 0-2.884-2.241-5.222-5.007-5.222-2.41 0-4.422 1.777-4.897 4.144l-.091.711z"/>
        </svg>
        <span class="desktop-version hidden-xs"><?php echo($telephone); ?></span>
        <a class="mobile-version visible-xs-inline-block" href="tel://<?php echo($telephone); ?>" title="Make a Call"><?php echo($telephone); ?></a>
    </div>
    <!-- .contact-number -->
    <div class="mobile-header-nav">
        <ul class="user-nav">
            <li><a class="login-register-link" href="#login-modal" data-toggle="modal"><i class="fa fa-sign-in"></i>Login / Sign up</a></li>
            <!--<li><a href="index.html"><i class="fa fa-sign-out"></i>Logout</a></li>-->
            <li><a href="profile.html"><i class="fa fa-user"></i>Profile</a></li>
            <li><a href="my-properties.html"><i class="fa fa-th-list"></i>My Properties</a></li>
            <li><a href="<?php echo(base_url() . "wishlist/view"); ?>"><i class="fa fa-star"></i>Favorites</a></li>
            <li><a class="submit-property-link" href="submit-property.html"><i class="fa fa-plus-circle"></i>Submit</a></li>
        </ul>
        <!-- .user-nav -->
        <div class="social-networks header-social-nav">
            <a class="twitter" target="_blank" href="#"><i class="fa fa-twitter"></i></a><a class="facebook" target="_blank" href="#"><i class="fa fa-facebook"></i></a><a class="gplus" target="_blank" href="#"><i class="fa fa-google-plus"></i></a>
        </div>
        <!-- .social-networks -->
    </div>
</div>
<header class="site-header header header-variation-two">
    <div class="container">
        <div class="row zero-horizontal-margin">
            <div class="col-lg-3 zero-horizontal-padding">
                <div id="site-logo" class="site-logo">
                    <div class="logo-inner-wrapper">
                        <a href="<?php echo(base_url()); ?>"><img src="<?php echo(base_url() . "assets/"); ?>images/logo_background.png" class="img img-rounded" title="<?php echo($appName); ?>" alt="<?php echo($appName); ?>"/></a>
                        <!--<small class="tag-line" style="color: #fff;">PROPERTY / SALES / MORTAGE / RENT</small>-->
                    </div>
                </div>
            </div>
            <!-- .left-column -->
            <div class="col-lg-9 zero-horizontal-padding hidden-xs hidden-sm">
                <div class="header-top clearfix">
                    <div class="social-networks header-social-nav">
                        <a class="twitter" href="<?php echo($this->config->item('social_twitter')); ?>" target="_blank"><i class="fa fa-twitter fa-lg"></i></a>
						<a class="facebook" href="<?php echo($this->config->item('social_facebook')); ?>" target="_blank"><i class="fa fa-facebook fa-lg"></i></a>
						<a class="instagram" href="<?php echo($this->config->item('social_instagram')); ?>" target="_blank"><i class="fa fa-instagram fa-lg"></i></a>
                    </div>
                    <!-- .social-networks -->
                    <ul class="user-nav">
                        <li><a href="#"><i class="fa fa-star"></i>Favorites</a></li>
                        <li><a class="submit-property-link" href="<?php echo(base_url() . "welcome/#listing"); ?>"><i class="fa fa-plus-circle"></i>List With Us</a></li>
                    </ul>
                    <!-- .user-nav -->
                    <div class="contact-number">
                        <svg xmlns="http://www.w3.org/2000/svg" class="contacts-icon-container" width="24" height="24" viewBox="0 0 24 24">
                            <path class="contacts-icon" fill-rule="evenodd" clip-rule="evenodd" fill="#0080BC" d="M1.027 4.846l-.018.37.01.181c.068 9.565 7.003 17.42 15.919 18.48.338.075 1.253.129 1.614.129.359 0 .744-.021 1.313-.318.328-.172.448-.688.308-1.016-.227-.528-.531-.578-.87-.625-.435-.061-.905 0-1.521 0-1.859 0-3.486-.835-4.386-1.192l.002.003-.076-.034c-.387-.156-.696-.304-.924-.422-3.702-1.765-6.653-4.943-8.186-8.896-.258-.568-1.13-2.731-1.152-6.009h.003l-.022-.223c0-1.727 1.343-3.128 2.999-3.128 1.658 0 3.001 1.401 3.001 3.128 0 1.56-1.096 2.841-2.526 3.079l.001.014c-.513.046-.914.488-.914 1.033 0 .281.251 1.028.251 1.028.015 0 .131.188.119.188-.194-.539 1.669 5.201 7.021 7.849-.001.011.636.309.636.309.47.3 1.083.145 1.37-.347.09-.151.133-.32.14-.488.356-1.306 1.495-2.271 2.863-2.271 1.652 0 2.991 1.398 2.991 3.12 0 .346-.066.671-.164.981-.3.594-.412 1.21.077 1.699.769.769 1.442-.144 1.442-.144.408-.755.643-1.625.643-2.554 0-2.884-2.24-5.222-5.007-5.222-1.947 0-3.633 1.164-4.46 2.858-2.536-1.342-4.556-3.59-5.656-6.344 1.848-.769 3.154-2.647 3.154-4.849 0-2.884-2.241-5.222-5.007-5.222-2.41 0-4.422 1.777-4.897 4.144l-.091.711z"/>
                        </svg>
                        <span class="desktop-version hidden-xs"><?php echo($telephone); ?></span>
                        <a class="mobile-version visible-xs-inline-block" href="tel://<?php echo($telephone); ?>" title="Make a Call"><?php echo($telephone); ?></a>
                    </div>
                    <!-- .contact-number -->
                </div>
                <!-- .header-top -->
                <div class="header-bottom clearfix">
                    <nav id="site-main-nav" class="site-main-nav">
                        <ul class="main-menu clearfix">
                            <li>
                                <a href="<?php echo(base_url()); ?>">Home</a>
                            </li>
							<li><a href="<?php echo(base_url() . "welcome/about"); ?>">About</a></li>
							<li>
								<a href="#">Properties</a>
								<ul class="sub-menu">
									<?php
										$cleanHotDealsUrl = htmlspecialchars("HOT DEAL");
										$cleanSaleUrl = htmlspecialchars("SALE");
										$cleanRentUrl = htmlspecialchars("RENT");
									?>
									<li><a href="<?php echo(base_url() . "welcome/viewByCategory/{$cleanHotDealsUrl}"); ?>">Hot Deal (<?php echo($this->DatabaseModel->getlAllHotDealsPropertiesCount()); ?>)</a> </li>
									<li><a href="<?php echo(base_url() . "welcome/viewByCategory/{$cleanSaleUrl}"); ?>">Sale (<?php echo($this->DatabaseModel->getAllSalePropertiesCount()); ?>)</a></li>
									<li><a href="<?php echo(base_url() . "welcome/viewByCategory/{$cleanRentUrl}"); ?>">Rent (<?php echo($this->DatabaseModel->getAllRentPropertiesCount()); ?>)</a> </li>
								</ul>
							</li>
							<li>
								<a href="<?php echo(base_url() . "welcome/mortgage"); ?>">Mortgage</a>
							</li>
                            <li><a href="<?php echo(base_url() . "welcome/contact"); ?>">Contact</a></li>
                        </ul>
                    </nav>
                </div>
                <!-- .header-bottom -->
            </div>
            <!-- .right-column -->
        </div>
        <!-- .row -->
    </div>
    <!-- .container -->
</header>
