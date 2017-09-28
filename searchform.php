<form method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
    <fieldset>
        <input type="search" class="search" placeholder="<?php esc_html_e('search', BOOTY_TXT_DOMAIN) ?>..." value="<?php echo esc_attr(get_search_query()); ?>" name="s" title="<?php echo esc_attr_x('Search for:', 'label', BOOTY_TXT_DOMAIN); ?>" />
        <button type="submit" class="submit">
            <i class="fa fa-search"></i>
        </button>
    </fieldset>
</form>