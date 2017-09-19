<?php 
//breadcum...
function booty_breadcrumbs() {
    global $post, $wp_query, $author, $booty_settings;

    $prepend = '';
    $before = '<li>';
    $after = '</li>';
    $home = esc_html__('Home', BOOTY_TXT_DOMAIN);

    $shop_page_id = false;
    $shop_page = false;
    $front_page_shop = false;
    if ( defined( 'WOOCOMMERCE_VERSION' ) ) {
        $permalinks   = get_option( 'woocommerce_permalinks' );
        $shop_page_id = wc_get_page_id( 'shop' );
        $shop_page    = get_post( $shop_page_id );
        $front_page_shop = get_option( 'page_on_front' ) == wc_get_page_id( 'shop' );
    }

    // If permalinks contain the shop page in the URI prepend the breadcrumb with shop
    if ( $shop_page_id && $shop_page && strstr( $permalinks['product_base'], '/' . $shop_page->post_name ) && get_option( 'page_on_front' ) != $shop_page_id ) {
        $prepend = $before . '<a href="' . get_permalink( $shop_page ) . '">' . $shop_page->post_title . '</a> ' . $after;
    }

    if ( ( ! is_home() && ! is_front_page() && ! ( is_post_type_archive() && $front_page_shop ) ) || is_paged() ) {
        echo '<ul class="breadcrumbs list-inline">';

        if ( ! empty( $home ) ) {
            echo $before . '<a class="home" href="' . apply_filters( 'woocommerce_breadcrumb_home_url', home_url() ) . '">' . $home . '</a>' . $after;
        }

        if ( is_home() ) {

            echo $before . single_post_title('', false) . $after;

        } else if(is_search()){
            echo $before. esc_html__( 'Search Results for: ', BOOTY_TXT_DOMAIN ). get_search_query() .$after;

        }else if ( is_category()) {

            if ( get_option( 'show_on_front' ) == 'page' && get_option( 'page_for_posts')) {
                echo $before . '<a href="' . get_permalink( get_option('page_for_posts' ) ) . '">' . get_the_title( get_option('page_for_posts', true) ) . '</a>' . $after;
            }

            $cat_obj = $wp_query->get_queried_object();
            $this_category = get_category( $cat_obj->term_id );

            echo $before . single_cat_title( '', false ) . $after;

        } elseif ( is_tax('product_cat') || is_tax('portfolio_cat')) {

            echo $prepend;

            if ( is_tax('portfolio_cat') ) {
                $post_type = get_post_type_object( 'portfolio' );
                echo $before . '<a href="' . get_post_type_archive_link( 'portfolio' ) . '">' . $post_type->labels->singular_name . '</a>' . $after;
            }
            $current_term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

            $ancestors = array_reverse( get_ancestors( $current_term->term_id, get_query_var( 'taxonomy' ) ) );

            foreach ( $ancestors as $ancestor ) {
                $ancestor = get_term( $ancestor, get_query_var( 'taxonomy' ) );

                echo $before . '<a href="' . get_term_link( $ancestor->slug, get_query_var( 'taxonomy' ) ) . '">' . esc_html( $ancestor->name ) . '</a>' . $after;
            }

            echo $before . esc_html( $current_term->name ) . $after;

        } elseif ( is_tax('product_tag') ) {

            $queried_object = $wp_query->get_queried_object();
            echo $prepend . $before . ' ' . esc_html__( 'Products tagged &ldquo;', BOOTY_TXT_DOMAIN ) . $queried_object->name . '&rdquo;' . $after;

        } elseif ( is_day() ) {

            echo $before . '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>' . $delimiter . $after;
            echo $before . '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a>' . $after;
            echo $before . get_the_time('d') . $after;

        } elseif ( is_month() ) {

            echo $before . '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>' . $after;
            echo $before . get_the_time('F') . $after;

        } elseif ( is_year() ) {

            echo $before . get_the_time('Y') . $after;

        } elseif ( is_post_type_archive('product') && get_option('page_on_front') !== $shop_page_id ) {

            $_name = wc_get_page_id( 'shop' ) ? get_the_title( wc_get_page_id( 'shop' ) ) : '';

            if ( ! $_name ) {
                $product_post_type = get_post_type_object( 'product' );
                $_name = $product_post_type->labels->singular_name;
            }

            if ( is_search() ) {

                echo $before . '<a href="' . get_post_type_archive_link('product') . '">' . $_name . '</a>' . esc_html__( 'Search results for &ldquo;', BOOTY_TXT_DOMAIN ) . get_search_query() . '&rdquo;' . $after;

            } elseif ( is_paged() ) {

                echo $before . '<a href="' . get_post_type_archive_link('product') . '">' . $_name . '</a>' . $after;

            } else {

                echo $before . $_name . $after;

            }

        } elseif ( is_single() && ! is_attachment() ) {

            if ( 'product' == get_post_type() ) {

                echo $prepend;

                if ( $terms = wc_get_product_terms( $post->ID, 'product_cat', array( 'orderby' => 'parent', 'order' => 'DESC' ) ) ) {
                    $main_term = $terms[0];
                    $ancestors = get_ancestors( $main_term->term_id, 'product_cat' );
                    $ancestors = array_reverse( $ancestors );

                    foreach ( $ancestors as $ancestor ) {
                        $ancestor = get_term( $ancestor, 'product_cat' );

                        if ( ! is_wp_error( $ancestor ) && $ancestor ) {
                            echo $before . '<a href="' . get_term_link( $ancestor ) . '">' . $ancestor->name . '</a>' . $after;
                        }
                    }

                    echo $before . '<a href="' . get_term_link( $main_term ) . '">' . $main_term->name . '</a>' . $after;

                }

                echo $before . get_the_title() . $after;

            } elseif ( 'post' != get_post_type() ) {
                $post_type = get_post_type_object( get_post_type() );
                $slug = $post_type->rewrite;
                echo $before . '<a href="' . get_post_type_archive_link( get_post_type() ) . '">' . $post_type->labels->singular_name . '</a>' . $after;
                echo $before . get_the_title() . $after;

            } else {

                if ( 'post' == get_post_type() && get_option( 'show_on_front' ) == 'page' && get_option( 'page_for_posts')) {
                    echo $before . '<a href="' . get_permalink( get_option('page_for_posts' ) ) . '">' . get_the_title( get_option('page_for_posts', true) ) . '</a>' . $after;
                }

                $cat = current( get_the_category() );
                if ( ( $parents = get_category_parents( $cat, TRUE, $after . $before ) ) && ! is_wp_error( $parents ) ) {
                    echo $before . substr( $parents, 0, strlen($parents) - strlen($after . $before) ) . $after;
                }
                echo $before . get_the_title() . $after;

            }

        } elseif ( is_404() ) {

            echo $before . esc_html__( '404', BOOTY_TXT_DOMAIN ) . $after;

        } elseif ( ! is_single() && ! is_page() && get_post_type() != 'post' ) {

            $post_type = get_post_type_object( get_post_type() );

            if ( $post_type ) {
                echo $before . $post_type->labels->singular_name . $after;
            }

        } elseif ( is_attachment() ) {

            $parent = get_post( $post->post_parent );
            $cat = get_the_category( $parent->ID );
            $cat = $cat[0];
            if ( ( $parents = get_category_parents( $cat, TRUE, $after . $before ) ) && ! is_wp_error( $parents ) ) {
                echo $before . substr( $parents, 0, strlen($parents) - strlen($after . $before) ) . $after;
            }
            echo $before . '<a href="' . get_permalink( $parent ) . '">' . $parent->post_title . '</a>'. $after;
            echo $before . get_the_title() . $after;

        } elseif ( is_page() && !$post->post_parent ) {

            echo $before . get_the_title() . $after;

        } elseif ( is_page() && $post->post_parent ) {

            $parent_id  = $post->post_parent;
            $breadcrumbs = array();

            while ( $parent_id ) {
                $page = get_post( $parent_id );
                $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title( $page->ID ) . '</a>';
                $parent_id  = $page->post_parent;
            }

            $breadcrumbs = array_reverse( $breadcrumbs );

            foreach ( $breadcrumbs as $crumb ) {
                echo $before . $crumb . $after;
            }

            echo $before . get_the_title() . $after;

        } elseif ( is_search() ) {

            echo $before . esc_html__( 'Search results for &ldquo;', BOOTY_TXT_DOMAIN ) . get_search_query() . '&rdquo;' . $after;

        } elseif ( is_tag() ) {

            echo $before . esc_html__( 'Posts tagged &ldquo;', BOOTY_TXT_DOMAIN ) . single_tag_title('', false) . '&rdquo;' . $after;

        } elseif ( is_author() ) {

            $userdata = get_userdata($author);
            echo $before . esc_html__( 'Author:', BOOTY_TXT_DOMAIN ) . ' ' . $userdata->display_name . $after;

        }

        if ( get_query_var( 'paged' ) ) {
            echo $before . '&nbsp;(' . esc_html__( 'Page', BOOTY_TXT_DOMAIN ) . ' ' . get_query_var( 'paged' ) . ')' . $after;
        }

        echo '</ul>';
    } else {
        if ( is_home() && !is_front_page() ) {
            echo '<ul class="breadcrumbs list-inline">';

            if ( ! empty( $home ) ) {
                echo $before . '<a class="home" href="' . apply_filters( 'woocommerce_breadcrumb_home_url', home_url() ) . '">' . $home . '</a>' . $after;

                echo $before . force_balance_tags($booty_settings['blog-title']) . $after;
            }

            echo '</ul>';
        }
    }
}

