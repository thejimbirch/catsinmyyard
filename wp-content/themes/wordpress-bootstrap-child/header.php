<!DOCTYPE html>
<!--[if IEMobile 7 ]> <html <?php language_attributes(); ?>class="no-js iem7"> <![endif]-->
<!--[if lt IE 7 ]> <html <?php language_attributes(); ?> class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html <?php language_attributes(); ?> class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html <?php language_attributes(); ?> class="no-js ie8"> <![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)|!(IEMobile)|!(IE)]><!--><html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
    <head>
        <meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    	<title><?php wp_title( '|', true, 'right' ); ?></title>	
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<!--[if lt IE 9]><script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script><![endif]-->
            <!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
        <?php wp_head(); ?>
        <?php if ( has_post_thumbnail() && is_single() ) { ?>
            <?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
                <meta property="og:image" content="<?php echo $url; ?>" />
            <?php } elseif ( has_post_thumbnail() && is_front_page() ) { ?>
                <meta property="og:image" content="http://www.catsinmyyard.com/wp-content/uploads/2015/01/VColony2.jpg" />
                <meta property="og:image" content="http://www.catsinmyyard.com/wp-content/themes/wordpress-bootstrap-child/library/img/Cats-In-My-Yard-Logo-1024.png" />
                <meta property="og:image" content="http://catsinmyyard.com/wp-content/uploads/2010/06/Cats-In-My-Yard-1024x651.jpg" />
            <?php } else { ?>
                <meta property="og:image" content="http://www.catsinmyyard.com/wp-content/uploads/2015/01/VColony2.jpg" />
                <meta property="og:image" content="http://www.catsinmyyard.com/wp-content/themes/wordpress-bootstrap-child/library/img/Cats-In-My-Yard-Logo-1024.png" />
                <meta property="og:image" content="http://catsinmyyard.com/wp-content/uploads/2010/06/Cats-In-My-Yard-1024x651.jpg" />
        <?php }?>
        <script src="//ajax.googleapis.com/ajax/libs/webfont/1.4.7/webfont.js"></script>
        <script>
          WebFont.load({
            google: {
              families: ['Open Sans', 'Oswald']
            }
          });
        </script>
    </head>
    <body <?php body_class(); ?>>
        <header role="banner">
            <div class="navbar navbar-default">
		<div class="container">
                    <div class="row">
                        <div class="navbar-header col-sm-2">
                            <a class="navbar-brand" title="<?php echo get_bloginfo('description'); ?>" href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a>
                            <span class="h2"><a href="<?php echo home_url(); ?>" title="Cats In My Yard"><?php bloginfo('name'); ?></a></span>
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                                <span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="collapse navbar-collapse navbar-responsive-collapse">
                            <div class="col-sm-8">
                                <span class="h2 hidden-header"><a href="<?php echo home_url(); ?>" title="Cats In My Yard"><?php bloginfo('name'); ?></a></span>
                                <?php wp_bootstrap_main_nav(); // Adjust using Menus in Wordpress Admin ?>
                            </div>
                            <div class="col-sm-2 search-container">
                                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" style="text-align:right;">
                                <input type="hidden" name="cmd" value="_s-xclick">
                                <input type="hidden" name="hosted_button_id" value="T6HGC3AKK5PAL">
                                <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                                <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                                </form>
                                <?php //if(of_get_option('search_bar', '1')) {?>
                                    <form class="navbar-form navbar-right" role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
                                        <div class="form-group">
                                            <input name="s" id="s" type="text" class="search-query form-control" placeholder="<?php _e('Search','wpbootstrap'); ?>">
                                        </div>
                                    </form>
                                <?php //} ?>
                            </div>
                        </div>
                    </div><!-- end row -->
                </div> <!-- end .container -->
            </div> <!-- end .navbar -->
	</header> <!-- end header -->