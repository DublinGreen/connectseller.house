<div class="homepage-slider slider-variation-one flexslider">
    <ul class="slides">
		<?php
			setlocale(LC_MONETARY,"en_NG");
			$slidersResultSet = $this->DatabaseModel->getSliders();
			foreach($slidersResultSet as $slider){
		?>
		 <li>
            <div class="slide-overlay hidden-xs">
                <div class="container">
                    <div class="slide-inner-container">
                        <div class="row">
                            <div class="col-lg-6">
                                <h3 class="slide-entry-title entry-title">
                                    <a href="#" rel="bookmark"><?php echo(ucwords($slider->name)); ?></a>
                                </h3>
                                <div class="price-and-status">
                                    <span class="price"><?php echo(money_format("%n ", $slider->price)); ?></span>
                                    <a href="#">
                                        <span class="property-status-tag"><?php echo(strtoupper($slider->duration)); ?></span>
                                    </a>
                                </div>
                            </div>
                            <div class="zero-padding visible-lg col-lg-6">
                                <div class="property-meta entry-meta clearfix ">
                                    <div class="meta-item">
                                        <i class="meta-item-icon icon-bed">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="meta-icon-container" width="30" height="30" viewBox="0 0 48 48">
                                                <path class="meta-icon" fill="#0DBAE8" d="M21 48.001h-19c-1.104 0-2-.896-2-2v-31c0-1.104.896-2 2-2h19c1.106 0 2 .896 2 2v31c0 1.104-.895 2-2 2zm0-37.001h-19c-1.104 0-2-.895-2-1.999v-7.001c0-1.104.896-2 2-2h19c1.106 0 2 .896 2 2v7.001c0 1.104-.895 1.999-2 1.999zm25 37.001h-19c-1.104 0-2-.896-2-2v-31c0-1.104.896-2 2-2h19c1.104 0 2 .896 2 2v31c0 1.104-.896 2-2 2zm0-37.001h-19c-1.104 0-2-.895-2-1.999v-7.001c0-1.104.896-2 2-2h19c1.104 0 2 .896 2 2v7.001c0 1.104-.896 1.999-2 1.999z"></path>
                                            </svg>
                                        </i>
                                        <div class="meta-inner-wrapper">
                                            <span class="meta-item-label">Bedrooms</span>
                                            <span class="meta-item-value"><?php echo($slider->bedroom); ?></span>
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
                                            <span class="meta-item-value"><?php echo($slider->bathroom); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <!-- .property-meta -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a href="#">
                <img src="<?php echo(base_url() . "uploads/"); ?>sliders/<?php echo($slider->picture); ?>" alt="<?php echo($slider->name); ?>">
            </a>
        </li>
		<?php		
			}
		?>
    </ul>
</div>
