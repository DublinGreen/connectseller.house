<!-- .site-header -->
<div class="page-head " style="background: url(<?php echo(base_url()); ?>assets/images/banner.jpg) #494c53 no-repeat center top;  background-size: cover;">
    <div class="container">
        <div class="page-head-content">
            <h2 class="page-title"><span><?php echo("{$pageTitle} {$appName}"); ?></span></h2>
        </div>
    </div>
</div>
<!-- .page-head -->
<div id="content-wrapper" class="site-content-wrapper site-pages">
    <div id="content" class="site-content layout-boxed">
        <div class="container">
            <div class="row">
                <div class="col-md-9 site-main-content">
                    <main id="main" class="site-main default-page clearfix">
                        <article class="clearfix hentry">
                            <div class="entry-content clearfix">
								<h3>OUR VISION</h3><hr>
                             
                             
									<div class="form-wrapper">
										<div class="form-heading clearfix">
											<span><i class="fa fa-sign-in"></i>Login</span>
										</div>
										<form id="login-form" action="<?php echo(base_url() . "welcome/login"); ?>" method="post" enctype="multipart/form-data">
											<?php
												if(!empty($warning)){
											?>
												<p class="text-center text-warning"><?php echo($warning); ?></p>
											<?php
												}
											?>
											<div class="form-element">
												<?php echo form_error('email'); ?>
												<label class="login-form-label">Email</label>
												<input value="<?php echo set_value('email'); ?>" name="email" type="email" class="login-form-input login-form-input-common required" autofocus="" title="* You registered email." placeholder="Email">
											</div>
											<div class="form-element">
											 	<?php echo form_error('password'); ?>
												<label class="login-form-label">Password</label>
												<input value="<?php echo set_value('password'); ?>" name="password" type="password" class="login-form-input login-form-input-common required" placeholder="Password">
											</div>
											<div class="form-element">
												<input type="submit" class="login-form-submit login-form-input-common" value="Login">
											</div>
										</form>
										<div class="clearfix">
										</div>
								</div>
				
                            </div>
                            <footer class="entry-footer"></footer>
                        </article>
					</main>
                    <!-- .site-main -->
                </div>
                <!-- .site-main-content -->
                <div class="col-md-3 site-sidebar-content">
                    <aside class="sidebar">
                         <!--<section class="widget widget_search">
                            <form method="get" class="search-form" action="#">
                                <label>
                                    <span class="screen-reader-text">Search for:</span>
                                    <input type="search" class="search-field" placeholder="Search …" value="" name="s" title="Search for:">
                                </label>
                                <input type="submit" class="search-submit" value="Search">
                            </form>
                        </section>-->
                        <section class="widget clearfix widget_lc_taxonomy">
                            <h3 class="widget-title">Property Types</h3>
                            <ul>
								<li>
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
                            </ul>
                        </section>
                    </aside>
                    <!-- .sidebar -->
                </div>
                <!-- .site-sidebar-content -->
            </div>
            <!-- .row -->
        </div>
        <!-- .container -->
    </div>
    <!-- .site-content -->
</div>
<!-- .site-content-wrapper -->
