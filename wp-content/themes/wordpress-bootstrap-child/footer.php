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
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-36855632-1', 'auto');
  ga('send', 'pageview');

</script>
</body>
</html>