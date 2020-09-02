<?php  setlocale(LC_MONETARY,"en_NG"); ?>
<div id="content-wrapper" class="site-content-wrapper">
    <div id="content" class="site-content layout-boxed">
        <main id="main" class="site-main">
            <div class="container">
                <div class="row row-odd zero-horizontal-margin">
                    
                    <?php
						foreach($hotProperties as $hotProperty){
							$picMap = $this->ApplicationModel->scan_dir("./uploads/properties/{$hotProperty->id}");
					?>								                    
						<div class="col-xs-6 custom-col-xs-12">
							<article class="row property-post-odd hentry property-listing-home property-listing-one meta-item-half"  style="height: 250px;">
								<div class="property-thumbnail zero-horizontal-padding col-lg-6">
									<div class="gallery-slider-two flexslider">
										<ul class="slides">
											<?php
												foreach($picMap as $picture){
													$cleanName  = $hotProperty->name;
													$cleanName = strstr($cleanName, '.', true);
											?>
												<li>
													<img class="img-responsive" src="<?php echo(base_url() . "uploads/properties/{$hotProperty->id}/{$picture}"); ?>" alt="<?php echo($hotProperty->name); ?>">
												</li>
											<?php		
												}
											?>
										</ul>
									</div>
								</div>
								<!-- .property-thumbnail -->
								<div class="property-description clearfix col-lg-6">
									<header class="entry-header">
										<h3 class="entry-title"><a href="<?php echo(base_url() . "welcome/viewProperty/{$hotProperty->id}"); ?>" rel="bookmark"><?php echo($hotProperty->name); ?></a></h3>
										<div class="price-and-status">
											<span class="price"><?php echo(money_format("%n ", $hotProperty->price)); ?></span><a href="#"><span class="property-status-tag"><?php echo($hotProperty->category); ?></span></a>
										</div>
									</header>
									<div class="property-meta entry-meta clearfix">
										<div class="meta-item">
											<i class="meta-item-icon icon-area">
												<svg xmlns="http://www.w3.org/2000/svg" class="meta-icon-container" width="30" height="30" viewBox="0 0 48 48">
													<path class="meta-icon" fill="#0DBAE8" d="M46 16v-12c0-1.104-.896-2.001-2-2.001h-12c0-1.103-.896-1.999-2.002-1.999h-11.997c-1.105 0-2.001.896-2.001 1.999h-12c-1.104 0-2 .897-2 2.001v12c-1.104 0-2 .896-2 2v11.999c0 1.104.896 2 2 2v12.001c0 1.104.896 2 2 2h12c0 1.104.896 2 2.001 2h11.997c1.106 0 2.002-.896 2.002-2h12c1.104 0 2-.896 2-2v-12.001c1.104 0 2-.896 2-2v-11.999c0-1.104-.896-2-2-2zm-4.002 23.998c0 1.105-.895 2.002-2 2.002h-31.998c-1.105 0-2-.896-2-2.002v-31.999c0-1.104.895-1.999 2-1.999h31.998c1.105 0 2 .895 2 1.999v31.999zm-5.623-28.908c-.123-.051-.256-.078-.387-.078h-11.39c-.563 0-1.019.453-1.019 1.016 0 .562.456 1.017 1.019 1.017h8.935l-20.5 20.473v-8.926c0-.562-.455-1.017-1.018-1.017-.564 0-1.02.455-1.02 1.017v11.381c0 .562.455 1.016 1.02 1.016h11.39c.562 0 1.017-.454 1.017-1.016 0-.563-.455-1.019-1.017-1.019h-8.933l20.499-20.471v8.924c0 .563.452 1.018 1.018 1.018.561 0 1.016-.455 1.016-1.018v-11.379c0-.132-.025-.264-.076-.387-.107-.249-.304-.448-.554-.551z"/>
												</svg>
											</i>
											<div class="meta-inner-wrapper">
												<span class="meta-item-label">Area</span>
												<span class="meta-item-value"><?php echo($hotProperty->land_size); ?><sub class="meta-item-unit"><?php echo($hotProperty->land_size_unit); ?></sub></span>
											</div>
										</div>
										<div class="meta-item">
											<i class="meta-item-icon icon-bed">
												<svg xmlns="http://www.w3.org/2000/svg" class="meta-icon-container" width="30" height="30" viewBox="0 0 48 48">
													<path class="meta-icon" fill="#0DBAE8" d="M21 48.001h-19c-1.104 0-2-.896-2-2v-31c0-1.104.896-2 2-2h19c1.106 0 2 .896 2 2v31c0 1.104-.895 2-2 2zm0-37.001h-19c-1.104 0-2-.895-2-1.999v-7.001c0-1.104.896-2 2-2h19c1.106 0 2 .896 2 2v7.001c0 1.104-.895 1.999-2 1.999zm25 37.001h-19c-1.104 0-2-.896-2-2v-31c0-1.104.896-2 2-2h19c1.104 0 2 .896 2 2v31c0 1.104-.896 2-2 2zm0-37.001h-19c-1.104 0-2-.895-2-1.999v-7.001c0-1.104.896-2 2-2h19c1.104 0 2 .896 2 2v7.001c0 1.104-.896 1.999-2 1.999z"/>
												</svg>
											</i>
											<div class="meta-inner-wrapper">
												<span class="meta-item-label">Bedrooms</span>
												<span class="meta-item-value"><?php echo($hotProperty->bedroom); ?></span>
											</div>
										</div>
										<div class="meta-item">
											<i class="meta-item-icon icon-bath">
												<svg xmlns="http://www.w3.org/2000/svg" class="meta-icon-container" width="30" height="30" viewBox="0 0 48 48">
													<path class="meta-icon" fill="#0DBAE8" d="M37.003 48.016h-4v-3.002h-18v3.002h-4.001v-3.699c-4.66-1.65-8.002-6.083-8.002-11.305v-4.003h-3v-3h48.006v3h-3.001v4.003c0 5.223-3.343 9.655-8.002 11.305v3.699zm-30.002-24.008h-4.001v-17.005s0-7.003 8.001-7.003h1.004c.236 0 7.995.061 7.995 8.003l5.001 4h-14l5-4-.001.01.001-.009s.938-4.001-3.999-4.001h-1s-4 0-4 3v17.005000000000003h-.001z"/>
												</svg>
											</i>
											<div class="meta-inner-wrapper">
												<span class="meta-item-label">Bathrooms</span>
												<span class="meta-item-value"><?php echo($hotProperty->bathroom); ?></span>
											</div>
										</div>
								</div>
								<!-- .property-description -->
							</article>
							<!-- .property-post-odd -->
						</div>
					<?php		
						}
                     ?>
                     <div class="clearfix"></div>
				</div>
                <!-- .row-odd -->
                <div class="row row-even zero-horizontal-margin">
					<?php 
						foreach($lastestProperties as $latestProperty){
							$picMap2 = $this->ApplicationModel->scan_dir("./uploads/properties/{$latestProperty->id}");
				?>
					
					<div class="col-xs-6 custom-col-xs-12">
                        <article class="row property-post-odd hentry property-listing-home property-listing-one meta-item-half">
                            <div class="property-thumbnail zero-horizontal-padding col-lg-6">
									<a href="#">
										<img class="img-responsive" src="<?php echo(base_url() . "uploads/properties/{$latestProperty->id}/{$picMap2[0]}"); ?>" alt="<?php echo($latestProperty->name); ?>" />
									</a>
                            </div>
                            <!-- .property-thumbnail -->
                            <div class="property-description clearfix col-lg-6">
                                <header class="entry-header">
                                    <h3 class="entry-title"><a href="<?php echo(base_url() . "welcome/viewProperty/{$latestProperty->id}"); ?>" rel="bookmark"><?php echo($latestProperty->name); ?></a></h3>
                                    <div class="price-and-status">
                                        <span class="price"><?php echo(money_format("%n ", $latestProperty->price)); ?></span><a href="#"><span class="property-status-tag"><?php echo($latestProperty->category); ?></span></a>
                                    </div>
                                </header>
                                <div class="property-meta entry-meta clearfix">
                                    <div class="meta-item">
                                        <i class="meta-item-icon icon-area">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="meta-icon-container" width="30" height="30" viewBox="0 0 48 48">
                                                <path class="meta-icon" fill="#0DBAE8" d="M46 16v-12c0-1.104-.896-2.001-2-2.001h-12c0-1.103-.896-1.999-2.002-1.999h-11.997c-1.105 0-2.001.896-2.001 1.999h-12c-1.104 0-2 .897-2 2.001v12c-1.104 0-2 .896-2 2v11.999c0 1.104.896 2 2 2v12.001c0 1.104.896 2 2 2h12c0 1.104.896 2 2.001 2h11.997c1.106 0 2.002-.896 2.002-2h12c1.104 0 2-.896 2-2v-12.001c1.104 0 2-.896 2-2v-11.999c0-1.104-.896-2-2-2zm-4.002 23.998c0 1.105-.895 2.002-2 2.002h-31.998c-1.105 0-2-.896-2-2.002v-31.999c0-1.104.895-1.999 2-1.999h31.998c1.105 0 2 .895 2 1.999v31.999zm-5.623-28.908c-.123-.051-.256-.078-.387-.078h-11.39c-.563 0-1.019.453-1.019 1.016 0 .562.456 1.017 1.019 1.017h8.935l-20.5 20.473v-8.926c0-.562-.455-1.017-1.018-1.017-.564 0-1.02.455-1.02 1.017v11.381c0 .562.455 1.016 1.02 1.016h11.39c.562 0 1.017-.454 1.017-1.016 0-.563-.455-1.019-1.017-1.019h-8.933l20.499-20.471v8.924c0 .563.452 1.018 1.018 1.018.561 0 1.016-.455 1.016-1.018v-11.379c0-.132-.025-.264-.076-.387-.107-.249-.304-.448-.554-.551z"/>
                                            </svg>
                                        </i>
                                        <div class="meta-inner-wrapper">
                                            <span class="meta-item-label">Area</span>
                                            <span class="meta-item-value"><?php echo($latestProperty->land_size); ?><sub class="meta-item-unit"><?php echo($latestProperty->land_size_unit); ?></sub></span>
                                        </div>
                                    </div>
                                    <div class="meta-item">
                                        <i class="meta-item-icon icon-bed">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="meta-icon-container" width="30" height="30" viewBox="0 0 48 48">
                                                <path class="meta-icon" fill="#0DBAE8" d="M21 48.001h-19c-1.104 0-2-.896-2-2v-31c0-1.104.896-2 2-2h19c1.106 0 2 .896 2 2v31c0 1.104-.895 2-2 2zm0-37.001h-19c-1.104 0-2-.895-2-1.999v-7.001c0-1.104.896-2 2-2h19c1.106 0 2 .896 2 2v7.001c0 1.104-.895 1.999-2 1.999zm25 37.001h-19c-1.104 0-2-.896-2-2v-31c0-1.104.896-2 2-2h19c1.104 0 2 .896 2 2v31c0 1.104-.896 2-2 2zm0-37.001h-19c-1.104 0-2-.895-2-1.999v-7.001c0-1.104.896-2 2-2h19c1.104 0 2 .896 2 2v7.001c0 1.104-.896 1.999-2 1.999z"/>
                                            </svg>
                                        </i>
                                        <div class="meta-inner-wrapper">
                                            <span class="meta-item-label">Bedrooms</span>
                                            <span class="meta-item-value"><?php echo($latestProperty->bedroom); ?></span>
                                        </div>
                                    </div>
                                    <div class="meta-item">
                                        <i class="meta-item-icon icon-bath">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="meta-icon-container" width="30" height="30" viewBox="0 0 48 48">
                                                <path class="meta-icon" fill="#0DBAE8" d="M37.003 48.016h-4v-3.002h-18v3.002h-4.001v-3.699c-4.66-1.65-8.002-6.083-8.002-11.305v-4.003h-3v-3h48.006v3h-3.001v4.003c0 5.223-3.343 9.655-8.002 11.305v3.699zm-30.002-24.008h-4.001v-17.005s0-7.003 8.001-7.003h1.004c.236 0 7.995.061 7.995 8.003l5.001 4h-14l5-4-.001.01.001-.009s.938-4.001-3.999-4.001h-1s-4 0-4 3v17.005000000000003h-.001z"/>
                                            </svg>
                                        </i>
                                        <div class="meta-inner-wrapper">
                                            <span class="meta-item-label">Bathrooms</span>
                                            <span class="meta-item-value"><?php echo($latestProperty->bathroom); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <!-- .property-meta -->
                            </div>
                            <!-- .property-description -->
                        </article>
                        <!-- .property-post-odd -->
                    </div>
                
				<?php			
						}
					?>
                </div>
                <!-- .row-even -->
            </div>
            <div class="clearfix"></div>
            <section id="listing" class="submit-property submit-property-one" style="background: url(<?php echo(base_url() . "assets/"); ?>images/demo/hiw-bg.jpg) no-repeat center top;  background-size: cover;">
                <div class="container">
                    <header class="submit-property-header">
                        <h3 class="sub-title">Welcome</h3>
                        <h2 class="title">Add Your Property to Our Listing</h2>
                        <p>
                           We are a property listing website that helps real estate developers and sellers market their properties to potential buyers in Nigeria and abroad. 
                        </p>
                        
                        <p>We have a huge buyer base that will ensure your property gets sold quickly, So get started with these simple steps</p>
                        
                    </header>
                    <div class="row submit-property-placeholders">
                        <div class="col-sm-4 submit-property-placeholder">
                            <div class="image-wrapper">
                                <a href="#"><img src="<?php echo(base_url() . "assets/"); ?>images/demo/icon-1.svg" alt="Icon"/></a>
                            </div>
                            <h3 class="submit-property-title">Register</h3>
                            <p>
                                Send an email to <a style="color: #ffffff" href="mailto:listwithus@connectsellerng.com">listwithus@connectsellerng.com</a> with subjet LISTINGS
                            </p>
                        </div>
                        <div class="col-sm-4 submit-property-placeholder">
                            <div class="image-wrapper">
                                <a href="#"><img src="<?php echo(base_url() . "assets/"); ?>images/demo/icon-2.svg" alt="Icon"/></a>
                            </div>
                            <h3 class="submit-property-title">Fill Up Property Details</h3>
                            <p>
                                We will respond to your email, with what is needed to have your property listed on ConnectsellerNG
                            </p>
                        </div>
                        <div class="col-sm-4 submit-property-placeholder">
                            <div class="image-wrapper">
                                <a href="#"><img src="<?php echo(base_url() . "assets/"); ?>images/demo/icon-3.svg" alt="Icon"/></a>
                            </div>
                            <h3 class="submit-property-title">You are Done!</h3>
                            <p>
                                You are done and your property will be listed on connectsellerng!!!
                            </p>
                        </div>
                    </div>
                    <div class="text-center">
                        <a class="btn-large btn-green" href="mailto:listwithus@connectsellerng.com">Submit Your Property</a>
                    </div>
                </div>
                <!-- .container -->
            </section>
            <!-- .submit-property-section -->
            <div class="featured-properties featured-properties-one">
                <div class="container">
                    <div class="row zero-horizontal-margin">
						<?php
							foreach($rentProperties as $rentProperty){
								$picMap3 = $this->ApplicationModel->scan_dir("./uploads/properties/{$rentProperty->id}");
						?>
							<div class="zero-horizontal-padding col-xs-6 col-md-3">
								<article class="hentry featured-property-post featured-property-post-even">
									<div class="property-thumbnail">
										<a href="<?php echo(base_url() . "welcome/viewProperty/{$rentProperty->id}"); ?>"><img class="img-responsive" src="<?php echo(base_url() . "uploads/properties/{$rentProperty->id}/{$picMap3[0]}"); ?>" alt="Thumbnail"></a>
									</div>
									<!-- .property-thumbnail -->
									<div class="property-description">
										<header class="entry-header">
											<h4 class="entry-title"><a href="#" rel="bookmark"><?php echo($rentProperty->name); ?></a></h4>
											<div class="price-and-status">
												<span class="price"><?php echo(money_format("%n ", $rentProperty->price)); ?></span><a href="#"><span class="property-status-tag"><?php echo($rentProperty->category); ?></span></a>
											</div>
										</header>
									</div>
									<!-- .property-description -->
								</article>
							</div>
						<?php		
							}
						?>
                    </div>
                    <!-- .row -->
                </div>
                <!-- .container -->
            </div>
            <!-- .featured-properties -->
            <section class="partners">
                <div class="container">
                    <div class="row zero-horizontal-margin">
                        <div class="col-xs-12">
                            <h3 class="title">
								We market properties for these <span>prestigious real estate developers</span> in Nigeria
                            </h3>
                            <ul class="list-grid-layout list-unstyled">
                                <li><img class="img-responsive" src="<?php echo(base_url() . "assets/"); ?>images/partner/1.png" alt="<?php echo($appName); ?>"></li>
                                <li><img class="img-responsive" src="<?php echo(base_url() . "assets/"); ?>images/partner/2.png" alt="<?php echo($appName); ?>"></li>
                                <li><img class="img-responsive" src="<?php echo(base_url() . "assets/"); ?>images/partner/3.png" alt="<?php echo($appName); ?>"></li>
                                <li><img class="img-responsive" src="<?php echo(base_url() . "assets/"); ?>images/partner/4.png" alt="<?php echo($appName); ?>"></li>
                                <li><img class="img-responsive" src="<?php echo(base_url() . "assets/"); ?>images/partner/5.png" alt="<?php echo($appName); ?>"></li>
                                <li><img class="img-responsive" src="<?php echo(base_url() . "assets/"); ?>images/partner/6.png" alt="<?php echo($appName); ?>"></li>
                                <li><img class="img-responsive" src="<?php echo(base_url() . "assets/"); ?>images/partner/7.png" alt="<?php echo($appName); ?>"></li>
                                <li><img class="img-responsive" src="<?php echo(base_url() . "assets/"); ?>images/partner/8.png" alt="<?php echo($appName); ?>"></li>
                                <li><img class="img-responsive" src="<?php echo(base_url() . "assets/"); ?>images/partner/9.png" alt="<?php echo($appName); ?>"></li>
                                <li><img class="img-responsive" src="<?php echo(base_url() . "assets/"); ?>images/partner/10.png" alt="<?php echo($appName); ?>"></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- .container -->
            </section>
            <!-- .partners -->
        </main>
        <!-- .site-main -->
