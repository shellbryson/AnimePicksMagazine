            <footer class="footer" role="contentinfo">
                <div id="inner-footer" class="wrap clearfix">
                    <nav role="navigation">
                        <?php bones_footer_links(); ?>
                    </nav>
                    <p class="source-org copyright">&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>.</p>
                </div>
            </footer> <!-- end footer -->
        
        </div> <!-- end #container -->
        <div id="debugBar">
            <div class="_base _responsive">base +</div>
            <div class="_1240up _responsive">1240up</div>
            <div class="_1030up _responsive">1030up</div>
            <div class="_768up _responsive">768up</div>
            <div class="_481up _responsive">481up</div>
        </div>
        
        <?php wp_footer(); ?>

    </body>
</html>