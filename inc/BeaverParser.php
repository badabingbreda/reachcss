<?php
namespace ReachCSS;

use ReachCSS\Helpers\File;

use \ScssPhp\ScssPhp\Compiler;

class ReachParser {

	private static $directory = 'reachcss/';  // directory relative to the wp-content/uploads/ directory

    private static $filename = 'reachcss';    // just the filename. no extension because we add that dynamically based on the minification setting

    public function __construct() {

        add_action( 'init' , __CLASS__ . '::try_compile' );
    }
        
    /**
     * try_compile
     *
     * @return void
     */
    public static function try_compile() {
        
        if ( !file_exists( File::get_file_path( self::$directory ) . '/' . self::$filename . '.css' ) ) {
            self::compile();
        }
    }
    
    /**
     * compile
     *
     * @return void
     */
    public static function compile() {

        $success = false;

        /**
         * Instanciate a new Compiler
         */
        $compiler = new Compiler();

        /**
         * set import paths
         */
        $compiler->setImportPaths( BEAVERCSS_DIR . 'import/scss/' );

        $variables = apply_filters( 'reachcss/variables' , [] );

        /**
         * add variables at this point. 
         * If missing !default will be used in scss file(s).
         **/ 
        $compiler->addVariables( $variables );

        /**
         * Compile to string and get css
         */

         try {
             $css = $compiler->compileString( "@import \"reachcss.scss\";" )->getCss();
             $success = true;
         } catch (\Exception $e) {
            $css = "somthing didn't go as planned...";
            $success = false;
         }

         if ( $success ) {

            // prepend with datetime stamp
             $css = self::datetimestamp() . $css;
             // create the directory if not already exists
             File::create_dir( self::$directory );
             File::write_file( self::$directory ,  self::$filename . '.css' , $css );
             // add or update option value
             \update_option( 'reachcss_fileversion' , date( 'Ymd-His') );
         }
         return $success;
    }
    
    /**
     * datetimestamp
     *
     * @return void
     */
    private static function datetimestamp() {

        return "/** ReachCSS Version " . BEAVERCSS_VERSION . ", Generated on: " . date( 'Y-m-d H:i:s' ) . " **/\r\n";
    }
}