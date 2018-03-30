<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package madisonaveneue
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */

class MadisonaveneueFeatureWidget extends WP_Widget {

    function __construct() {
        parent::__construct(         
            // Base ID of your widget
            'madisonaveneue_feature_widget', 
            // Widget name will appear in UI
            __('Madison Feature Widget', 'madisonaveneue_widget_domain'), 
        // Widget description
           $widget_options );
    }

    function widget( $args, $instance ) {
        // Widget output
        $title = apply_filters( 'widget_title', $instance['title'] );

// before and after widget arguments are defined by themes
        echo $args['before_widget'];
        if ( ! empty( $title ) )
            echo $args['before_title'] . $title . $args['after_title'];
        echo $args['after_widget'];
    }

    function update( $new_instance, $old_instance ) {
        // Save widget options
                $instance = array();
                $instance['fa_icons'] = ( ! empty( $new_instance['fa_icons'] ) ) ? strip_tags( $new_instance['fa_icons'] ) : '';
                $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
                $instance['description'] = ( ! empty( $new_instance['description'] ) ) ? strip_tags( $new_instance['description'] ) : '';
                return $instance;
    }

    function form( $instance ) {
        // Output admin widget options form
            $fa_icons = $instance[ 'fa_icons' ];
            $title = $instance[ 'title' ];
            $description = $instance[ 'description' ];
// Widget admin form
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'fa_icons' ); ?>"><?php _e( 'Font Awesome Icons:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'fa_icons' ); ?>" name="<?php echo $this->get_field_name( 'fa_icons' ); ?>" type="text" value="<?php echo esc_attr( $fa_icons ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'description' ); ?>"><?php _e( 'Description:' ); ?></label> 
            <textarea class="widefat" id="<?php echo $this->get_field_id( 'description' ); ?>" name="<?php echo $this->get_field_name( 'description' ); ?>" rows="6" ><?php echo esc_attr( $description ); ?></textarea>
        </p>
        <?php 
    }
}

function madisonaveneue_register_widgets() {
    register_widget( 'MadisonaveneueFeatureWidget' );
}

add_action( 'widgets_init', 'madisonaveneue_register_widgets' );