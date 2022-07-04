<?php
/**
 * Extension-Boilerplate
 * @link https://github.com/ReduxFramework/extension-boilerplate
 *
 * Radium Importer - Modified For ReduxFramework
 * @link https://github.com/FrankM1/radium-one-click-demo-install
 *
 * @package     WBC_Importer - Extension for Importing demo content
 * @author      Webcreations907
 * @version     1.0.1
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// Don't duplicate me!
if ( !class_exists( 'ReduxFramework_extension_wbc_importer' ) ) {


	/************************************************************************
	* Extended Example:
	* Way to set menu, import revolution slider, and set home page.
	*************************************************************************/
	if ( !function_exists( 'wbc_extended_example' ) ) {
		function wbc_extended_example( $demo_active_import , $demo_directory_path ) {
			reset( $demo_active_import );
			$current_key = key( $demo_active_import );
			/************************************************************************
			* Import slider(s) for the current demo being imported
			*************************************************************************/
			if ( class_exists( 'RevSlider' ) ) {
				//If it's demo3 or demo5
				$wbc_sliders_array = array(
					'demo1' => 'newslider2014.zip', //Set slider zip name
					'demo2' => 'newslider2014.zip', //Set slider zip name
				);
				if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && array_key_exists( $demo_active_import[$current_key]['directory'], $wbc_sliders_array ) ) {
					$wbc_slider_import = $wbc_sliders_array[$demo_active_import[$current_key]['directory']];
					if ( file_exists( $demo_directory_path.$wbc_slider_import ) ) {
						$slider = new RevSlider();
						$slider->importSliderFromPost( true, true, $demo_directory_path.$wbc_slider_import );
					}
				}
			}
			/************************************************************************
			* Setting Menus
			*************************************************************************/
			// If it's demo1 - demo6
			$wbc_menu_array = array( 'demo1' );
			if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && in_array( $demo_active_import[$current_key]['directory'], $wbc_menu_array ) ) {
				$top_menu = get_term_by( 'name', 'Top Menu', 'nav_menu' );
				$main_menu = get_term_by( 'name', 'Header Menu', 'nav_menu' );
				$footer_menu = get_term_by( 'name', 'Footer Menu', 'nav_menu' );
				if ( isset( $top_menu->term_id ) ) {
					set_theme_mod( 'nav_menu_locations', array(
						'top-menu' => $top_menu->term_id,
						'primary-menu' => $main_menu->term_id,
						'footer-menu' => $footer_menu->term_id
					));
				}
			}
			$wbc_menu_array = array( 'demo2' );
			if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && in_array( $demo_active_import[$current_key]['directory'], $wbc_menu_array ) ) {
				$top_menu = get_term_by( 'name', 'Top Menu', 'nav_menu' );
				$main_menu = get_term_by( 'name', 'Header Menu', 'nav_menu' );
				$footer_menu = get_term_by( 'name', 'Footer Menu', 'nav_menu' );
				if ( isset( $top_menu->term_id ) ) {
					set_theme_mod( 'nav_menu_locations', array(
						'top-menu' => $top_menu->term_id,
						'primary-menu' => $main_menu->term_id,
						'footer-menu' => $footer_menu->term_id
					));
				}
			}
		/************************************************************************
		* Set HomePage
		*************************************************************************/
		// array of demos/homepages to check/select from
		$wbc_home_pages = array(
			'demo1' => 'Home',
			'demo2' => 'Home',
		);
		$wbc_blog_pages = array(
			'demo1' => 'Blog',
			'demo2' => 'Blog',
		);
		if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && array_key_exists( $demo_active_import[$current_key]['directory'], $wbc_home_pages ) ) {
			$page = get_page_by_title( $wbc_home_pages[$demo_active_import[$current_key]['directory']] );
			if ( isset( $page->ID ) ) {
				update_option( 'page_on_front', $page->ID );
				update_option( 'show_on_front', 'page' );
				
				//Update Widgets Switch to On
				$all_widgets_on = 'a:40:{s:6:"button";b:1;s:10:"google-map";b:1;s:5:"image";b:1;s:6:"slider";b:1;s:13:"post-carousel";b:1;s:6:"editor";b:1;s:12:"alert-widget";b:1;s:14:"counter-widget";b:1;s:21:"featured-block-widget";b:1;s:19:"gallery-grid-widget";b:1;s:4:"icon";b:1;s:15:"carousel-widget";b:1;s:17:"posts-list-widget";b:1;s:18:"progressbar-widget";b:1;s:19:"sermons-list-widget";b:1;s:21:"sermons-albums-widget";b:1;s:17:"staff-grid-widget";b:1;s:13:"spacer-widget";b:1;s:11:"tabs-widget";b:1;s:8:"taxonomy";b:1;s:13:"toggle-widget";b:1;s:11:"testimonial";b:1;s:30:"upcoming-events-listing-widget";b:1;s:5:"video";b:1;s:14:"simple-masonry";b:1;s:20:"social-media-buttons";b:1;s:11:"price-table";b:1;s:13:"layout-slider";b:1;s:10:"image-grid";b:1;s:4:"hero";b:1;s:8:"headline";b:1;s:8:"features";b:1;s:7:"contact";b:1;s:3:"cta";b:1;s:20:"blog-timeline-widget";b:1;s:12:"cause-widget";b:1;s:31:"event-grid-minimal-style-widget";b:1;s:32:"event-listing-with-filter-widget";b:1;s:28:"posts-full-width-list-widget";b:1;s:26:"event-grid-timeline-widget";b:1;}';
				$all_widgets_on = unserialize($all_widgets_on);
				update_option('siteorigin_widgets_active', $all_widgets_on);
				
			}
		}
		if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && array_key_exists( $demo_active_import[$current_key]['directory'], $wbc_blog_pages ) ) {
			$bpage = get_page_by_title( $wbc_blog_pages[$demo_active_import[$current_key]['directory']] );
			if ( isset( $bpage->ID ) ) {
				update_option( 'page_for_posts', $bpage->ID );
			}
		}
	}
	// Uncomment the below
	add_action( 'wbc_importer_after_content_import', 'wbc_extended_example', 10, 2 );
	}


    class ReduxFramework_extension_wbc_importer {

        public static $instance;

        static $version = "1.0.1";

        protected $parent;

        private $filesystem = array();

        public $extension_url;

        public $extension_dir;

        public $demo_data_dir;

        public $wbc_import_files = array();

        public $active_import_id;

        public $active_import;


        /**
         * Class Constructor
         *
         * @since       1.0
         * @access      public
         * @return      void
         */
        public function __construct( $parent ) {

            $this->parent = $parent;

            if ( !is_admin() ) return;

            //Hides importer section if anything but true returned. Way to abort :)
            if ( true !== apply_filters( 'wbc_importer_abort', true ) ) {
                return;
            }

            if ( empty( $this->extension_dir ) ) {
                $this->extension_dir = trailingslashit( str_replace( '\\', '/', dirname( __FILE__ ) ) );
                $this->extension_url = site_url( str_replace( trailingslashit( str_replace( '\\', '/', ABSPATH ) ), '', $this->extension_dir ) );
                $this->demo_data_dir = apply_filters( "wbc_importer_dir_path", $this->extension_dir . 'demo-data/' );
            }

            //Delete saved options of imported demos, for dev/testing purpose
            // delete_option('wbc_imported_demos');

            $this->getImports();

            $this->field_name = 'wbc_importer';

            self::$instance = $this;

            add_filter( 'redux/' . $this->parent->args['opt_name'] . '/field/class/' . $this->field_name, array( &$this,
                    'overload_field_path'
                ) );

            add_action( 'wp_ajax_redux_wbc_importer', array(
                    $this,
                    'ajax_importer'
                ) );

            add_filter( 'redux/'.$this->parent->args['opt_name'].'/field/wbc_importer_files', array(
                    $this,
                    'addImportFiles'
                ) );

            //Adds Importer section to panel
            $this->add_importer_section();


        }


        public function getImports() {

            if ( !empty( $this->wbc_import_files ) ) {
                return $this->wbc_import_files;
            }

            $this->filesystem = $this->parent->filesystem->execute( 'object' );

            $imports = $this->filesystem->dirlist( $this->demo_data_dir, false, true );

            $imported = get_option( 'wbc_imported_demos' );

            if ( !empty( $imports ) ) {
                $x = 1;
                foreach ( $imports as $import ) {

                    if ( !isset( $import['files'] ) || empty( $import['files'] ) ) {
                        continue;
                    }

                    if ( $import['type'] == "d" && !empty( $import['name'] ) ) {
                        $this->wbc_import_files['wbc-import-'.$x] = isset( $this->wbc_import_files['wbc-import-'.$x] ) ? $this->wbc_import_files['wbc-import-'.$x] : array();
                        $this->wbc_import_files['wbc-import-'.$x]['directory'] = $import['name'];

                        if ( !empty( $imported ) && is_array( $imported ) ) {
                            if ( array_key_exists( 'wbc-import-'.$x, $imported ) ) {
                                $this->wbc_import_files['wbc-import-'.$x]['imported'] = 'imported';
                            }
                        }

                        foreach ( $import['files'] as $file ) {
                            switch ( $file['name'] ) {
                            case 'content.xml':
                                $this->wbc_import_files['wbc-import-'.$x]['content_file'] = $file['name'];
                                break;

                            case 'theme-options.txt':
                            case 'theme-options.json':
                                $this->wbc_import_files['wbc-import-'.$x]['theme_options'] = $file['name'];
                                break;

                            case 'widgets.json':
                            case 'widgets.txt':
                                $this->wbc_import_files['wbc-import-'.$x]['widgets'] = $file['name'];
                                break;

                            case 'screen-image.png':
                            case 'screen-image.jpg':
                            case 'screen-image.gif':
                                $this->wbc_import_files['wbc-import-'.$x]['image'] = $file['name'];
                                break;
                            }

                        }

                        if ( !isset( $this->wbc_import_files['wbc-import-'.$x]['content_file'] ) ) {
                            unset( $this->wbc_import_files['wbc-import-'.$x] );
                            if ( $x > 1 ) $x--;
                        }

                    }

                    $x++;
                }

            }

        }

        public function addImportFiles( $wbc_import_files ) {

            if ( !is_array( $wbc_import_files ) || empty( $wbc_import_files ) ) {
                $wbc_import_files = array();
            }

            $wbc_import_files = wp_parse_args( $wbc_import_files, $this->wbc_import_files );

            return $wbc_import_files;
        }

        public function ajax_importer() {
            if ( !isset( $_REQUEST['nonce'] ) || !wp_verify_nonce( $_REQUEST['nonce'], "redux_{$this->parent->args['opt_name']}_wbc_importer" ) ) {
                die( 0 );
            }
            if ( isset( $_REQUEST['type'] ) && $_REQUEST['type'] == "import-demo-content" && array_key_exists( $_REQUEST['demo_import_id'], $this->wbc_import_files ) ) {

                $reimporting = false;

                if( isset( $_REQUEST['wbc_import'] ) && $_REQUEST['wbc_import'] == 're-importing'){
                    $reimporting = true;
                }

                $this->active_import_id = $_REQUEST['demo_import_id'];

                $import_parts         = $this->wbc_import_files[$this->active_import_id];

                $this->active_import = array( $this->active_import_id => $import_parts );

                $content_file        = $import_parts['directory'];
                $demo_data_loc       = $this->demo_data_dir.$content_file;

                if ( file_exists( $demo_data_loc.'/'.$import_parts['content_file'] ) && is_file( $demo_data_loc.'/'.$import_parts['content_file'] ) ) {

                    if ( !isset( $import_parts['imported'] ) || true === $reimporting ) {
                        include $this->extension_dir.'inc/init-installer.php';
                        $installer = new Radium_Theme_Demo_Data_Importer( $this, $this->parent );
                    }else {
                        echo esc_html__( "Demo Already Imported", 'framework' );
                    }
                }

                die();
            }

            die();
        }

        public static function get_instance() {
            return self::$instance;
        }

        // Forces the use of the embeded field path vs what the core typically would use
        public function overload_field_path( $field ) {
            return dirname( __FILE__ ) . '/' . $this->field_name . '/field_' . $this->field_name . '.php';
        }

        function add_importer_section() {
            // Checks to see if section was set in config of redux.
            for ( $n = 0; $n < count( $this->parent->sections ); $n++ ) {
                if ( isset( $this->parent->sections[$n]['id'] ) && $this->parent->sections[$n]['id'] == 'wbc_importer_section' ) {
                    return;
                }
            }

            $wbc_importer_label = trim( esc_html( apply_filters( 'wbc_importer_label', __( 'Demo Importer', 'framework' ) ) ) );

            $wbc_importer_label = ( !empty( $wbc_importer_label ) ) ? $wbc_importer_label : __( 'Demo Importer', 'framework' );

            $this->parent->sections[] = array(
                'id'     => 'wbc_importer_section',
                'title'  => $wbc_importer_label,
                'desc'   => '<p class="description">'. apply_filters( 'wbc_importer_description', __( 'Works best when import done on a fresh/new install of WordPress. This process heavily rely on your hosting server configuration. For recommended settings <a href="https://support.imithemes.com/how-to-increase-the-wordpress-file-upload-size/" target="_blank">Check this link</a>', 'framework' ) ).'</p>',
                'icon'   => 'el-icon-website',
                'fields' => array(
                    array(
                        'id'   => 'wbc_demo_importer',
                        'type' => 'wbc_importer'
                    )
                )
            );
        }

    } // class
} // if
