<?php
$breadcrumbs = booty_get_meta_value('breadcrumbs', true);
$page_title = booty_get_meta_value('page_title', true);

if (( is_front_page() && is_home()) || is_front_page()) {
    $breadcrumbs = false;
    $page_title = false;
}
?>
<?php if ($breadcrumbs || $page_title) : ?>
    <div class="side-breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <?php if ($page_title) : ?>
                        <h1 class="page-title"><?php booty_page_title(); ?></h1>
                    <?php endif; ?>
                    <?php if ($breadcrumbs) : ?>
                        <?php booty_breadcrumbs(); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>