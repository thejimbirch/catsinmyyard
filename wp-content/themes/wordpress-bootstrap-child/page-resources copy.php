<?php get_header(); ?>
<div id="content" class="clearfix">
    <div id="main" class="clearfix" role="main">
        <div class="container">
            <div class="row">
                <div class="col-sm-10 col-sm-offset-2">
                    <h1><?php the_title(); ?></a></h1>
                    <?php
                      //for a given post type, return all
                      $post_type = 'resource';
                      $tax = 'resource-type';
                      $tax_terms = get_terms($tax);
                      if ($tax_terms) {
                        foreach ($tax_terms as $tax_term) {
                          $args=array(
                            'post_type' => $post_type,
                            "$tax" => $tax_term->slug,
                            'post_status' => 'publish',
                            'posts_per_page' => -1,
                            'caller_get_posts'=> 1
                          );

                          $my_query = null;
                          $my_query = new WP_Query($args);
                          if( $my_query->have_posts() ) {
                            // echo 'List of '.$post_type . ' where the taxonomy '. $tax . '  is '. $tax_term->name;
                            echo '<h3><a href="/'.$tax . '/'. $tax_term->slug . '">'. $tax_term->name .'</a></h3>';
                            while ($my_query->have_posts()) : $my_query->the_post(); ?>
                              <!--<p><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></p>-->
                              <?php
                            endwhile;
                          }
                          wp_reset_query();
                        }
                      }
                    ?>
                </div>
            </div>
        </div>
    </div><!-- end #main -->
</div><!-- end #content -->
<?php get_footer(); ?>