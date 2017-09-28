</main>

<footer id="footer" class="<?php echo (booty_footer_class()); ?>">
    <?php echo booty_footer(); ?>
</footer>
</div><!-- end .w* -->
<div class="fa fa-chevron-up" id="gotoTop"></div>
</div><!-- end #wrapper -->
<?php
if (function_exists('booty_style'))
    echo booty_style()
    ?>
<?php wp_footer(); ?>
</body>
</html>