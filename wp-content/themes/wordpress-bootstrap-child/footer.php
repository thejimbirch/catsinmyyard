<footer role="contentinfo">
    <div class="container">
        <div class="row">
            <div class="col-sm-9-col-offset-3">
                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer1')) : ?><?php endif; ?>
                <p class="attribution pull-right">&copy; <?php bloginfo('name'); ?> - Helping Stray and Feral Cats</p>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <nav class="clearfix"><?php wp_bootstrap_footer_links(); // Adjust using Menus in Wordpress Admin  ?></nav>
            </div>
        </div>
    </div>
</footer>
<!--[if lt IE 7 ]><script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script><script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script><![endif]-->
<?php wp_footer(); // js scripts are inserted using this function ?>
</body>
</html>