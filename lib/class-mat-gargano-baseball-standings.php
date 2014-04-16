<?php

class Mat_Gargano_Baseball_Standings extends WP_Widget {

    protected static $text_domain = 'mat_gargano_baseball_standings';
    protected static $ver = '2.0.0'; //for cache busting
    protected static $transient_limit = 3600; //cache for an hour
    protected static $transient_name = 'mat_gargano_baseball_standings';

    /**
     * Initialization method
     */

    public static function init() {
        add_action( 'widgets_init', create_function( '', 'register_widget( "Mat_Gargano_Baseball_Standings" );' ) );
        add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue' ) );
    }

    /**
     * Register widget with WordPress.
     */

    public function __construct() {
        parent::__construct(
            'mat_gargano_baseball_standings', // Base ID
            'MLB Standings', // Name
            array( 'description' => __( 'Provides a widget of current MLB standings.', self::$text_domain ), ) // Args
        );
    }


    /**
     * Front-end display of widget.
     *
     * Filter 'mgbs_template' - template allowing a theme to use its own template file
     * Filter 'mgbs_standings_data' - customize the data passed to the frontend (if you want to only output only NL for example)
     *
     * @see WP_Widget::widget()
     *
     * @param array   $args     Widget arguments.
     * @param array   $instance Saved values from database.
     */

    public function widget( $args, $instance ) {
        $template_file = plugin_dir_path( dirname( __FILE__ ) ) . 'views/widget.php';
        $template_file = apply_filters( 'mgbs_template', $template_file );
        $title = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
        $default_division = $instance['division'];
        $standings_data = get_transient( self::$transient_name );
        if ( ! $standings_data || ! is_array( $standings_data ) ) :
            $standings = new MLB_Standings;
            $standings_data = $standings->get_data();
            set_transient( self::$transient_name, $standings_data, self::$transient_limit );
        endif;
        $standings_data = apply_filters( 'mgbs_standings_data', $standings_data );
        extract( $args );
        echo $before_widget;
        include $template_file;
        echo $after_widget;
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array   $new_instance Values just sent to be saved.
     * @param array   $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */

    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = esc_attr( $new_instance['title'] );
        $instance['division'] = esc_attr( $new_instance['division'] );
        return $instance;
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array   $instance Previously saved values from database.
     */

    public function form( $instance ) {
        $defaults = array(
            'division' => 'nle',
            'title' => '',
        );

        $instance = wp_parse_args( $instance, $defaults );

        ?>
        <div class="mgbs-form">
            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', self::$text_domain ); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $instance['title']; ?>" />
            </p>
            <label for="<?php echo $this->get_field_id( 'division' );?>">Default Division:</label>
            <select id="<?php echo $this->get_field_id( 'division' ); ?>" name="<?php echo $this->get_field_name( 'division' ); ?>" class="widefat" style="width:100%;">
                <option value='nle' <?php if ( 'nle' === $instance['division'] ) echo 'selected="selected"'; ?>>NL East</option>
                <option value='nlc' <?php if ( 'nlc' === $instance['division'] ) echo 'selected="selected"'; ?>>NL Central</option>
                <option value='nlw' <?php if ( 'nlw' === $instance['division'] ) echo 'selected="selected"'; ?>>NL West</option>
                <option value='ale' <?php if ( 'ale' === $instance['division'] ) echo 'selected="selected"'; ?>>AL East</option>
                <option value='alc' <?php if ( 'alc' === $instance['division'] ) echo 'selected="selected"'; ?>>AL Central</option>
                <option value='alw' <?php if ( 'alw' === $instance['division'] ) echo 'selected="selected"'; ?>>AL West</option>
            </select>
        </div><br><?php


    }

    /**
     * Enqueue CSS and JavaScripts
     */

    public static function enqueue() {
        wp_enqueue_style( 'mgbs', plugins_url( 'css/' . 'mgbs.min.css', dirname( __FILE__ ) ), false, self::$ver );
        wp_enqueue_script( 'mgbs', plugins_url( 'js/' . 'mgbs.min.js', dirname( __FILE__ ) ), array( 'jquery' ), self::$ver, true );
        wp_localize_script( 'mgbs', 'mgbsAjax', array(
                'mgbsNonce' => wp_create_nonce( 'nonce_mgbs' ),
            )
        );

    }

}
