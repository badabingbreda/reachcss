<?php
/**
 * Helper functions for file operations
 *
 * @package packagename
 * @since 1.0.0
 * @author BadabingBreda
 * @link https://www.badabing.nl
 * @license GNU General Public License 2.0+
 */
namespace BeaverCSS\Helpers;

final class File {
    
	/**
	 * Create a directory if needed
	 * @param  [type] $dirname [description]
	 * @return [type]          [description]
	 */
	public static function create_dir( $dirname ) {

		$settings = self::dir_settings( $dirname );

	    // create the directory if it doesn't already exist
	    if ( ! file_exists( $settings[ 'cache_dir' ] ) )  {
	    	\wp_mkdir_p( $settings[ 'cache_dir' ] );
	    	chmod( $settings[ 'cache_dir' ] , 0755 );
	    }
	}

	/**
	 * Write a file with the stream
	 * @param  [type] $dirname  [description]
	 * @param  [type] $filename [description]
	 * @param  [type] $stream   [description]
	 * @return [type]           [description]
	 */
	public static function write_file( $dirname , $filename , $stream ) {

		$settings = self::dir_settings( $dirname );

	   // write the file
	    \file_put_contents( $settings[ 'cache_dir' ] . '/' .  $filename  , $stream );
		\chmod( $settings[ 'cache_dir' ] . '/' . $filename , 0755 );

	}    

	/**
	 * Get the wp_upload_dir and set our cache dir
	 * @param  [type] $dirname [description]
	 * @return [type]          [description]
	 */
	public static function dir_settings( $dirname ) {

		$upload_dir = \wp_upload_dir();

		$settings = array(
            'upload_dir' => $upload_dir,
            'cache_dir'	 => $upload_dir['basedir'] . '/'. $dirname,
		);

		return $settings;
	}    
    
    /**
     * get_file_path
     *
     * @param  mixed $relative_filepath
     * @return void
     */
    public static function get_file_path( $dirname ) {

        $settings = self::dir_settings( $dirname );
        return $settings['cache_dir'];
    }
}