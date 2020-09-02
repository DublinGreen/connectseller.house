<!-- .site-header -->
<div class="page-head " style="background: url(<?php echo(base_url()); ?>assets/images/banner.jpg) #494c53 no-repeat center top;  background-size: cover;">
    <div class="container">
        <div class="page-head-content">
            <h2 class="page-title"><span>My  <?php echo($this->config->item('application_project_name')); ?> Properties</span></h2>
        </div>
    </div>
</div>
<!-- .page-head -->
<div id="content-wrapper" class="site-content-wrapper site-pages">
    <div id="content" class="site-content layout-boxed">
        <div class="container">
            <div class="row">
                <div class="col-md-12 site-main-content">
                    <main id="main" class="site-main default-page clearfix">
                        <article class="clearfix hentry">
                            <div class="entry-content clearfix">
								<h3>MY PROPERTIES</h3><hr>
                               <?php echo($output); ?>
                            </div>
                            <footer class="entry-footer"></footer>
                        </article>
					</main>
                    <!-- .site-main -->
                </div>
                <!-- .site-main-content -->
            </div>
            <!-- .row -->
        </div>
        <!-- .container -->
    </div>
    <!-- .site-content -->
</div>
<!-- .site-content-wrapper -->
