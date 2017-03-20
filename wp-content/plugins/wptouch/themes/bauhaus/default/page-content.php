<div class="<?php wptouch_post_classes(); ?>">
	<div class="post-page-head-area bauhaus">




        <div id="mobile-logo-title" class="site-title">

            <img src="<?php $global_images_dir; ?>/images/circle_logo.png" />

        </div>

        <a href="<?php wptouch_bloginfo( 'url' ); ?>" id="header-logo-my" class="header-center tappable">

            <img id="header-logo" src="<?php foundation_the_logo_image(); ?>" alt="logo image" />

        </a>
        <div class="taCenter header-text-holder">



            <?php

            echo '1' . $category_name_ . '2';


                if(strlen($cc_name) > 0){
                    echo '<span class="header-text"><span class="ptbold">'.$cc_name.'</span></span>';
                }else{
                    echo '<span class="header-text">Доставка продуктов за <span class="ptbold">1</span> час!</span>';
                }

            ?>


        </div>
	</div>

	<div class="post-page-content">



		<?php if ( bauhaus_should_show_thumbnail() && wptouch_has_post_thumbnail() ) { ?>
			<div class="post-page-thumbnail">
				<?php the_post_thumbnail('large', array( 'class' => 'post-thumbnail wp-post-image' ) ); ?>
			</div>
		<?php } ?>

        <?php wptouch_the_content() ; ?>

	</div>
</div>