/**
 * Created by NotPrometey on 20.09.2015.
 */
$(function(){
    $('a.tree-circle').click(function(e){
        e.preventDefault();

        var bye = $.ajax({
            url: $(this).attr('href'),
            headers: {
                'X-CSRF-Token' : $('meta[name=_token]').attr('content')
            },
            method: "GET",
            dataType: "json"
        });

        bye.done(function( response ) {
            console.log(response);
        });

        bye.fail(function( jqXHR, textStatus ) {
            alert( "Request failed: " + textStatus );
        });
    });
});