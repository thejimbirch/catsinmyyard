<?php
/*
Template Name: Right Sidebar Page
*/
?>

<?php get_header(); ?>
<div id="content" class="clearfix">
    <div id="main" class="clearfix" role="main">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
                    <div class="container">
                        <div class="row">
                            <section class="col-sm-7 col-sm-offset-2 post_content">
                                <header><h1><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1></header>
                                <?php the_content(__("Read more &raquo;", "wpbootstrap")); ?>
                            </section>
                            <aside class="col-sm-3 post_sidebar">
                                <?php get_sidebar(); // sidebar 1 ?>
                            </aside>
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