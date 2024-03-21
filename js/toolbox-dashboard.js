(function ($) {
    $(document).ready( function() {
        $('#adminoptions-tab').jqTabs( { duration: 200 });
        $("#adminoptions-tab .jq-tab-menu .jq-tab-title").click( function () {
            // show hash in top-bar
            window.location.hash= $(this).data("tab");
        });
        // change active tab to hash if found
        if ( window.location.hash ) {
            var url = window.location.href,
                tab = url.substring(url.indexOf('#')+1);
        } else {
                tab = 'default';
        }
        // activate the button and content
        $('[data-tab='+tab+']').addClass('active');
    });
})(jQuery);

beaverCSS = function ( settings ) {
    this.settings = settings;
}

beaverCSS.prototype = {
    FILTERS: {},
    ACTIONS: {},

    init : function() {

        const _this = this;

        this.add_action( 'init' , this.initSwitch.bind( _this ) , 10 );
        this.add_filter( 'getControlValue' , this.getControlSwitchValue.bind( this ) , 10 );
        this.add_filter( 'getControlValue' , this.getControlColorValue.bind( this ) , 10 );
        this.add_filter( 'getControlValue' , this.getControlTextValue.bind( this ) , 10 );

        this.do_action( 'init' , this.settings );
    },
    
    initSwitch : function( settings ) {
        document.querySelectorAll( '.control-field.switch input' ).forEach( 
            function( elem ) {
                this.initState( elem );
                elem.addEventListener( 'change' , function (e) { this.handleSwitchClick( e ); }.bind( this ) );
            }.bind( this )
        );
    },

    handleSwitchClick : function ( e ) {
        const switchElem = e.target.closest( '.control-field' );
        let target = switchElem.dataset.switchTarget,
            classtoggle = switchElem.dataset.switchClasstoggle;

        document.querySelector( target ).classList.toggle( classtoggle );

    },

    initState : function( elem ) {
        const switchElem = elem.closest( '.control-field' );
        let target = switchElem.dataset.switchTarget,
            classtoggle = switchElem.dataset.switchClasstoggle,
            laststate = switchElem.dataset.switchLaststate;
        
            if ( laststate ) { 
                document.querySelector( target ).classList.remove( classtoggle );
            } else {
                document.querySelector( target ).classList.add( classtoggle );
            }
    },

    collect : function() {
        const tabs = document.querySelectorAll( '.jq-tab-content' );
        let settings = {};
        // go over the tabs
        tabs.forEach( (tab) => {
            // go over the controls
            tab.querySelectorAll( '.control-field' ).forEach( (control) => {
                var currentValue = this.apply_filters( 'getControlValue' , null , control , control.dataset.controlType );
                settings = {...settings , ...currentValue };
            });
        });

        alert( JSON.stringify(settings) );
    },

    getControlSwitchValue : function ( value , elem, type ) {
        // return the value early
        if ( type !== 'switch' ) return value;
        return { [elem.querySelector( 'input' ).id] : elem.querySelector( 'input' ).checked };
    },

    getControlColorValue : function ( value , elem, type ) {
        // return the value early
        if ( type !== 'color' ) return value;
        return { [elem.querySelector( 'input' ).id] : elem.querySelector( 'input' ).value };
    },

    getControlTextValue : function ( value , elem, type ) {
        // return the value early
        if ( type !== 'text' ) return value;
        return { [elem.querySelector( 'input' ).id] : `"${elem.querySelector( 'input' ).value}"` };
    },


   /**
     * http://undolog.com/wordpress-actions-and-filters-in-javascript/
     * 
     * @param {*} type 
     * @param {*} tag 
     * @param {*} function_to_add 
     * @param {*} priority 
     */
   _add: function( type, tag, function_to_add, priority )
   {
     var lists = ( 'filter' == type ) ? this.FILTERS : this.ACTIONS;
 
     // Defaults
     priority = ( priority || 10 );
 
     if( !( tag in lists ) ) {
       lists[ tag ] = [];
     }
 
     if( !( priority in lists[ tag ] ) ) {
       lists[ tag ][ priority ] = [];
     }
 
     lists[ tag ][ priority ].push( {
       func : function_to_add,
       pri  : priority
     } );
 
   }, 

   _do :function( type, args ) {
       var hook, lists = ( 'action' == type ) ? this.ACTIONS : this.FILTERS;
       var tag = args[ 0 ];

       if( !( tag in lists ) ) {
           return args[ 1 ];
       }

       // Remove the first argument
       [].shift.apply( args );

       for( var pri in lists[ tag ] ) {

       hook = lists[ tag ][ pri ];

       if( typeof hook !== 'undefined' ) {

           for( var f in hook ) {
           var func = hook[ f ].func;

           if( typeof func === "function" ) {

               if( 'filter' === type ) {
                   args[ 0 ] = func.apply( null, args );
               } else {
                   func.apply( null, args );
               }
           }
           }
       }
       }

       if( 'filter' === type ) {
           return args[ 0 ];
       }

   },

   add_filter: function( hook , callback , priority ) {
       this._add( 'filter' , hook , callback , priority );
   },

   add_action: function( hook , callback , priority ) {
       this._add( 'action' , hook , callback , priority );
   },

   apply_filters : function( hook , value, varargs ) {
       return this._do( 'filter', arguments );
   },

   do_action : function( hook , args ) {
       this._do( 'action', arguments );
   },

   // todo
   remove_filter: function( hook , callback , priority ) {

   },

   // todo
   remove_action: function ( hook , callback , priority ) {

   },

   global_actions: function( ) {
       if ( typeof document.beaverCSSActions !== 'undefined' ) {
           document.beaverCSSActions.forEach( action => {
               if ( 
                   action.id == this.settings?.id && 
                   action?.hook || false && 
                   ( typeof action?.callback || false ) == 'function' 
               ) {
                   this.add_action( action.hook , action.callback.bind( this ) , action?.priority || 10 );
               }
           });
       }
       if ( typeof document.beaverCSSFilters !== 'undefined' ) {
           document.beaverCSSFilters.forEach( action => {
               if ( 
                   action.id == this.settings?.id && 
                   action?.hook || false && 
                   ( typeof action?.callback || false ) == 'function' 
               ) {
                   this.add_filter( action.hook , action.callback.bind( this ) , action?.priority || 10 );
               }
           });
       }
   },

}

window.onload = function( event ) {
    window.beaverCSS = new beaverCSS( {} );
    window.beaverCSS.init();
}


