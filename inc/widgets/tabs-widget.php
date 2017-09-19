<?php
/**
 * tabs widget class
 *
 * @since 2.8.0
 */

class WP_Booty_Widget_tabs extends WP_Widget {
    public function __construct() {
        $widget_ops = array( 'classname' => 'booty-tabs', 'description' => esc_html__( "Tabs.",BOOTY_TXT_DOMAIN) );
        parent::__construct ('booty_tabs', esc_html__( '[Fekra] Tabs Widget', BOOTY_TXT_DOMAIN ), $widget_ops );
        $this->alt_option_name = 'booty-tabs';
    }

    public function widget( $args, $instance ) {

        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
        echo $args['before_widget'];
        if ( $title ) {
            echo $args['before_title'] . wp_kses($instance['title'],array('span'=>array('class'=>array()))) . $args['after_title'];
        }
        ?>
        <div class="tabs">
            <!--tabs nav-->
            <ul class="list-inline tabset">
                <li class="active"><a href="#popular"><?php  esc_html_e('Popular',BOOTY_TXT_DOMAIN); ?></a></li>
                <li><a href="#comments"><?php  esc_html_e('Comments',BOOTY_TXT_DOMAIN); ?></a></li>
            </ul>
            <!--tabs content-->
            <div class="tab-content">
                <div id="popular">
                    <?php
                    $number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
                        $r = new WP_Query( apply_filters( 'booty_widget_posts_args', array(
                        'meta_key'              => 'post_views_count',
                        'orderby'               => 'meta_value_num',
                        'posts_per_page'        => $number,
                        'no_found_rows'         => true,
                        'post_status'           => 'publish',
                        'ignore_sticky_posts'   => true
                    ) ) );
                    if ( $r->have_posts()) :
                    ?>
                    <div class="booty-popular-posts">
                    <?php while ( $r->have_posts() ) : $r->the_post(); ?>
                        <article class="box">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="img-box">
                                <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail( 'booty_imag_latest_widget' ); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                            <div class="holder">
                                <time><?php echo get_the_date(); ?></time>
                                <a href="<?php the_permalink(); ?>" ><h3><?php the_title(); ?></h3></a>
                            </div>
                        </article>
                    <?php endwhile; ?>
                    </div>
                    <?php endif; ?>
                </div>
                <div id="comments">
                <!--comments-->
                    <?php
                    $number_comment = ( ! empty( $instance['number_comment'] ) ) ? absint( $instance['number_comment'] ) : 5;
                    if ( ! $number_comment )
                        $number_comment = 5;

                    $comments = get_comments( apply_filters( 'widget_comments_args', array(
                        'number'      => $number_comment,
                        'status'      => 'approve',
                        'post_status' => 'publish'
                    ) ) );
                        $output ='';
                        $output .= '<div class="booty-recent-comments">';
                        if ( is_array( $comments ) && $comments ) {

    						$ill_loop=0;
                            foreach ( (array) $comments as $comment) {
    							$ill_loop++;
                                $output .= '<article class="box">';
                                $output .= '<time>'.get_comment_date( 'j M Y', $comment->comment_ID ).'</time>';
                                $output .= '<a href="' . esc_url( get_comment_link( $comment->comment_ID ) ) . '" class="color_dark" ><h3>' . get_the_title( $comment->comment_post_ID ) . '</h3></a>';
                                $output .= '<a href="#">'. get_comment_author_link( $comment->comment_ID ) .'</a>';
                                $output .= '</article>';
                            }
                        }
                        $output .= '</div>';

                        echo $output;
                    ?>
                </div>
            </div>
        </div>
        <?php
        echo $args['after_widget'];
    }

    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = $new_instance['title'];
        $instance['number'] = (int) $new_instance['number'];
        $instance['show_format'] = isset( $new_instance['show_format'] ) ? (bool) $new_instance['show_format'] : false;
        $instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
        $instance['show_categories'] = isset( $new_instance['show_categories'] ) ? (bool) $new_instance['show_categories'] : false;

        $instance['number_comment'] = (int) $new_instance['number_comment'];

        return $instance;
    }

    public function form( $instance ) {
        $title = isset( $instance['title'] ) ? wp_kses($instance['title'],array('span'=>array('class'=>array()))) : '';
        $number = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;

        $number_comment = isset( $instance['number_comment'] ) ? absint( $instance['number_comment'] ) : 5;
?>
        <p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php  esc_html_e( 'Title:',BOOTY_TXT_DOMAIN ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_html($title); ?>" /></p>

        <!-- Option popular -->
        <p><label><strong><?php  esc_html_e('Setting Popular',BOOTY_TXT_DOMAIN); ?></strong></label>
        <p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php  esc_html_e( 'Number of posts to show:', BOOTY_TXT_DOMAIN ); ?></label>
        <input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo esc_html($number); ?>" size="3" /></p>
        <!-- Option comments -->
        <p><label><strong><?php  esc_html_e('Setting Comments',BOOTY_TXT_DOMAIN); ?></strong></label>
        <p><label for="<?php echo $this->get_field_id( 'number_comment' ); ?>"><?php  esc_html_e( 'Number of comments to show:',BOOTY_TXT_DOMAIN ); ?></label>
        <input id="<?php echo $this->get_field_id( 'number_comment' ); ?>" name="<?php echo $this->get_field_name( 'number_comment' ); ?>" type="text" value="<?php echo esc_html($number_comment); ?>" size="3" /></p>
<?php
    }
}
