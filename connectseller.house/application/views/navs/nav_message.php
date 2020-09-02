<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php setlocale(LC_MONETARY,"en_NG"); ?>
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
            <li><a class="submit-property-link" href="submit-property.html"><i class="fa fa-plus-circle"></i>Submit Property</a></li>
        </ul>
        <!-- .user-nav -->
        <div class="social-networks header-social-nav">
			<a class="twitter" href="<?php echo($this->config->item('social_twitter')); ?>" target="_blank"><i class="fa fa-twitter fa-lg"></i></a>
			<a class="facebook" href="<?php echo($this->config->item('social_facebook')); ?>" target="_blank"><i class="fa fa-facebook fa-lg"></i></a>
			<a class="instagram" href="<?php echo($this->config->item('social_instagram')); ?>" target="_blank"><i class="fa fa-instagram fa-lg"></i></a>
        </div>
        <!-- .social-networks -->
    </div>
</div>
<header class="site-header header header-variation-one">
    <div class="header-container">
        <div class="header-menu-wrapper hidden-xs hidden-sm clearfix">
            <a class="button-menu-reveal" href="#">Menu</a>
            <a class="button-menu-close" href="#"><i class="fa fa-times"></i></a>
            <nav id="site-main-nav" class="site-main-nav">
                <ul class="main-menu clearfix">
					<li class="current-menu-item"><a href="<?php echo(base_url() ); ?>">Home</a></li>
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
        <div class="row zero-horizontal-margin">
            <div class="left-column">
                <div id="site-logo" class="site-logo">
                    <div class="logo-inner-wrapper">
                        <a href="<?php echo(base_url()); ?>"><img src="<?php echo(base_url() . "assets/"); ?>images/logo.png" title="<?php echo($appName); ?>" alt="<?php echo($appName); ?>"/></a>
                    </div>
                </div>
            </div>
            <!-- .left-column -->
            <div class="right-column">
                <div class="header-top hidden-xs hidden-sm clearfix">
                    <div class="contact-number">
                        <svg xmlns="http://www.w3.org/2000/svg" class="contacts-icon-container" width="24" height="24" viewBox="0 0 24 24">
                            <path class="contacts-icon" fill-rule="evenodd" clip-rule="evenodd" fill="#0080BC" d="M1.027 4.846l-.slide-5.jpg018.37.01.181c.068 9.565 7.003 17.42 15.919 18.48.338.075 1.253.129 1.614.129.359 0 .744-.021 1.313-.318.328-.172.448-.688.308-1.016-.227-.528-.531-.578-.87-.625-.435-.061-.905 0-1.521 0-1.859 0-3.486-.835-4.386-1.192l.002.003-.076-.034c-.387-.156-.696-.304-.924-.422-3.702-1.765-6.653-4.943-8.186-8.896-.258-.568-1.13-2.731-1.152-6.009h.003l-.022-.223c0-1.727 1.343-3.128 2.999-3.128 1.658 0 3.001 1.401 3.001 3.128 0 1.56-1.096 2.841-2.526 3.079l.001.014c-.513.046-.914.488-.914 1.033 0 .281.251 1.028.251 1.028.015 0 .131.188.119.188-.194-.539 1.669 5.201 7.021 7.849-.001.011.636.309.636.309.47.3 1.083.145 1.37-.347.09-.151.133-.32.14-.488.356-1.306 1.495-2.271 2.863-2.271 1.652 0 2.991 1.398 2.991 3.12 0 .346-.066.671-.164.981-.3.594-.412 1.21.077 1.699.769.769 1.442-.144 1.442-.144.408-.755.643-1.625.643-2.554 0-2.884-2.24-5.222-5.007-5.222-1.947 0-3.633 1.164-4.46 2.858-2.536-1.342-4.556-3.59-5.656-6.344 1.848-.769 3.154-2.647 3.154-4.849 0-2.884-2.241-5.222-5.007-5.222-2.41 0-4.422 1.777-4.897 4.144l-.091.711z"/>
                        </svg>
                        <span class="desktop-version hidden-xs"><?php echo($telephone); ?></span>
                        <a class="mobile-version visible-xs-inline-block" href="tel://<?php echo($telephone); ?>" title="Make a Call"><?php echo($telephone); ?></a>
                    </div>
                    <!-- .contact-number -->
                    <ul class="user-nav">
                        <li><a style="background-color: #FF8000; color: #ffffff"class="submit-property-link" href="<?php echo(base_url() . "welcome/#listing"); ?>"><i class="fa fa-plus-circle"></i>List With Us</a></li>
                        
                        <li><a href="#"><i class="fa fa-star"></i>Favorites</a></li>

                    </ul>
                    <!-- .user-nav -->
                    <div class="social-networks header-social-nav">
						<a class="twitter" href="<?php echo($this->config->item('social_twitter')); ?>" target="_blank"><i class="fa fa-twitter fa-lg"></i></a>
						<a class="facebook" href="<?php echo($this->config->item('social_facebook')); ?>" target="_blank"><i class="fa fa-facebook fa-lg"></i></a>
						<a class="instagram" href="<?php echo($this->config->item('social_instagram')); ?>" target="_blank"><i class="fa fa-instagram fa-lg"></i></a>
                    </div>
                    <!-- .social-networks -->
                </div>
                <!-- .header-top -->
                <div class="header-bottom clearfix">
                    <div class="advance-search header-advance-search">
                        <form class="advance-search-form" action="<?php echo(base_url() . "welcome/advanceSearch"); ?>" method="post">
                            <div class="inline-fields clearfix">
                                <div class="option-bar property-location">
                                    <select name="location" id="location" class="search-select" required>
                                        <option value="">Location (Any)</option>
                                        <?php
											foreach($searchAreaResultSet as $searchArea){
										?>
											<option value="<?php echo($searchArea->area); ?>"><?php echo(strtoupper($searchArea->area)); ?></option>
										<?php		
											}
                                        ?>
                                    </select>
                                </div>
                                <div class="option-bar property-type">
                                    <select name="type" id="select-property-type" class="search-select">
                                        <option value="" selected="selected">Property Type (Any)</option>
										<?php
											foreach($searchTypeResultSet as $searchType){
										?>
											<option value="<?php echo($searchType->type); ?>"><?php echo(strtoupper($searchType->type)); ?></option>
										<?php		
											}
                                        ?>
                                    </select>
                                </div>
                                <div class="option-bar property-status">
                                    <select name="status" id="select-status" class="search-select">
                                        <option value="" selected="selected">Property Status (Any)</option>
										<?php
											foreach($searchCategoryResultSet as $searchCategory){
										?>
											<option value="<?php echo($searchCategory->category); ?>"><?php echo(strtoupper($searchCategory->category)); ?></option>
										<?php		
											}
                                        ?>
                                    </select>
                                </div>
                                <div class="option-bar form-control-buttons">
                                    <a class="hidden-fields-reveal-btn" href="#">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon-plus-container" width="20" height="20" viewBox="0 0 20 20">
                                            <g fill="#C15302">
                                                <path class="icon icon-minus" d="M10.035 20.035c-2.092 0-4.313-.563-5.688-1.938-.406-.406-.688-.73-.688-1.141 0-.424.266-.859.891-.797.257.025.585.172.75.347 1.327.969 2.967 1.529 4.735 1.529 4.437 0 8.001-3.564 8.001-8.001 0-4.436-3.564-8-8.001-8-4.436 0-8 3.564-8 8 0 1.226.337 2.306.829 3.344 0 .001.277.495.313.938.04.491-.234.703-.656.875-.377.153-.859-.109-1.083-.452-.87-1.335-1.403-2.999-1.403-4.704 0-5.414 4.586-10 10-10 5.413 0 10 4.586 10 10 0 5.413-4.587 10-10 10zm-12-14v8-8zm16 5h-8c-.553 0-1-.447-1-1 0-.553.447-1 1-1h8c.553 0 1 .447 1 1 0 .553-.447 1-1 1z"/>
                                                <path class="icon icon-plus" d="M10.226 15.035c-.553 0-1-.447-1-1v-8c0-.553.447-1 1-1 .553 0 1 .447 1 1v8c0 .553-.447 1-1 1z"/>
                                            </g>
                                        </svg>
                                    </a>
                                    <input type="submit" value="Search" class="form-submit-btn">
                                </div>
                            </div>
                            <!-- .inline-fields -->
                            <div class="hidden-fields clearfix">
                                <div class="option-bar property-bedrooms">
                                    <select name="bedrooms" id="select-bedrooms" class="search-select">
                                        <option value="" selected="selected">Min Bed Room (Any)</option>
										<?php
											foreach($searchBedRoomResultSet as $searchBedRoom){
										?>
											<option value="<?php echo($searchBedRoom->bedroom); ?>"><?php echo($searchBedRoom->bedroom); ?></option>
										<?php		
											}
                                        ?>
                                    </select>
                                </div>
                                <div class="option-bar property-bathrooms">
                                    <select name="bathrooms" id="select-bathrooms" class="search-select">
                                        <option value="" selected="selected">Min Bath Room (Any)</option>
										<?php
											foreach($searchBathRoomResultSet as $searchBathRoom){
										?>
											<option value="<?php echo($searchBathRoom->bathroom); ?>"><?php echo($searchBathRoom->bathroom); ?></option>
										<?php		
											}
                                        ?>
                                    </select>
                                </div>
                               <div class="option-bar property-min-price">
                                    <select name="min-price" id="select-min-price" class="search-select">
                                        <option value="" selected="selected">Min Price (Any)</option>
										<?php
											foreach($searchPriceResultSet as $searchPrice){
										?>
											<option value="<?php echo($searchPrice->price); ?>"><?php echo(money_format("%n ", $searchPrice->price)); ?></option>
										<?php		
											}
                                        ?>
                                    </select>
                                </div>
                                <div class="option-bar property-max-price">
                                    <select name="max-price" id="select-max-price" class="search-select">
                                        <option value="" selected="selected">Max Price (Any)</option>
										<?php
											foreach($searchPriceResultSet as $searchPrice){
										?>
											<option value="<?php echo($searchPrice->price); ?>"><?php echo(money_format("%n ", $searchPrice->price)); ?></option>
										<?php		
											}
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <!-- .hidden-fields -->
                        </form>
                        <!-- .advance-search-form -->
                    </div>
                    <!-- .advance-search -->
                </div>
                <!-- .header-bottom -->
            </div>
            <!-- .right-column -->
        </div>
        <!-- .row -->
    </div>
    <!-- .container -->
</header>
<!-- .site-header -->

