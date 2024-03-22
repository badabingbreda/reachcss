<?php
namespace BeaverCSS;

use BeaverCSS\Helpers\File;

use \ScssPhp\ScssPhp\Compiler;

class BeaverParser {

	private static $directory = 'beavercss/';  // directory relative to the wp-content/uploads/ directory

    private static $filename = 'beavercss';    // just the filename. no extension because we add that dynamically based on the minification setting

    public function __construct() {

        add_action( 'init' , __CLASS__ . '::try_compile' );
    }
    
    public static function try_compile() {
        
        if ( !file_exists( File::get_file_path( self::$directory ) . '/' . self::$filename . '.css' ) ) {
            self::compile();
        }
    }

    public static function compile() {

        require_once( BEAVERCSS_DIR . 'vendor/autoload.php' );

        /**
         * Instanciate a new Compiler
         */
        $compiler = new Compiler();

        /**
         * set import paths
         */
        $compiler->setImportPaths( BEAVERCSS_DIR . 'scss/' );

        $variables = apply_filters( 'beavercss/variables' , [] );

        /**
         * add variables at this point. 
         * If missing !default will be used in scss file(s).
         **/ 
        $compiler->addVariables( $variables );

        /**
         * Compile to string and get css
         * !!todo: add try-catch for error handling
         */

         try {
             $css = $compiler->compileString( "@import \"beavercss.scss\";" )->getCss();
         } catch (\Exception $e) {
            $css = "somthing didn't go as planned...";
         }

        // prepend with datetime stamp

        $css = self::datetimestamp() . $css;

        // create the directory if not already exists
        File::create_dir( self::$directory );
        File::write_file( self::$directory ,  self::$filename . '.css' , $css );
    }

    private static function datetimestamp() {

        return "/** BeaverCSS Version " . BEAVERCSS_VERSION . ", Generated on: " . date( 'Y-m-d H:i:s' ) . " **/\r\n";
    }
}