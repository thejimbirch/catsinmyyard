<div class="container">
    <div class="row">
        <div id="sidebar1" class="col-sm-12" role="complementary">
            <?php if (is_active_sidebar('sidebar1')) : ?>
                <?php dynamic_sidebar('sidebar1'); ?>
            <?php else : ?>
            <?php endif; ?>
        </div>
    </div>
</div>