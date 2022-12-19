<?php get_header(); ?>
<div id="content" class="clearfix">
    <div id="main" class="clearfix" role="main">
        <div class="container">
            <div class="row">
                <div class="col-sm-10 col-sm-offset-2">
                    <h1><?php the_title(); ?></a></h1>
                    <?php
                      $args = array(
                        'orderby' => 'name',
                        'order' => 'ASC'
                        );
                      $categories = get_categories(array(taxonomy => 'resource-type'));
                        foreach($categories as $category) { 
                          echo '<h3><a href="/' . $category->taxonomy . '/' . $category->slug . '">' . $category->name . '</a> </h3>';
                          echo '<p>' . $category->description . '</p>'; } 
                      ?>
                </div>
            </div>
        </div>
    </div><!-- end #main -->
</div><!-- end #content -->
<?php get_footer(); ?>