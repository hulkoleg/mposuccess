/**
 * Created by NotPrometey on 20.09.2015.
 */
$(function(){
    $('a.tree-circle').click(function(e){
        e.preventDefault();
        if('' == $(this).data('url')){
            return false;
        }
        var bye = $.ajax({
            url: $(this).data('url'),
            headers: {
                'X-CSRF-Token' : $('meta[name=_token]').attr('content')
            },
            method: "GET",
            dataType: "json"
        });

        bye.done(function( response ) {
            console.log(response);
            $.each(response, function(id, data){
                if('message' == id) {
                    toastr[data.type](data.message, data.name);
                }else if(null != data[0]) {
                    $('#' + id).data('url', '/tree/build/' + data[2] + '/' + data[1]);
                    $('#' + id).text(data[0]);
                }else{
                    $('#' + id).data('url', '');
                    $('#' + id).text('');
                }
            });
        });

        bye.fail(function( jqXHR, textStatus ) {
            toastr['error']("Request failed: " + textStatus, 'Error!');
        });
    });
});