<?php
/**
 * Plugin Name: Events Calendar PRO Extension: Always Show Recurrence in Classic Editor
 * Description:  This extension ensures that the recurring-event edit fields are forced to always show in the Classic Editor.
 * Version: 1.0.0
 * Author: Modern Tribe, Inc.
 * Author URI: http://m.tri.be/1971
 * License: GPLv2 or later
 */

defined( 'WPINC' ) or die;

class Tribe__Extension__Always_Show_Recurrence_in_Classic_Editor {

    const VERSION = '1.0.0';

    /**
     * Each plugin required by this extension
     *
     * @var array Plugins are listed in 'main class' => 'minimum version #' format
     */
    public $plugins_required = array(
        'Tribe__Events__Main'      => '4.7',
        'Tribe__Events__Pro__Main' => '4.5'
    );

    /**
     * The constructor; delays initializing the extension until all other plugins are loaded.
     */
    public function __construct() {
        add_action( 'plugins_loaded', array( $this, 'init' ), 100 );
    }

    /**
     * Extension hooks and initialization; exits if the extension is not authorized by Tribe Common to run.
     */
    public function init() {

        // Exit early if our framework is saying this extension should not run.
        if ( ! function_exists( 'tribe_register_plugin' ) || ! tribe_register_plugin( __FILE__, __CLASS__, self::VERSION, $this->plugins_required ) ) {
            return;
        }

        add_filter( 'tribe_events_pro_show_recurrence_meta_box', '__return_true', 20 );
    }

}

new Tribe__Extension__Always_Show_Recurrence_in_Classic_Editor();
