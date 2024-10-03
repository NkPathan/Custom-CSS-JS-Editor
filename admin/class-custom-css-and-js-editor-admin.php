<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/NkPathan/
 * @since      1.0.0
 *
 * @package    Custom_Css_And_Js_Editor
 * @subpackage Custom_Css_And_Js_Editor/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Custom_Css_And_Js_Editor
 * @subpackage Custom_Css_And_Js_Editor/admin
 * @author     Test <test@test.com>
 */
class Custom_Css_And_Js_Editor_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Custom_Css_And_Js_Editor_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Custom_Css_And_Js_Editor_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/custom-css-and-js-editor-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Custom_Css_And_Js_Editor_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Custom_Css_And_Js_Editor_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name.'-ace-editor', 'https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.13/ace.js', array(), $this->version, false );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/custom-css-and-js-editor-admin.js', array( 'jquery' ), $this->version, false );

	}
	/**
	 * Register the Submenu
	 *
	 * @since    1.0.0
	 */
	public function customCSSAndJSEditorSubmenu(){
	    add_submenu_page(
	         'tools.php',
            'Custom CSS/JS Editor',
            'Custom CSS/JS Editor',
            'manage_options',
            'custom-css-and-js-editor-admin',
            array(&$this,'customCssAndJSEditorAdmin' ));
	}
	public function customCssAndJSEditorAdmin(){
		// Handle form submission
	    if ( isset( $_POST['customCodeEditorNonce'] ) && wp_verify_nonce( $_POST['customCodeEditorNonce'], 'customCodeEditorSave' ) ) {
	        update_option( 'custom_code_editor_css', wp_unslash(sanitize_textarea_field( $_POST['custom_code_editor_css'] ) ) );
	        update_option( 'custom_code_editor_js', wp_unslash(sanitize_textarea_field( $_POST['custom_code_editor_js'] ) ) );
	    }

	    $backendLoadCSS = get_option( 'custom_code_editor_css', '' );
	    $backendLoadJS = get_option( 'custom_code_editor_js', '' );

	    ?>
	    <div class="custom-css-js-editor-panel-wrapper">
	        <h1 class="custom-css-js-editor-panel-title"><?php esc_html_e( 'Custom CSS/JS Code Editor', 'custom-css-and-js-editor' ); ?></h1>
	        <form method="post" action="" class="custom-css-js-editor-code-form">
	            <?php wp_nonce_field( 'customCodeEditorSave', 'customCodeEditorNonce' ); ?>
	            <table class="form-table">
	                <tr>
	                    <th scope="row"><label for="custom_code_editor_css"><?php esc_html_e( 'Custom CSS', 'custom-css-and-js-editor' ); ?></label></th>
	                    <td>
	                        <div id="custom-css-editor-code-panel"><?php echo esc_textarea( $backendLoadCSS ); ?></div>
	        				<textarea id="custom-css-editor-textarea-panel" name="custom_code_editor_css" style="display:none;"></textarea>
	                    </td>
	                </tr>
	                <tr>
	                    <th scope="row"><label for="custom_code_editor_js"><?php esc_html_e( 'Custom JS', 'custom-css-and-js-editor' ); ?></label></th>
	                    <td>
	                        <div id="custom-js-editor-code-panel"><?php echo esc_textarea( $backendLoadJS ); ?></div>
	        				<textarea id="custom-js-editor-textarea-panel" name="custom_code_editor_js" style="display:none;"></textarea>
	                    </td>
	                </tr>
	            </table>
	            <?php submit_button( __( 'Save Changes', 'custom-css-and-js-editor' ) ); ?>
	        </form>
	    </div>
	    <?php
	}
	function customCodeEditorAddCustomCSS() {
    $frontLoadCSS = get_option( 'custom_code_editor_css', '' );
    	if ( ! empty( $frontLoadCSS ) ) {
        	echo '<style type="text/css">' . wp_strip_all_tags( $frontLoadCSS ) . '</style>';
    	}
	}
	function customCodeEditorAddCustomJS() {
    	$frontLoadJS = get_option( 'custom_code_editor_js', '' );
    	if ( ! empty( $frontLoadJS ) ) {
        	echo '<script type="text/javascript">' . wp_strip_all_tags( $frontLoadJS ) . '</script>';
    	}
	}
}
