<?php  setlocale(LC_MONETARY,"en_NG"); ?>
<div class="clearfix"></div>
<div id="content-wrapper" class="site-content-wrapper" style="margin-top: 15%;">
    <div id="content" class="site-content layout-boxed">
        <main id="main" class="site-main">
            <div class="container">
                <div class="row row-even zero-horizontal-margin">
					<h3><?php echo($appName .  "  <span class='property-status-tag'>". "{$propertyType}"); ?></span></h3>
					<?php 
						foreach($propertiesByType as $property){
							$picMap2 = $this->ApplicationModel->scan_dir("./uploads/properties/{$property->id}");
				?>
					
					<div class="col-xs-6 custom-col-xs-12">
                        <article class="row property-post-odd hentry property-listing-home property-listing-one meta-item-half">
                            <div class="property-thumbnail zero-horizontal-padding col-lg-6">
									<a href="#">
										<img class="img-responsive" src="<?php echo(base_url() . "uploads/properties/{$property->id}/{$picMap2[0]}"); ?>" alt="<?php echo($property->name); ?>" />
									</a>
                            </div>
                            <!-- .property-thumbnail -->
                            <div class="property-description clearfix col-lg-6">
                                <header class="entry-header">
                                    <h3 class="entry-title"><a href="<?php echo(base_url() . "welcome/viewProperty/{$property->id}"); ?>" rel="bookmark"><?php echo($property->name); ?></a></h3>
                                    <div class="price-and-status">
                                        <span class="price"><?php echo(money_format("%n ", $property->price)); ?></span><a href="#"><span class="property-status-tag"><?php echo($property->category); ?></span></a>
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
                                            <span class="meta-item-value"><?php echo($property->land_size); ?><sub class="meta-item-unit"><?php echo($property->land_size_unit); ?></sub></span>
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
                                            <span class="meta-item-value"><?php echo($property->bedroom); ?></span>
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
                                            <span class="meta-item-value"><?php echo($property->bathroom); ?></span>
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
        </main>
        <!-- .site-main -->
