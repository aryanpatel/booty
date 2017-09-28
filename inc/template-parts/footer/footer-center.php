<?php
/**
 * Footer center
 */
$booty_footer = booty_footer_types();
$colum = 4;
if ($booty_footer['center']['col'] == '3column') {
    $colum = 3;
} elseif ($booty_footer['center']['col'] == '4column') {
    $colum = 4;
}
?> 
<div class="<?php echo esc_html(booty_footer_center_class()) ?>">
    <div class="container">
        <div class="row">
            <?php if ($colum == 3): ?>
                <div class="col-xs-12 col-sm-6 col-md-<?php echo $booty_footer['center_3colum']['w1'] ?>">
                    <?php
                    if (is_active_sidebar('' . $booty_footer['center_3colum']['ct1'] . ''))
                        dynamic_sidebar('' . $booty_footer['center_3colum']['ct1'] . '');
                    ?>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-<?php echo $booty_footer['center_3colum']['w2'] ?>">
                    <?php
                    if (is_active_sidebar('' . $booty_footer['center_3colum']['ct2'] . ''))
                        dynamic_sidebar('' . $booty_footer['center_3colum']['ct2'] . '');
                    ?>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-<?php echo $booty_footer['center_3colum']['w3'] ?>">
                    <?php
                    if (is_active_sidebar('' . $booty_footer['center_3colum']['ct3'] . ''))
                        dynamic_sidebar('' . $booty_footer['center_3colum']['ct3'] . '');
                    ?>
                </div>
            <?php elseif ($colum == 4): ?>
                <div class="col-xs-12 col-sm-6 col-md-<?php echo $booty_footer['center_4colum']['w1'] ?>">
                    <?php
                    if (is_active_sidebar('' . $booty_footer['center_4colum']['ct1'] . ''))
                        dynamic_sidebar('' . $booty_footer['center_4colum']['ct1'] . '');
                    ?>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-<?php echo $booty_footer['center_4colum']['w2'] ?>">
                    <?php
                    if (is_active_sidebar('' . $booty_footer['center_4colum']['ct2'] . ''))
                        dynamic_sidebar('' . $booty_footer['center_4colum']['ct2'] . '');
                    ?>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-<?php echo $booty_footer['center_4colum']['w3'] ?>">
                    <?php
                    if (is_active_sidebar('' . $booty_footer['center_4colum']['ct3'] . ''))
                        dynamic_sidebar('' . $booty_footer['center_4colum']['ct3'] . '');
                    ?>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-<?php echo $booty_footer['center_4colum']['w4'] ?>">
                    <?php
                    if (is_active_sidebar('' . $booty_footer['center_4colum']['ct4'] . ''))
                        dynamic_sidebar('' . $booty_footer['center_4colum']['ct4'] . '');
                    ?>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>