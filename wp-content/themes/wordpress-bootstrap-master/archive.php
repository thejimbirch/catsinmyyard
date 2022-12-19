<?php get_header(); ?>
<div id="content" class="clearfix">
    <div id="main" class="clearfix" role="main">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
                    <?php
                    $post_thumbnail_id = get_post_thumbnail_id();
                    $featured_src = wp_get_attachment_image_src($post_thumbnail_id, 'wpbs-featured');
                    ?>
                    <header style="background: url(<?php echo $featured_src[0]; ?>) no-repeat;background-size:cover;">
                        <h1><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
                    </header>
                    <div class="container">
                        <div class="row">
                            <aside class="post_sidebar col-sm-3">
                                <div class="meta">
                                    <div class="h3"><?php _e("Posted", "wpbootstrap"); ?><time datetime="<?php echo the_time('Y-m-j'); ?>" pubdate> <?php the_time('M j, Y'); ?></time></div>
                                    <p><?php _e("by ", "wpbootstrap"); ?><?php the_author_posts_link(); ?></p>
                                    <div class="h3"><?php _e("Filed under", "wpbootstrap"); ?></div>
                                    <p><?php the_category('<br />'); ?></p>
                                    <p><?php the_tags('<span class="label">', '</span><br /><span class="label">', '</span>'); ?></p>
                                </div>
                                <div class="h3">Share</div>
                                <?php echo really_simple_share_publish(); ?>
                            </aside>
                            <section class="col-sm-9 post_content">
                                <?php the_content(__("Read more &raquo;", "wpbootstrap")); ?>
                            </section> <!-- end article section -->		
                        </div>
                    </div>
                </article>
            <?php endwhile; ?>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <?php if (function_exists('page_navi')) { // if expirimental feature is active ?>
                            <?php page_navi(); // use the page navi function ?>
                                <?php } else { // if it is disabled, display regular wp prev & next links ?>
                            <nav class="wp-prev-next">
                                <ul class="pager">
                                    <li class="previous"><?php next_posts_link(_e('&laquo; Older Entries', "wpbootstrap")) ?></li>
                                    <li class="next"><?php previous_posts_link(_e('Newer Entries &raquo;', "wpbootstrap")) ?></li>
                                </ul>
                            </nav>
                        <?php } ?>
                        </div>
                    </div>
                </div>
        <?php else : ?>
            <article id="post-not-found">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <header><h1><?php _e("Not Found", "wpbootstrap"); ?></h1></header>
                            <section class="post_content"><p><?php _e("Sorry, but the requested resource was not found on this site.", "wpbootstrap"); ?></p></section>
                            <footer></footer>
                        </div>
                    </div>
                </div>
            </article><?php endif; ?>
    </div><!-- end #main -->
</div><!-- end #content -->
<?php get_footer(); ?>