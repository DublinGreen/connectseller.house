<?php
	setlocale(LC_MONETARY,"en_NG");
?>
<!-- .site-header -->
<div class="page-head " style="background: url(<?php echo(base_url() . "assets/"); ?>images/banner.jpg) #494c53 no-repeat center top;  background-size: cover;">
    <div class="breadcrumb-wrapper">
        <div class="container">
            <nav>
                <ol class="breadcrumb">
                    <li><a href="<?php echo(base_url()); ?>">Home</a></li>
                    <li><a href="<?php echo(base_url() . "welcome/viewByType/{$property->type}"); ?>"><?php echo($property->type); ?></a></li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- .breadcrumb-wrapper -->
</div>
<!-- .page-head -->
<div id="content-wrapper" class="site-content-wrapper site-pages">
    <div id="content" class="site-content layout-boxed">
        <div class="container">
            <div class="container-property-single clearfix">
                <div class="col-lg-8 zero-horizontal-padding property-slider-wrapper">
                    <div class="single-property-slider gallery-slider flexslider">
                        <ul class="slides">
							<?php 
								foreach($sliderMap as $picture){
									$cleanName  = $property->name;
									$cleanName = strstr($cleanName, '.', true);
							?>
									<li><img src="<?php echo(base_url() . "uploads/properties/{$property->id}/{$picture}"); ?>" alt="<?php echo($cleanName); ?>"></li>
							<?php 
								}
							?>
                        </ul>
                    </div>
                    <div id="property-featured-image" class="only-for-print">
                        <img src="<?php echo(base_url() . "assets/"); ?>images/property/property-interior-6-850x570.jpg" alt="Villa in Coral Gables">
                    </div>
                </div>
                <div class="col-lg-4 zero-horizontal-padding property-title-wrapper">
                    <div class="single-property-wrapper">
                        <header class="entry-header single-property-header">
                            <h1 class="entry-title single-property-title"><?php echo($property->name); ?></h1>
                            <span class="single-property-price price"><?php echo(money_format("%n ", $property->price)); ?></span>
                        </header>
                        <div class="property-meta entry-meta clearfix ">
                            <div class="meta-item">
                                <i class="meta-item-icon icon-pid">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="meta-icon-container" width="30" height="30" viewBox="0 0 48 48">
                                        <path class="meta-icon" fill-rule="evenodd" clip-rule="evenodd" fill="#0DBAE8" d="M24 48c-13.255 0-24-10.744-24-24 0-13.255 10.745-24 24-24 13.256 0 24 10.746 24 24 0 13.256-10.744 24-24 24zm7.207-29.719h-.645l.365-2.163c.168-1.067-.699-2.107-1.795-2.107-.896 0-1.654.59-1.793 1.49l-.477 2.78h-3.787l.365-2.163c.167-1.067-.702-2.107-1.796-2.107-.897 0-1.653.59-1.795 1.49l-.477 2.78h-1.599c-.981 0-1.794.814-1.794 1.797s.813 1.798 1.794 1.798h.981l-.7 4.156h-1.263c-.981 0-1.794.814-1.794 1.797s.813 1.797 1.794 1.797h.646l-.39 2.274c-.197 1.18.701 2.105 1.794 2.105 1.01 0 1.655-.73 1.796-1.488l.504-2.893h3.786l-.393 2.276c-.197 1.066.7 2.105 1.796 2.105.896 0 1.654-.617 1.793-1.488l.506-2.893h1.6c.979 0 1.793-.814 1.793-1.797s-.814-1.797-1.793-1.797h-.984l.703-4.156h1.26c.984 0 1.797-.815 1.797-1.798s-.814-1.795-1.798-1.795zm-9.449 7.75l.702-4.156h3.784l-.699 4.156h-3.787z"></path>
                                    </svg>
                                </i>
                                <div class="meta-inner-wrapper">
                                    <span class="meta-item-label">Property ID</span>
                                    <span class="meta-item-value">CS-<?php echo(date("Y")); ?>-<?php echo($property->id); ?></span>
                                </div>
                            </div>
                            <div class="meta-item">
                                <i class="meta-item-icon icon-area">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="meta-icon-container" width="30" height="30" viewBox="0 0 48 48">
                                        <path class="meta-icon" fill="#0DBAE8" d="M46 16v-12c0-1.104-.896-2.001-2-2.001h-12c0-1.103-.896-1.999-2.002-1.999h-11.997c-1.105 0-2.001.896-2.001 1.999h-12c-1.104 0-2 .897-2 2.001v12c-1.104 0-2 .896-2 2v11.999c0 1.104.896 2 2 2v12.001c0 1.104.896 2 2 2h12c0 1.104.896 2 2.001 2h11.997c1.106 0 2.002-.896 2.002-2h12c1.104 0 2-.896 2-2v-12.001c1.104 0 2-.896 2-2v-11.999c0-1.104-.896-2-2-2zm-4.002 23.998c0 1.105-.895 2.002-2 2.002h-31.998c-1.105 0-2-.896-2-2.002v-31.999c0-1.104.895-1.999 2-1.999h31.998c1.105 0 2 .895 2 1.999v31.999zm-5.623-28.908c-.123-.051-.256-.078-.387-.078h-11.39c-.563 0-1.019.453-1.019 1.016 0 .562.456 1.017 1.019 1.017h8.935l-20.5 20.473v-8.926c0-.562-.455-1.017-1.018-1.017-.564 0-1.02.455-1.02 1.017v11.381c0 .562.455 1.016 1.02 1.016h11.39c.562 0 1.017-.454 1.017-1.016 0-.563-.455-1.019-1.017-1.019h-8.933l20.499-20.471v8.924c0 .563.452 1.018 1.018 1.018.561 0 1.016-.455 1.016-1.018v-11.379c0-.132-.025-.264-.076-.387-.107-.249-.304-.448-.554-.551z"></path>
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
                                        <path class="meta-icon" fill="#0DBAE8" d="M21 48.001h-19c-1.104 0-2-.896-2-2v-31c0-1.104.896-2 2-2h19c1.106 0 2 .896 2 2v31c0 1.104-.895 2-2 2zm0-37.001h-19c-1.104 0-2-.895-2-1.999v-7.001c0-1.104.896-2 2-2h19c1.106 0 2 .896 2 2v7.001c0 1.104-.895 1.999-2 1.999zm25 37.001h-19c-1.104 0-2-.896-2-2v-31c0-1.104.896-2 2-2h19c1.104 0 2 .896 2 2v31c0 1.104-.896 2-2 2zm0-37.001h-19c-1.104 0-2-.895-2-1.999v-7.001c0-1.104.896-2 2-2h19c1.104 0 2 .896 2 2v7.001c0 1.104-.896 1.999-2 1.999z"></path>
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
                                        <path class="meta-icon" fill="#0DBAE8" d="M37.003 48.016h-4v-3.002h-18v3.002h-4.001v-3.699c-4.66-1.65-8.002-6.083-8.002-11.305v-4.003h-3v-3h48.006v3h-3.001v4.003c0 5.223-3.343 9.655-8.002 11.305v3.699zm-30.002-24.008h-4.001v-17.005s0-7.003 8.001-7.003h1.004c.236 0 7.995.061 7.995 8.003l5.001 4h-14l5-4-.001.01.001-.009s.938-4.001-3.999-4.001h-1s-4 0-4 3v17.005000000000003h-.001z"></path>
                                    </svg>
                                </i>
                                <div class="meta-inner-wrapper">
                                    <span class="meta-item-label">Bathrooms</span>
                                    <span class="meta-item-value"><?php echo($property->bathroom); ?></span>
                                </div>
                            </div>
                            <div class="meta-item meta-property-type">
                                <i class="meta-item-icon icon-ptype">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="meta-icon-container" width="30" height="30" viewBox="0 0 48 48">
                                        <path class="meta-icon" fill-rule="evenodd" clip-rule="evenodd" fill="#0DBAE8" d="M24 48.001c-13.255 0-24-10.745-24-24.001 0-13.254 10.745-24 24-24s24 10.746 24 24c0 13.256-10.745 24.001-24 24.001zm10-27.001l-10-8-10 8v11c0 1.03.888 2.001 2 2.001h3.999v-9h8.001v9h4c1.111 0 2-.839 2-2.001v-11z"></path>
                                    </svg>
                                </i>
                                <div class="meta-inner-wrapper">
                                    <span class="meta-item-label">Type</span>
                                    <span class="meta-item-value"><?php echo($property->type); ?></span>
                                </div>
                            </div>
                            <div class="meta-item">
                                <i class="meta-item-icon icon-tag">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="meta-icon-container" width="30" height="30" viewBox="0 0 48 48">
                                        <path class="meta-icon" fill-rule="evenodd" clip-rule="evenodd" fill="#0DBAE8" d="M47.199 24.176l-23.552-23.392c-.504-.502-1.174-.778-1.897-.778l-19.087.09c-.236.003-.469.038-.696.1l-.251.1-.166.069c-.319.152-.564.321-.766.529-.497.502-.781 1.196-.778 1.907l.092 19.124c.003.711.283 1.385.795 1.901l23.549 23.389c.221.218.482.393.779.523l.224.092c.26.092.519.145.78.155l.121.009h.012c.239-.003.476-.037.693-.098l.195-.076.2-.084c.315-.145.573-.319.791-.539l18.976-19.214c.507-.511.785-1.188.781-1.908-.003-.72-.287-1.394-.795-1.899zm-35.198-9.17c-1.657 0-3-1.345-3-3 0-1.657 1.343-3 3-3 1.656 0 2.999 1.343 2.999 3 0 1.656-1.343 3-2.999 3z"></path>
                                    </svg>
                                </i>
                                <div class="meta-inner-wrapper">
                                    <span class="meta-item-label">Status</span>
                                    <span class="meta-item-value"><?php echo($property->category); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="favorite-and-print clearfix">
                        <a class="add-to-fav" href="<?php echo(base_url() . "wishlist/index/{$property->id}"); ?>" data-toggle="modal"><i class="fa fa-star"></i>&nbsp;&nbsp;Add to Favorites</a>
                        <a class="printer-icon" href="javascript:window.print()"><i class="fa fa-print"></i>&nbsp;&nbsp;Print</a>
                    </div>
                </div>
                <div class="col-md-8 site-main-content property-single-content">
                    <main id="main" class="site-main">
                        <article class="hentry clearfix">
                            <div class="entry-content clearfix">
                                <h4 class="fancy-title">Description</h4>
                                <div class="property-content">
                                    <p><?php echo($property->description); ?></p>
                                </div>
                                <div class="property-additional-details clearfix">
                                    <h4 class="fancy-title">Additional Details</h4>
                                    <ul class="property-additional-details-list clearfix">
										<li>
                                            <dl>
                                                <dt>Category</dt>
                                                <dd><?php echo(ucwords($property->category)); ?></dd>
                                            </dl>
                                        </li>
										<li>
                                            <dl>
                                                <dt>Type</dt>
                                                <dd><?php echo(ucwords($property->type)); ?></dd>
                                            </dl>
                                        </li>
										<!--<li>
                                            <dl>
                                                <dt>Toilets</dt>
                                                <dd><?php echo(ucwords($property->toilet)); ?></dd>
                                            </dl>
                                        </li>-->
                                        <li>
                                            <dl>
                                                <dt>Area</dt>
                                                <dd><?php echo(ucwords($property->area)); ?></dd>
                                            </dl>
                                        </li>
                                        <li>
                                            <dl>
                                                <dt>L.G.A</dt>
                                                <dd><?php echo(ucwords($property->lga)); ?></dd>
                                            </dl>
                                        </li>
                                        <li>
                                            <dl>
                                                <dt>State</dt>
                                                <dd><?php echo(ucwords($property->state)); ?></dd>
                                            </dl>
                                        </li>
								   </ul>
                                </div>
                            </div>
                        </article>
                        <div class="property-share-networks clearfix">
                            <h4 class="fancy-title">Share this Property</h4>
                            <div id="share-button-title" class="hide">Share</div>
                            <div class="share-this"></div>
                        </div>
                    </main>
                    <!-- .site-main -->
                </div>
                <!-- .site-main-content -->
                <div class="col-md-4 zero-horizontal-padding">
                    <aside class="sidebar sidebar-property-detail">
                        <section class="agent-sidebar-widget clearfix">
                            <div class="agent-content-wrapper agent-common-styles">
                                <div class="inner-wrapper clearfix">
                                    <figure class="agent-image">
                                        <a href="agent-single.html">
                                            <img width="220" height="220" src="<?php echo(base_url() . "assets/"); ?>images/agent/connect_agent.jpg" class="img-circle wp-post-image" alt="<?php echo($appName); ?>">
                                        </a>
                                    </figure>
                                    <h3 class="agent-name">
                                        <a href="agent-single.html"><?php echo(ucwords($connectSellerInfo->agent_name)); ?></a>
                                        <span>Property Marketing Company</span>
                                    </h3>
                                    <div class="agent-social-profiles">
                                        <a class="twitter" href="<?php echo($this->config->item('social_twitter')); ?>" target="_blank"><i class="fa fa-twitter fa-lg"></i></a>
                                        <a class="facebook" href="<?php echo($this->config->item('social_facebook')); ?>" target="_blank"><i class="fa fa-facebook fa-lg"></i></a>
                                        <a class="instagram" href="<?php echo($this->config->item('social_instagram')); ?>" target="_blank"><i class="fa fa-instagram fa-lg"></i></a>
                                    </div>
                                </div>
                                <ul class="agent-contacts-list">
									<li class="mobile">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="contacts-icon-container" width="24" height="24" viewBox="0 0 24 24">
                                            <path class="contacts-icon" fill-rule="evenodd" clip-rule="evenodd" fill="#0DBAE8" d="M17.001 23.999h-10.001c-1.657 0-3-1.343-3-2.999v-18c0-1.656 1.343-3 3-3h10.001c1.655 0 2.999 1.344 2.999 3v18c0 1.656-1.344 2.999-2.999 2.999zm.999-19.999c0-1.105-.896-2-2-2h-8c-1.105 0-2 .896-2 2v16c0 1.104.895 2 2 2h8c1.104 0 2-.896 2-2v-16zm-4 1h-4c-.552 0-1-.447-1-1 0-.552.448-1 1-1h4c.553 0 1.001.448 1.001 1 0 .553-.448 1-1.001 1zm-2 13c1.105 0 2 .672 2 1.499 0 .829-.895 1.501-2 1.501s-2-.672-2-1.501c0-.827.895-1.499 2-1.499z"/>
                                        </svg>
                                        <span>Office:</span><?php echo($connectSellerInfo->mobile); ?>
                                    </li>
                                    <li class="office">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="contacts-icon-container" width="24" height="24" viewBox="0 0 24 24">
                                            <path class="contacts-icon" fill-rule="evenodd" clip-rule="evenodd" fill="#0080BC" d="M1.027 4.846l-.018.37.01.181c.068 9.565 7.003 17.42 15.919 18.48.338.075 1.253.129 1.614.129.359 0 .744-.021 1.313-.318.328-.172.448-.688.308-1.016-.227-.528-.531-.578-.87-.625-.435-.061-.905 0-1.521 0-1.859 0-3.486-.835-4.386-1.192l.002.003-.076-.034c-.387-.156-.696-.304-.924-.422-3.702-1.765-6.653-4.943-8.186-8.896-.258-.568-1.13-2.731-1.152-6.009h.003l-.022-.223c0-1.727 1.343-3.128 2.999-3.128 1.658 0 3.001 1.401 3.001 3.128 0 1.56-1.096 2.841-2.526 3.079l.001.014c-.513.046-.914.488-.914 1.033 0 .281.251 1.028.251 1.028.015 0 .131.188.119.188-.194-.539 1.669 5.201 7.021 7.849-.001.011.636.309.636.309.47.3 1.083.145 1.37-.347.09-.151.133-.32.14-.488.356-1.306 1.495-2.271 2.863-2.271 1.652 0 2.991 1.398 2.991 3.12 0 .346-.066.671-.164.981-.3.594-.412 1.21.077 1.699.769.769 1.442-.144 1.442-.144.408-.755.643-1.625.643-2.554 0-2.884-2.24-5.222-5.007-5.222-1.947 0-3.633 1.164-4.46 2.858-2.536-1.342-4.556-3.59-5.656-6.344 1.848-.769 3.154-2.647 3.154-4.849 0-2.884-2.241-5.222-5.007-5.222-2.41 0-4.422 1.777-4.897 4.144l-.091.711z"/>
                                        </svg>
                                        <span>Office:</span><?php echo($connectSellerInfo->office); ?>
                                    </li>
                                    <li class="email">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="contacts-icon-container" width="24" height="24" viewBox="0 0 24 24">
                                            <path class="fax-fill-one" d="M6 20c0 1.105.896 2 2 2h8c1.104 0 2-.895 2-2v-8h-12v8zm2-6h8v2h-8v-2zm0 4h8v2h-8v-2zM17 2h-10c-1.104 0-2 .896-2 2v3h14v-3c0-1.105-.896-2-2-2z" fill="none"/>
                                            <circle cx="21" cy="11" r="1" fill="none"/>
                                            <path class="fax-fill-two" fill="#0080bc" d="M21.999 7h-.999v-5c0-1.105-.896-2-2-2h-14c-1.104 0-2 .895-2 2v5h-.999c-1.105 0-2 .896-2 2.001v7.999c0 1.104.895 2 2 2h.999v3c0 1.105.896 2 2 2h14c1.104 0 2-.895 2-2v-3h.999c1.104 0 2-.896 2-2v-7.999c0-1.105-.895-2.001-2-2.001zm-3.999 13c0 1.105-.896 2-2 2h-8c-1.104 0-2-.895-2-2v-8h12v8zm1-13h-14v-3c0-1.104.896-2 2-2h10c1.104 0 2 .895 2 2v3zm2 4.999c-.553 0-1-.448-1-1 0-.551.447-.999 1-.999s.999.448.999.999c0 .552-.446 1-.999 1zM8 14h8v2h-8zM8 18h8v2h-8z"/>
                                        </svg>
                                        <span>Email:</span><?php echo($connectSellerInfo->email); ?>
                                    </li>
                                    <!--<li class="map-pin">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="contacts-icon-container" width="40" height="40" viewBox="0 0 24 24">
                                            <path class="contacts-icon" fill-rule="evenodd" clip-rule="evenodd" fill="#000000" d="M12 23.999c.048 0-8-11.582-8-15.999 0-4.419 3.581-8 8-8s8 3.581 8 8c0 4.417-8.084 15.999-8 15.999zm0-19.001c-1.658 0-3.002 1.345-3.002 3.002 0 1.657 1.344 3.002 3.002 3.002 1.657 0 3.002-1.345 3.002-3.002 0-1.658-1.345-3.002-3.002-3.002z"/>
                                        </svg>
                                        900 Biscayne Blvd Way Miami, FL, USA
                                    </li>-->
                                </ul>
                                <!--<p>Donec ullamcorper nulla non metus auctor fringilla. Curabitur blandit tempus porttitor. Duis mollis, est non…</p>-->
                                <!--<a class="btn-default show-details" href="#">Connect To Seller<i class="fa fa-angle-right"></i></a>-->
                                
                                    
								<!-- Button trigger modal -->
								<button type="button" class="btn btn-primary btn-lg btn-default show-details" data-toggle="modal" data-target="#myModal">
								  <?php echo(strtoupper("Connect To Seller")); ?>
								</button>

							<!-- Modal -->
							<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
							  <div class="modal-dialog" role="document">
								<div class="modal-content" style="background-color: #0dbae8">
								  <div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h2 class="modal-title" id="myModalLabel">Contact <?php echo(ucwords($appName)); ?></h2>
								  </div>
								  <div class="modal-body">                
									<div class="agent-contact-form">
										<h3 class="agent-contact-form-title">Send your details and a representative will contact you soonest.</h3>
										<form id="agent-contact-form" class="contact-form-small" method="post" action="#" novalidate="novalidate">
											<div class="row">
												<div class="col-sm-6 left-field">
													<?php echo form_error('name'); ?>
													<input value="<?php echo set_value('name'); ?>" type="text" name="name" placeholder="Name" class="required" title="* Please provide your name" required>
												</div>
												<div class="col-sm-6 right-field">
													<?php echo form_error('number'); ?>
													<input value="<?php echo set_value('number'); ?>" type="text" name="number" placeholder="Telephone" class="required" title="* Please provide valid telephone" required>
												</div>
											</div>
											<?php echo form_error('email'); ?>
											<input value="<?php echo set_value('email'); ?>" type="text" name="email" placeholder="Email" class="email required" title="* Please provide valid email address" required>
											<?php echo form_error('message'); ?>
											<textarea name="message" class="required" placeholder="Message" title="* Please provide your message"><?php echo set_value('message'); ?></textarea>
											<input type="submit" id="submit-button" name="submit" class="btn-default btn-round" value="Send Message">
											<img src="images/ajax-loader.gif" id="ajax-loader" alt="Loading...">
										</form>
										<div id="error-container"></div>
										<div id="message-container">&nbsp;</div>
									</div>
								  </div>
								  <div class="modal-footer">
									<!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									<button type="button" class="btn btn-primary">Save changes</button>-->
								  </div>
								</div>
							  </div>
							</div>

                            </div>
                        </section>
                    </aside>
                    <!-- .sidebar -->
                </div>
                <!-- .site-sidebar-content -->
            </div>
            <!-- .container-property-single -->
        </div>
        <!-- .container -->
    </div>
    <!-- .site-content -->
</div>
<!-- .site-content-wrapper -->
