document.savvyPanelActions = [
    { 
        hook : 'savvyUpdate',
        priority : 10,
        callback: ( savvy ) => {

            savvy.sending = true;

            const settings = savvy.collectSettings();
    
            // use fetch
            fetch( SAVVYPANEL_LOCAL.admin_ajax_url + `?action=savvypanel_update`,
            {
                method: 'POST',
                headers: { 
                    'Accept' : 'application/json',
                    'Content-Type': 'application/json',
                    'X-WP-Nonce': SAVVYPANEL_LOCAL._wpnonce,
                },
                body: savvy.asFormData( settings ),
            } )
            .then( ( response ) => response.json() )
            .then( ( data ) => {
                    savvy.sending = false;
                    console.log( data.notifications );
                    data.notifications.forEach( (noti, index) => {
                        setTimeout( () => { notis.create( { title : noti.title , description : noti.description , duration: 5 ,  destroyOnClick: true } ); } , index * 300 );
                    });
            })
            .catch( (error) => {
                savvy.sending = false;
                console.log( 'I messed up ' , error );
            } );
        }
    }
];
