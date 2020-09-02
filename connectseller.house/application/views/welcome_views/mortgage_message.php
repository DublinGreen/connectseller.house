<!-- .site-header -->
<div class="page-head " style="background: url(<?php echo(base_url()); ?>assets/images/banner.jpg) #494c53 no-repeat center top;  background-size: cover;">
    <div class="container">
        <div class="page-head-content">
            <h2 class="page-title"><span><?php echo($appName); ?> Mortgage</span></h2>
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
								<h1>Mortgage</h1><hr>
                                <p>There’s Mortgage available for buyers who intend to buy a property
using mortgage as ConnectsellerNG will connect buyers who are
interested in buying any property listed on the website using a
mortgage facility</p>

								<br>
								<p>Connectseller will also connect interested buyers to several
reputable mortgage institutions in Nigeria with very interesting
mortgage interest rates as low as 18% as buyers can pay gradually for
their dream homes while they live in the property.</p><br>
							
							<p>Contact us if you’re interested in buying a property using mortgage
and we will send you a mortgage checklist to ensure that you qualify
to pick up a mortgage which will make it easier for you to buy your
dream home.</p><br>

							
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
