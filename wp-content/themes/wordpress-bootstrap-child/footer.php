<footer role="contentinfo">
    <div class="container">
        <div class="row">
            <div class="col-sm-9-col-offset-3">
                <p class="attribution text-right clearfix">&copy; <?php bloginfo('name'); ?> - Helping Stray and Feral Cats</p>
                <ul class="social-icons clearfix">
                    <li class="facebook"><a title="Cats In My Yard on Facebook" href="https://www.facebook.com/catsinmyyard"><img alt="Cats In My Yard on Facebook" src="/wp-content/social/facebook.png"></a></li>
                    <li><a title="Cats In My Yard on Google+" href="https://plus.google.com/104427961235013051576"><img alt="Cats In My Yard on Google+" src="/wp-content/social/google-plus.png"></a></li>
                    <li><a title="Cats In My Yard on Instagram" href="http://instagram.com/catsinmyyard"><img alt="Cats In My Yard on Instagram" src="/wp-content/social/instagram.png"></a></li>
                    <li><a title="Cats In My Yard on Pinterest" href="https://pinterest.com/catsinmyyard/"><img alt="Cats In My Yard on Pinterest" src="/wp-content/social/pinterest.png"></a></li>
                    <li><a title="Cats In My Yard on Twitter" href="https://twitter.com/catsinmyyard"><img alt="Cats In My Yard on Twitter" src="/wp-content/social/twitter.png"></a></li>
                    <li><a title="Cats In My Yard on Youtube" href="http://www.youtube.com/catsinmyyard"><img alt="Cats In My Yard on Youtube" src="/wp-content/social/youtube.png"></a></li>
                    <li><a title="Vansassa on Flickr" href="http://www.flickr.com/vansassa"><img alt="Vansassa on Flickr" src="/wp-content/social/flickr.png"></a></li>
                    <li><a title="Subscribe by RSS" href="/feed"><img alt="Subscribe by RSS" src="/wp-content/social/rss.png"></a></li>
                    <li><a title="Subscribe by Email" href="http://feedburner.google.com/fb/a/mailverify?uri=CatsInMyYard&amp;loc=en_US"><img alt="Subscribe by Email" src="/wp-content/social/email.png"></a></li>
                </ul>
                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer1')) : ?><?php endif; ?>
                
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