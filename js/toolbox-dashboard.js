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

