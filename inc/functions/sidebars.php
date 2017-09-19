<?php
add_action('widgets_init', 'booty_register_sidebars');

function booty_register_sidebars() {
    register_sidebar(array(
        'name' => esc_html__('General Sidebar', BOOTY_TXT_DOMAIN),
        'id' => 'general-sidebar',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h2 class="widget-title-category">',
        'after_title' => '</h2>',
    ));

    register_sidebar( array(
        'name' => esc_html__('Blog Sidebar', BOOTY_TXT_DOMAIN),
        'id' => 'blog-sidebar',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ) );
    register_sidebar( array(
        'name' => esc_html__('Bars Sidebar', BOOTY_TXT_DOMAIN),
        'id' => 'bars-sidebar',
        'before_widget' => '<section class="side-widget">',
        'after_widget' => "</section>",
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ) );
    register_sidebar(array(
        'name' => esc_html__('Footer Widget Default Top', BOOTY_TXT_DOMAIN),
        'id' => 'footer-df-1',
        'before_widget' => '<aside id="%1$s" class="%2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h5 class="widget-title">',
        'after_title' => '</h5> ',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer Widget Default Center 1', BOOTY_TXT_DOMAIN),
        'id' => 'footer-df-2',
        'before_widget' => '<aside id="%1$s" class="%2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h5 class="widget-title">',
        'after_title' => '</h5> ',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer Widget Default Center 2', BOOTY_TXT_DOMAIN),
        'id' => 'footer-df-3',
        'before_widget' => '<aside id="%1$s" class="%2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h5 class="widget-title">',
        'after_title' => '</h5> ',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer Widget Default Center 3', BOOTY_TXT_DOMAIN),
        'id' => 'footer-df-4',
        'before_widget' => '<aside id="%1$s" class="%2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h5 class="widget-title">',
        'after_title' => '</h5> ',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer Widget Default Center 4', BOOTY_TXT_DOMAIN),
        'id' => 'footer-df-5',
        'before_widget' => '<aside id="%1$s" class="%2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h5 class="widget-title">',
        'after_title' => '</h5> ',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer Widget Default Bottom 1', BOOTY_TXT_DOMAIN),
        'id' => 'footer-df-6',
        'before_widget' => '<aside id="%1$s" class="%2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h5 class="widget-title">',
        'after_title' => '</h5> ',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer Widget Default Bottom 2', BOOTY_TXT_DOMAIN),
        'id' => 'footer-df-7',
        'before_widget' => '<aside id="%1$s" class="%2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h5 class="widget-title">',
        'after_title' => '</h5> ',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer Widget(Logo, description and social)', BOOTY_TXT_DOMAIN),
        'id' => 'footer-column-1',
        'before_widget' => '<aside id="%1$s" class="%2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h5 class="widget-title">',
        'after_title' => '</h5> ',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer Widget(Popular Tags)', BOOTY_TXT_DOMAIN),
        'id' => 'footer-column-2',
        'before_widget' => '<aside id="%1$s" class="%2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h5 class="widget-title">',
        'after_title' => '</h5>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer Widget(Latest news)', BOOTY_TXT_DOMAIN),
        'id' => 'footer-column-3',
        'before_widget' => '<aside id="%1$s" class="%2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h5 class="widget-title">',
        'after_title' => '</h5>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer Widget(Quickly Contact)', BOOTY_TXT_DOMAIN),
        'id' => 'footer-column-4',
        'before_widget' => '<aside id="%1$s" class="%2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h5 class="widget-title">',
        'after_title' => '</h5>',
    ));
	register_sidebar(array(
        'name' => esc_html__('Footer Widget(Creative Top)', BOOTY_TXT_DOMAIN),
        'id' => 'footer-7',
        'before_widget' => '<aside id="%1$s" class="%2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h5 class="widget-title">',
        'after_title' => '</h5>',
    ));
	register_sidebar(array(
        'name' => esc_html__('Footer Widget(About Us)', BOOTY_TXT_DOMAIN),
        'id' => 'footer-8',
        'before_widget' => '<aside id="%1$s" class="%2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h5 class="widget-title">',
        'after_title' => '</h5>',
    ));
	register_sidebar(array(
        'name' => esc_html__('Footer Widget(Contact Info)', BOOTY_TXT_DOMAIN),
        'id' => 'footer-9',
        'before_widget' => '<aside id="%1$s" class="%2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h5 class="widget-title">',
        'after_title' => '</h5>',
    ));
	register_sidebar(array(
        'name' => esc_html__('Footer Widget(Instagram Photos)', BOOTY_TXT_DOMAIN),
        'id' => 'footer-10',
        'before_widget' => '<aside id="%1$s" class="%2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h5 class="widget-title">',
        'after_title' => '</h5>',
    ));
	register_sidebar(array(
        'name' => esc_html__('Footer Widget(Creative Bottom)', BOOTY_TXT_DOMAIN),
        'id' => 'footer-11',
        'before_widget' => '<aside id="%1$s" class="%2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h5 class="widget-title">',
        'after_title' => '</h5>',
    ));
	register_sidebar(array(
        'name' => esc_html__('Footer Widget(Personal)', BOOTY_TXT_DOMAIN),
        'id' => 'footer-12',
        'before_widget' => '<aside id="%1$s" class="%2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h5 class="widget-title">',
        'after_title' => '</h5>',
    ));
	register_sidebar(array(
        'name' => esc_html__('Footer Widget(Darna office)', BOOTY_TXT_DOMAIN),
        'id' => 'footer-13',
        'before_widget' => '<aside id="%1$s" class="%2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h5 class="widget-title">',
        'after_title' => '</h5>',
    ));
	register_sidebar(array(
        'name' => esc_html__('Footer Widget(Plumber Top)', BOOTY_TXT_DOMAIN),
        'id' => 'footer-14',
        'before_widget' => '<aside id="%1$s" class="%2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h5 class="widget-title">',
        'after_title' => '</h5>',
    ));
	register_sidebar(array(
        'name' => esc_html__('Footer Widget(Counter: happy client)', BOOTY_TXT_DOMAIN),
        'id' => 'footer-15',
        'before_widget' => '<aside id="%1$s" class="%2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h5 class="widget-title">',
        'after_title' => '</h5>',
    ));
	register_sidebar(array(
        'name' => esc_html__('Footer Widget(Counter: projects)', BOOTY_TXT_DOMAIN),
        'id' => 'footer-16',
        'before_widget' => '<aside id="%1$s" class="%2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h5 class="widget-title">',
        'after_title' => '</h5>',
    ));
	register_sidebar(array(
        'name' => esc_html__('Footer Widget(Counter: plumbers)', BOOTY_TXT_DOMAIN),
        'id' => 'footer-17',
        'before_widget' => '<aside id="%1$s" class="%2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h5 class="widget-title">',
        'after_title' => '</h5>',
    ));
	register_sidebar(array(
        'name' => esc_html__('Footer Widget(Counter: tweets)', BOOTY_TXT_DOMAIN),
        'id' => 'footer-18',
        'before_widget' => '<aside id="%1$s" class="%2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h5 class="widget-title">',
        'after_title' => '</h5>',
    ));
	register_sidebar(array(
        'name' => esc_html__('Footer Widget(Shop top)', BOOTY_TXT_DOMAIN),
        'id' => 'footer-19',
        'before_widget' => '<aside id="%1$s" class="%2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h5 class="widget-title">',
        'after_title' => '</h5>',
    ));
	register_sidebar(array(
        'name' => esc_html__('Footer Widget(Mailchimp)', BOOTY_TXT_DOMAIN),
        'id' => 'footer-20',
        'before_widget' => '<aside id="%1$s" class="%2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h5 class="widget-title">',
        'after_title' => '</h5>',
    ));
	register_sidebar(array(
        'name' => esc_html__('Footer Widget(Payment Logo)', BOOTY_TXT_DOMAIN),
        'id' => 'footer-21',
        'before_widget' => '<aside id="%1$s" class="%2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h5 class="widget-title">',
        'after_title' => '</h5>',
    ));
	register_sidebar(array(
        'name' => esc_html__('Footer Widget(Our Mission)', BOOTY_TXT_DOMAIN),
        'id' => 'footer-22',
        'before_widget' => '<aside id="%1$s" class="%2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h5 class="widget-title">',
        'after_title' => '</h5>',
    ));
	register_sidebar(array(
        'name' => esc_html__('Footer Widget(Applanding top)', BOOTY_TXT_DOMAIN),
        'id' => 'footer-23',
        'before_widget' => '<aside id="%1$s" class="%2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h5 class="widget-title">',
        'after_title' => '</h5>',
    ));
	register_sidebar(array(
        'name' => esc_html__('Footer Widget(Social Bottom)', BOOTY_TXT_DOMAIN),
        'id' => 'footer-24',
        'before_widget' => '<aside id="%1$s" class="%2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h5 class="widget-title">',
        'after_title' => '</h5>',
    ));
	register_sidebar(array(
        'name' => esc_html__('Footer Widget(Freelancer Center)', BOOTY_TXT_DOMAIN),
        'id' => 'footer-25',
        'before_widget' => '<aside id="%1$s" class="%2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h5 class="widget-title">',
        'after_title' => '</h5>',
    ));
	register_sidebar(array(
        'name' => esc_html__('Footer Widget(portfolio-2 top)', BOOTY_TXT_DOMAIN),
        'id' => 'footer-26',
        'before_widget' => '<aside id="%1$s" class="%2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h5 class="widget-title">',
        'after_title' => '</h5>',
    ));
	register_sidebar(array(
        'name' => esc_html__('Footer Widget(Company presentation)', BOOTY_TXT_DOMAIN),
        'id' => 'footer-27',
        'before_widget' => '<aside id="%1$s" class="%2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h5 class="widget-title">',
        'after_title' => '</h5>',
    ));
	register_sidebar(array(
		'name' => esc_html__('Newsletter', BOOTY_TXT_DOMAIN),
		'id' => 'newsletter-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
    register_sidebar(array(
        'name' => esc_html__('Woocommerce Sale Product', BOOTY_TXT_DOMAIN),
        'id' => 'sale-sidebar',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Woocommerce Featured Product', BOOTY_TXT_DOMAIN),
        'id' => 'featured-sidebar',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Latest Blogs', BOOTY_TXT_DOMAIN),
        'id' => 'latest-sidebar',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Useful Links', BOOTY_TXT_DOMAIN),
        'id' => 'links-sidebar',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Portfolio Left Sidebar', BOOTY_TXT_DOMAIN),
        'id' => 'left-sidebar',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Portfolio Right Sidebar', BOOTY_TXT_DOMAIN),
        'id' => 'right-sidebar',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Shortcode Sidebar', BOOTY_TXT_DOMAIN),
        'id' => 'shortcode-sidebar',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    if (class_exists('Woocommerce')) {

        register_sidebar(array(
            'name' => esc_html__('Shop Sidebar', BOOTY_TXT_DOMAIN),
            'id' => 'shop-sidebar',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => "</aside>",
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ));

        register_sidebar(array(
            'name' => esc_html__('Single Product Sidebar', BOOTY_TXT_DOMAIN),
            'id' => 'single-product-sidebar',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => "</aside>",
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ));
    }
}