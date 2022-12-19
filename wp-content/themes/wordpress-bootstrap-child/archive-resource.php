<?php get_header(); ?>
<div id="content" class="clearfix">
    <div class="container">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-2">
                <h1 class="page-title"><?php single_cat_title(); ?></h1>
            </div>
        </div>
    </div>
    <div id="main" class="clearfix" role="main">
        <?php $loop = new WP_Query( array( 'post_type' => 'resource', 'posts_per_page' => 10 ) ); ?>
            <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
                    <div class="container">
                        <div class="row">
                            <aside class="col-xs-2 col-md-offset-2 post_sidebar">
                                <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail(); ?></a>
                            </aside>
                            <section class="col-xs-10 col-md-8 post_content">
                                <header><h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2></header>
                                <?php the_excerpt(); ?>
                            </section>
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
        <?php wp_reset_query(); ?>
    </div><!-- end #main -->
</div><!-- end #content -->
<?php get_footer(); ?>