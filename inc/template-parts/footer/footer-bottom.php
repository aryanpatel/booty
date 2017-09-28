<?php
/**
 * Footer bottom
 */
$booty_footer = booty_footer_types();
$colum = 1;
if ($booty_footer['bottom']['col'] == '1column') {
    $colum = 1;
} elseif ($booty_footer['bottom']['col'] == '2column') {
    $colum = 2;
}
?> 
<div class="<?php echo esc_html(booty_footer_bottom_class()) ?>">
    <div class="container">
        <div class="row">
            <?php if ($colum == 1): ?>
                <div class="col-xs-12 col-md-<?php echo $booty_footer['bottom_1colum']['w1'] ?> align-cent">
                    <?php
                    if (is_active_sidebar('' . $booty_footer['bottom_1colum']['ct1'] . ''))
                        dynamic_sidebar('' . $booty_footer['bottom_1colum']['ct1'] . '');
                    ?>
                </div>
            <?php elseif ($colum == 2): ?>
                <div class="col-xs-12 col-sm-12 col-md-<?php echo $booty_footer['bottom_2colum']['w1'] ?>">
                    <?php
                    if (is_active_sidebar('' . $booty_footer['bottom_2colum']['ct1'] . ''))
                        dynamic_sidebar('' . $booty_footer['bottom_2colum']['ct1'] . '');
                    ?>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-<?php echo $booty_footer['bottom_2colum']['w2'] ?>">
                    <?php
                    if (is_active_sidebar('' . $booty_footer['bottom_2colum']['ct2'] . ''))
                        dynamic_sidebar('' . $booty_footer['bottom_2colum']['ct2'] . '');
                    ?>
                </div> 
            <?php endif; ?>
        </div>
    </div>
</div>