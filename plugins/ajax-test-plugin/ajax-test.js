jQuery.noConflict();
(function($) {    
    $( 'a.ajax-post' ).on( 'click', function( e ) { 
        // Prevent Default Behaviour 
        e.preventDefault();

        // Get Post ID 
        var postID = $(this).data('postid');
        console.log('PostID being called is: ' + postID);
        console.log('nonce: ' + ajax_object.nextNonce);
        
        $.ajax({
            url: ajax_object.ajax_url,
            type: 'GET',
            data: {
                action: 'get_post_content', // The PHP call back function to run
				nextNonce : ajax_object.nextNonce, // end the nonce along with the request
                id: postID // Get the post with this ID
            },
            success: function(data, textStatus) {
                console.log('Get Post Content: ' + textStatus);
                console.log('Post Title: ' + data[0].post_title);
                //$('#text-c').html(''); // empty an element
                //alert(data[0].post_title); // put our list of links into it
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                if(typeof console === "undefined") {
                    console = {
                        log: function() { },
                        debug: function() { },
                    };
                }
            
                if (XMLHttpRequest.status === 404) {
                    console.log('Element not found.');
                } else {
                    console.log('Error: ' + errorThrown);
                }
            }
        });
    });
})(jQuery);