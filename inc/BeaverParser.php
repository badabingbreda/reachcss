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

        $compiler = new Compiler();
        // set import paths
        $compiler->setImportPaths( BEAVERCSS_DIR . 'scss/' );


        $css = $compiler->compileString( "@import \"beavercss.scss\";" )->getCss();

        // create the directory if not already exists
        File::create_dir( self::$directory );
        File::write_file( self::$directory ,  self::$filename . '.css' , $css );
    }
}