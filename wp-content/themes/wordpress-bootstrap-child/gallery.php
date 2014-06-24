<div class="container">
            <footer role="contentinfo">
                <div id="inner-footer" class="clearfix">
                    <div id="widget-footer" class="clearfix row">
                        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer1') ) : ?><?php endif; ?>
                        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer2') ) : ?><?php endif; ?>
                        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer3') ) : ?><?php endif; ?>
                    </div>
                    <nav class="clearfix"><?php wp_bootstrap_footer_links(); // Adjust using Menus in Wordpress Admin ?></nav>
                    <p class="attribution">&copy; <?php bloginfo('name'); ?></p>
                </div> <!-- end #inner-footer -->
            </footer> <!-- end footer -->
        </div> <!-- end #container -->
        <!--[if lt IE 7 ]><script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script><script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script><![endif]-->
        <?php wp_footer(); // js scripts are inserted using this function ?>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="/wp-content/themes/wordpress-bootstrap-child/library/blueimp/js/jquery.blueimp-gallery.min.js"></script>
        <script src="/wp-content/themes/wordpress-bootstrap-child/library/bootstrap-image-gallery/js/bootstrap-image-gallery.min.js"></script>
        <!-- The Bootstrap Image Gallery lightbox, should be a child element of the document body -->
        <div id="blueimp-gallery" class="blueimp-gallery">
            <!-- The container for the modal slides -->
            <div class="slides"></div>
            <!-- Controls for the borderless lightbox -->
            <h3 class="title"></h3>
            <a class="prev">‹</a>
            <a class="next">›</a>
            <a class="close">×</a>
            <a class="play-pause"></a>
            <ol class="indicator"></ol>
            <!-- The modal dialog, which will be used to wrap the lightbox content -->
            <div class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" aria-hidden="true">&times;</button>
                            <h4 class="modal-title"></h4>
                        </div>
                        <div class="modal-body next"></div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left prev">
                                <i class="glyphicon glyphicon-chevron-left"></i>
                                Previous
                            </button>
                            <button type="button" class="btn btn-primary next">
                                Next
                                <i class="glyphicon glyphicon-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>