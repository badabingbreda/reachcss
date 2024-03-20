<?php
namespace BeaverCSS\Helpers;

class AdminControls {

    
    
    /**
     * switch
     * 
     * use:
     * 
     * <?php 
     *      Toolbox\Helpers\AdminControls::switch( [ 
     *              'name' => 'enable-post-type',
     *  	        'state' => \get_option( 'my-enable-post-type' , false ),
     *              'class' => 'extra-classname'
     *      ] );
     * ?>
     *
     * @param  mixed $settings
     * @return void
     */
    public static function switch( $settings ) {

        $settings = wp_parse_args( 
            $settings, 
            [
                "name" => "",
                "state" => false,
                "class" => null,
            ] );

        $state = $settings[ "state" ] ? "checked" : "";
    ?>
        <div class="control-field switch <?php self::outputIf( $settings[ 'class' ] ); ?>">
            <label>
                <input type="checkbox" 
                    id="<?php echo $settings[ "name" ]; ?>" 
                    name="<?php echo $settings[ "name" ]; ?>" 
                    <?php echo $state;?> 
                    >
                <span class="slider round"></span>
            </label>		
        </div>

    <?php        
    }
    
    /**
     * slider
     * 
     * @usage https://github.com/toolcool-org/toolcool-range-slider
     *
     * @param  mixed $name          'my_field'
     * @param  mixed $options       [ 'option1' , 'option2' , 'option3' ]
     * @param  mixed $value         'option2'
     * @param  mixed $settings      optional: [ 'generate_labels' => false ]
     * @return void
     */
    public static function slider( $settings ) {
        $settings = wp_parse_args( 
                $settings,
                [
                    "name" => "",
                    "options" => [],
                    "selected_value" => "",
                    "generate_labels" => true,
                    "class" => null,
                ]
        );
        ?>
        <div class="control-field slider <?php self::outputIf( $settings[ 'class' ] ); ?>">
        <div id="<?php echo $settings[ "name" ]; ?>-label" class="slider-label"></div>
        <input type="hidden" 
        id="<?php echo $settings[ "name" ]; ?>" 
        name="<?php echo $settings[ "name" ]; ?>" 
        value="<?php echo $settings[ "selected_value" ]; ?>" >
        <tc-range-slider 
            id="slider_<?php echo $settings[ "name" ]; ?>" 
            data="<?php echo implode( ',' , $settings[ "options" ] )?>" 
            value="<?php echo $settings[ "selected_value" ]; ?>" 
            generate-labels="<?php echo $settings[ 'generate_labels' ] ? 'true' : 'false'; ?>" 
            value-label="#<?php echo $settings[ "name" ]; ?>-label"></tc-range-slider>
            <script>
                {
                    let slider = document.querySelector( '#slider_<?php echo $settings[ 'name' ];?>' );
                    // listen to the change event
                    slider.addEventListener( 'change', ( e ) => {
                        // change a hidden input value to the sent event value
                        document.querySelector( '[name="<?php echo $settings[ 'name' ] ;?>"]' ). value = e.detail.value
                    });
                }                
            </script>
        <?php
    }
    
    /**
     * dropdown
     *
     * @param  mixed $name
     * @param  mixed $options   [ 2: , [] , [] ]
     * @param  mixed $value
     * @return void
     */
    public static function dropdown( $settings ) {
        $settings = wp_parse_args( 
            $settings,
            [
                "name" => "",
                "options" => [],
                "selected_value" => "",
                "class" => null,
            ]
    );
    ?>
    <div class="control-field dropdown <?php self::outputIf( $settings[ 'class' ] ); ?>">
        <select name="<?php echo $settings[ "name" ]; ?>" id="<?php echo $settings[ "name" ]; ?>">
            <?php foreach ($settings[ "options" ] as $option ): ?>
            <option value="<?php echo $option[ 'value' ]; ?>" 
                <?php selected( $option[ 'value' ] , $settings[ "selected_value" ] );?>>
                <?php echo $option['label']; ?>
            </option>
            <?php endforeach;?>
        </select>
        </div>
        <?php
    }
    
    /**
     * text
     *
     * @param  mixed $name
     * @param  mixed $value
     * @param  mixed $placeholder
     * @return void
     */
    public static function text( $settings ) {
        $settings = wp_parse_args( 
            $settings,
            [
                "name" => "",
                "value" => "",
                "placeholder" => "",
                "class" => null,
            ]
    );
    ?>        <div class="control-field text <?php self::outputIf( $settings[ 'class' ] ); ?>">
            <input 
                type="text" 
                name="<?php echo $settings[ "name" ]; ?>" 
                value="<?php echo $settings[ "value" ] ; ?>" 
                placeholder="<?php echo $settings[ "placeholder" ]; ?>">
        </div>
        <?php
    }
    
    /**
     * submit
     *
     * @param  mixed $settings
     * @return void
     */
    public static function submit( $settings ) {
        $settings = wp_parse_args( 
            $settings,
            [
                "name" => "",
                "type" => "submit",
                "value" => "Update",
                "class" => null,
            ]
        );

        echo "<input type=\"{$settings['type']}\" name=\"update\" class=\"{$settings['class']}\" value=\"{$settings['value']}\" />";
    }
    
    /**
     * checkbox
     * 
     * use:
     * 
     *
     * @param  mixed $settings
     * @return void
     */
    public static function multi_checkbox( $settings ) {
        $settings = wp_parse_args( 
            $settings,
            [
                "name" => "",
                "options" => "",
                "class" => null,
            ]
        );

        $template = '<p><input type="checkbox" name="'.$settings['name'].'[]" id="'.$settings['name'].'_%s" value="%s" %s %s><label for="'.$settings['name'].'_%s">%s</label></p>';

        foreach ($settings['options'] as $option) {
            printf($template, 
                        $option['value'], 
                        $option['value'], 
                        \checked( $option['checked'], true, false ),
                        \disabled( $option['disabled'] , true, false ),
                        $option['value'], 
                        $option['name']);
        }


    }

    public static function outputIf( $value ) {
        if ( $value !== null ) echo $value;
    }
}