function booty_page_title() {

    global $booty_settings, $post, $wp_query, $author;

    $home = esc_html__('Home', BOOTY_TXT_DOMAIN);

    $shop_page_id = false;
    $front_page_shop = false;
    if ( defined( 'WOOCOMMERCE_VERSION' ) ) {
        $shop_page_id = wc_get_page_id( 'shop' );
        $front_page_shop = get_option( 'page_on_front' ) == wc_get_page_id( 'shop' );
    }

    if ( ( ! is_home() && ! is_front_page() && ! ( is_post_type_archive() && $front_page_shop ) ) || is_paged() ) {

        if ( is_home() ) {

        } else if ( is_category() ) {

            echo single_cat_title( '', false );

        } elseif ( is_tax('product_cat') || is_tax('portfolio_cat')) {

            $current_term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

            echo esc_html( $current_term->name );

        } elseif ( is_tax('product_tag') ) {

            $queried_object = $wp_query->get_queried_object();
            echo esc_html__( 'Products tagged &ldquo;', BOOTY_TXT_DOMAIN ) . $queried_object->name . '&rdquo;';

        } elseif ( is_day() ) {

            printf( esc_html__( 'Daily Archives: %s', BOOTY_TXT_DOMAIN ), get_the_date() );

        } elseif ( is_month() ) {

            printf( esc_html__( 'Monthly Archives: %s', BOOTY_TXT_DOMAIN ), get_the_date( _x( 'F Y', 'monthly archives date format', BOOTY_TXT_DOMAIN ) ) );

        } elseif ( is_year() ) {

            printf( esc_html__( 'Yearly Archives: %s', BOOTY_TXT_DOMAIN ), get_the_date( _x( 'Y', 'yearly archives date format', BOOTY_TXT_DOMAIN ) ) );

        } elseif ( is_post_type_archive('product') && get_option('page_on_front') !== $shop_page_id ) {

            $_name = wc_get_page_id( 'shop' ) ? get_the_title( wc_get_page_id( 'shop' ) ) : '';

            if ( ! $_name ) {
                $product_post_type = get_post_type_object( 'product' );
                $_name = $product_post_type->labels->singular_name;
            }

            if ( is_search() ) {

            } elseif ( is_paged() ) {

            } else {

                echo $_name;

            }

        } elseif ( is_post_type_archive('portfolio') ) {

            $post_type = get_post_type_object( 'portfolio' );
            echo $post_type->labels->name;

        } else if ( is_post_type_archive() ) {
            sprintf( esc_html__( 'Archives: %s', BOOTY_TXT_DOMAIN ), post_type_archive_title( '', false ) );
        } elseif ( is_single() && ! is_attachment() ) {

            if ( 'portfolio' == get_post_type() ) {

                echo get_the_title();

            } else {

                echo get_the_title();

            }

        } elseif ( is_404() ) {

            echo esc_html__( '404', BOOTY_TXT_DOMAIN );

        } elseif ( ! is_single() && ! is_page() && get_post_type() != 'post' ) {

            $post_type = get_post_type_object( get_post_type() );

            if ( $post_type ) {
                echo $post_type->labels->singular_name;
            }

        } elseif ( is_attachment() ) {

            echo get_the_title();

        } elseif ( is_page() && !$post->post_parent ) {

            echo get_the_title();

        } elseif ( is_page() && $post->post_parent ) {

            echo get_the_title();

        } elseif ( is_search() ) {

            echo esc_html__( 'Search results for &ldquo;', BOOTY_TXT_DOMAIN ) . get_search_query() . '&rdquo;';

        } elseif ( is_tag() ) {

            echo esc_html__( 'Posts tagged &ldquo;', BOOTY_TXT_DOMAIN ) . single_tag_title('', false) . '&rdquo;';

        } elseif ( is_author() ) {

            $userdata = get_userdata($author);
            echo esc_html__( 'Author:', BOOTY_TXT_DOMAIN ) . ' ' . $userdata->display_name;

        }

        if ( get_query_var( 'paged' ) ) {
            echo ' (' . esc_html__( 'Page', BOOTY_TXT_DOMAIN ) . ' ' . get_query_var( 'paged' ) . ')';
        }
    } else {
        if ( is_home() && !is_front_page() ) {
            if ( ! empty( $home ) ) {
                echo force_balance_tags($booty_settings['blog-title']);
            }
        }
    }
}
?>