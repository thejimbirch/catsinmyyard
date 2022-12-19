<?php get_header(); ?>
<div id="content" class="clearfix">
    <div id="main" class="clearfix" role="main">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
                    <?php
                    $post_thumbnail_id = get_post_thumbnail_id();
                    $featured_src = wp_get_attachment_image_src($post_thumbnail_id, 'wpbs-featured');
                    ?>
                    <div class="container">
                        <div class="row">
                            <section class="col-md-6 col-sm-9 col-md-push-4 col-sm-push-3 post_content">
                                <header><h1><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1></header>
                                <?php the_content(__("Read more &raquo;", "wpbootstrap")); ?>
                            </section>
                            <aside class="col-md-3 col-lg-offset-1 col-md-pull-6 col-sm-pull-9 post_sidebar">
                                <div class="h3 meta-share">Share</div>
                                <?php echo really_simple_share_publish(); ?>
                            </aside>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-md-offset-4 col-sm-offset-3">
                                <?php $withcomments = "1"; comments_template(); // Get wp-comments.php template ?>
                            </div>
                        </div>
                    </div>
                </article>
            <?php endwhile; ?>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div type="button" class="btn btn-default btn-sm pull-left" style="margin-bottom:20px;max-width:300px;white-space:normal;">
                          <?php previous_post('< %', 'Previous: ', 'yes'); ?>
                        </div>
                        <div type="button" class="btn btn-default btn-sm pull-right" style="margin-bottom:20px;max-width:300px;white-space:normal;">
                          <?php next_post('% > ', 'Next: ', 'yes'); ?>
                        </div>
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