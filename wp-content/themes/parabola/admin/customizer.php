<?php
/**
 * Contains methods for customizing the theme customization screen.
 * @since Parabola 1.4.1
 * @updated Parabola 1.7
 */

$cryout_customizer = array(

'info_sections' => array(
	'support' => array(
		'title' => __( 'Support', 'cryout' ),
		'desc' => __( 'Got a question? Need help?', 'cryout' ),
	),
	'rating' => array(
		'title' => __( 'Rating', 'cryout' ),
		'desc' => __( 'If you like the theme, rate it. If you hate the theme, rate it as well. Let us know how we can make it better.', 'cryout' ),
	),
), // info_sections

'info_settings' => array(
	'support_link1' => array(
		'default' => 'http://www.cryoutcreations.eu/' . _CRYOUT_THEME_NAME . '/' . _CRYOUT_THEME_NAME .'-faqs',
		'label' => __( 'Read the FAQs', 'cryout' ),
		'desc' => '',
		'section' => 'support',
	),
	'support_link2' => array(
		'default' => 'http://www.cryoutcreations.eu/forums/f/wordpress/' . _CRYOUT_THEME_NAME ,
		'label' => __( 'Browse the Forum', 'cryout' ),
		'desc' => '',
		'section' => 'support',
	),
	'premium_support_link' => array(
		'default' => 'https://www.cryoutcreations.eu/premium-support',
		'label' => __( 'Request Premium Support', 'cryout' ),
		'desc' => __( 'We also provide fast support via our premiums support system.', 'cryout' ),
		'section' => 'support',
	),
	'rating_url' => array(
		'default' => 'https://wordpress.org/support/view/theme-reviews/'. _CRYOUT_THEME_NAME .'#postform',
		'label' => sprintf( __( 'Rate %s on Wordpress.org', 'cryout' ) , ucwords(_CRYOUT_THEME_NAME) ),
		'desc' => '',
		'section' => 'rating',
	),
), // info_settings

'advanced_settings' => array(
	'default' => sprintf('themes.php?page=%1$s-page', _CRYOUT_THEME_NAME),
	'label' => ucwords(_CRYOUT_THEME_NAME) . ' ' . __(  'Settings', 'cryout' ),
	'desc' => __('To configure the remaining 200+ theme options, access the dedicated settings page.<br><br><em>The settings page is only available when the theme is active. It cannot be previewed in the Customizer.</em>', 'cryout' ),
	'section' => 'advanced_settings',
	'priority' => 999,
), // advanced_settings

); // theme_customizer

///////// CUSTOM CUSTOMIZERS
function cryout_customizer_extras($wp_customize) {

	class Cryout_Customize_Link_Control extends WP_Customize_Control {
			public $type = 'link';
			public function render_content() { 
				if ( !empty( $this->description ) ) { ?>
					<li class="customize-section-description-container">
						<div class="description customize-section-description">
						    <?php echo esc_attr( $this->description ); ?>
						</div>
					</li>
				<?php
				}
				echo '<a href="' . esc_url( $this->value() ) . '" target="_blank">' . $this->label .'</a>';
			}
	} // class Cryout_Customize_Link_Control
	
	class Cryout_Customize_Blank_Control extends WP_Customize_Control {
			public $type = 'blank';
			public function render_content() { 
				echo '&nbsp;';
			}
	} // class Cryout_Customize_Link_Control
	
} // cryout_customizer_extras()

function cryout_customizer_sanitize_blank(){
	// dummy function that does nothing, since the sanitized add_section 
	// calling it does not add any user-editable field
} // cryout_customizer_sanitize_blank()
 
class Cryout_Customizer {

   public static function register( $wp_customize ) {	
		global $cryout_customizer;
   
		// add about theme panel and sections
		if (!empty($cryout_customizer['info_sections'])):
		$wp_customize->add_panel( 'about', array(
			'priority'       => 0,
			'title'          => __( 'About', 'cryout' ). ' ' . ucwords(_CRYOUT_THEME_NAME),
			'description'    => ucwords(_CRYOUT_THEME_NAME) . __( ' by ', 'cryout' ) . 'Cryout Creations',
		) );
		$section_priority = 10;
		
		foreach ($cryout_customizer['info_sections'] as $iid=>$info):
			$wp_customize->add_section( $iid, array(
				'title'          => $info['title'],
				'description'    => $info['desc'],
				'priority'       => $section_priority++,
				'panel'  		 => 'about',
			) );
		endforeach;
		endif; //!empty
		
		foreach ($cryout_customizer['info_settings'] as $iid => $info):
			$wp_customize->add_setting( $iid, array(
				'default'        => $info['default'],
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'cryout_customizer_sanitize_blank'
			) );
			$wp_customize->add_control( new Cryout_Customize_Link_Control( $wp_customize, $iid, array(
				'label'   		=> $info['label'],
				'description'   => $info['desc'],
				'section' 		=> $info['section'],
				'settings'   	=> $iid,
				'priority'   	=> 10,
			) ) );				
		endforeach;		
		// end about panel
		
		// add settings page panel and section
		if (!empty($cryout_customizer['advanced_settings'])):
		$adv = $cryout_customizer['advanced_settings'];
		
		$wp_customize->add_section( $adv['section'], array(
			'title'          => $adv['label'],
			'description'    => '',
			'priority'       => $adv['priority'],
			//'panel'  => $adv['section'],
			) );
		
		$wp_customize->add_setting( $adv['section'], array(
			'default'        => $adv['default'],
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'cryout_customizer_sanitize_blank'
		) );
		$wp_customize->add_control( new Cryout_Customize_Link_Control( $wp_customize, $adv['section'], array(
			'label'   => $adv['label'],
			'description'  => $adv['desc'],
			'section' => $adv['section'],
			'settings'   => $adv['section'],
			'priority'   => $adv['priority'],
		) ) );				
		endif;
		// end settings panel

   
   } // register()
 
} // class Cryout_Customizer

// Setup the Theme Customizer settings and controls...
add_action( 'customize_register', 'cryout_customizer_extras' );
add_action( 'customize_register', array('Cryout_Customizer', 'register' ) );

?>